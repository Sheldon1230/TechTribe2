<?php
// Include database connection
include("classroom_db.php");

// Success message placeholder
$success_message = "";

// Handle Resource Creation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_resource'])) {
    $classroom_id = intval($_POST['classroom_id']);
    $title = $_POST['title'];
    $resource_type = $_POST['resource_type'];
    $resource_url = $_POST['resource_url'];

    $stmt = $conn->prepare("INSERT INTO resources (classroom_id, title, resource_type, resource_url) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("isss", $classroom_id, $title, $resource_type, $resource_url);
        $stmt->execute();
        $success_message = "Resource added successfully!";
        $stmt->close();
    }
}

// Handle Resource Deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_resource_id'])) {
    $resource_id = intval($_POST['delete_resource_id']);
    $stmt = $conn->prepare("DELETE FROM resources WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $resource_id);
        $stmt->execute();
        $success_message = "Resource deleted successfully!";
        $stmt->close();
    }
}

// Fetch Classrooms for Dropdown
$classrooms_query = "SELECT id, classroom_name FROM classrooms";
$classrooms = $conn->query($classrooms_query);

// Fetch Resources for the Selected Classroom
$selected_classroom = null;
$classroom_resources = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['classroom'])) {
    $selected_classroom = intval($_POST['classroom']);
    $stmt = $conn->prepare("SELECT * FROM resources WHERE classroom_id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $selected_classroom);
        $stmt->execute();
        $classroom_resources = $stmt->get_result();
        $stmt->close();
    }
}

session_start();
include("classroom_db.php");
include("user_db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: loginform.php"); // Redirect to login if not logged in
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$user_query = $conn->prepare("SELECT * FROM users WHERE id = ?");
$user_query->bind_param("i", $user_id);
$user_query->execute();
$user = $user_query->get_result()->fetch_assoc();

// Fetch exams for dropdown
$examQuery = $conn->query("SELECT ex_id, ex_title FROM exam_tbl");

// Handle quiz question submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_question'])) {
    $exam_id = $_POST['exam_id'];
    $question = $_POST['question'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $correct_answer = strtoupper($_POST['correct_answer']);

    // Insert into database
    $insertQuery = $conn->prepare("INSERT INTO quiz_questions (exam_id, question, option_a, option_b, option_c, option_d, correct_option) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?)");
    $insertQuery->bind_param("issssss", $exam_id, $question, $option_a, $option_b, $option_c, $option_d, $correct_answer);

    if ($insertQuery->execute()) {
        $success_message = "Question added successfully!";
    } else {
        $error_message = "Failed to add question!";
    }

    $insertQuery->close(); // Close the prepared statement
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="teacher.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <title>Teacher Page</title>
</head>
<body>
    <nav class="SideBar close">
        <header>
            <div class="logo">
                <span class="image">
                    <img src="TechTribe Logo.png" alt="TechTribe Logo">
                </span>

                <div class="text text_logo">
                    <span class="Logo">TechTribe</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-link">
                    <li class="search-box">
                        <i class='bx bx-search icon'></i>
                        <input type="text" placeholder="Search...">
                    </li>

                    <li class="nav-bar">
                        <a href="#Dashboard">
                            <i class='bx bx-home-alt icon' title="Dashboard"></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-bar">
                        <a href="#Classroom">
                            <i class='bx bxs-chalkboard icon' title="Classroom"></i>
                            <span class="text nav-text">Classroom</span>
                        </a>
                    </li>

                    <li class="nav-bar">
                        <a href="#Plan">
                            <i class='bx bxs-book-content icon' title="Plan / e-Resource Editor"></i>
                            <span class="text nav-text">Plan / Online Resource Editor</span>
                        </a>
                    </li>
                    
                    <li class="nav-bar">
                        <a href="#Insight">
                            <i class='bx bx-hdd' title="Insights"></i>
                            <span class="text nav-text">Insights</span>
                        </a>
                    </li>

                    <li class="nav-bar">
                        <a href="#user-page">
                            <i class='bx bxs-user-rectangle' title="User Profile"></i>
                            <span class="text nav-text">User Profile</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <ul>
                    <li>
                        <a href="logout.php"><i class='bx bx-log-out icon'></i></a>
                        <span class="text nav-text"><a href="logout.php">Logout</a></span>
                        
                    </li>

                    <li class="mode">
                        <div class="sun-moon">
                            <i class='bx bx-moon icon moon'></i>
                            <i class='bx bx-sun icon sun'></i>
                        </div>
                        <span class="mode-text text">Dark mode</span>

                        <div class="toggle-switch">
                            <span class="switch"></span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-page-button">
        <button class="button" onclick="myButtonDashboard()">Start</button>
    </div>

    <div class="container">
        <section id="Dashboard" class="active">
            <div class="Dashboard-Container">
                <div class="Dashboard-Container-Design">
                    <div class="code_text">HTML</div>
                    <div class="code_text">CSS</div>
                    <div class="code_text">JavaScript</div>
                    <div class="code_text">PHP</div>
                    <div class="code_text">Java</div>
                    <div class="code_text">C++</div>
                    <div class="code_text">Ruby</div>
                    <div class="code_text">Python</div>
                    <div class="code_text">Node.js</div>
                    <div class="code_text">React.js</div>
                    <div class="code_text">React</div>
                    <div class="code_text">Kotlin</div>
                    <div class="code_text">Swift</div>
                    <div class="code_text">Go</div>
                    <div class="code_text">Rust</div>
                    <div class="code_text">SQL</div>
                    <div class="code_text">TypeScript</div>
                    <div class="code_text">Perl</div>
                    <div class="code_text">Angular</div>
                    <div class="code_text">Vue.js</div>
                    <div class="code_text">MongoDB</div>
                </div>
                <h1>
                    Welcome To The Teacher'S Dashboard
                </h1>
            </div>
    
            <div class="Classroom-Intro">
                <h2>Classroom Introduction</h2>
                <div class="Intro-Design-Classroom">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut optio facilis ex. Officiis cum error consequatur animi ratione corrupti quia incidunt magni nostrum, adipisci impedit mollitia sint quae commodi saepe.
                    </p>
                    <div class="button-to-Classroom">
                        <button onclick="myButtonClassroom()">
                            Go to <i class='bx bx-right-arrow-alt'></i>
                        </button>
                    </div>
                </div>
            </div>
    
            <div class="Plan-Intro">
                <h2>Plan Introduction</h2>
                <div class="Intro-Design-Plan">
                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed consequatur vero veritatis, accusantium natus aut quas nobis aliquam sunt assumenda, nesciunt beatae numquam harum maiores voluptate, perferendis magni quis porro.
                    </p>
                    <div class="button-to-Plan">
                        <button onclick="myButtonPlan()">
                            Go to <i class='bx bx-right-arrow-alt'></i>
                        </button>
                    </div>
                </div>
            </div>
    
            <div class="Insight-Intro">
                <h2>Insight Introduction</h2>
                <div class="Intro-Design-Insight">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio qui quidem quisquam ab necessitatibus repudiandae. Qui impedit atque non numquam ipsa facilis ullam culpa inventore distinctio, itaque voluptatum laudantium ex?
                    </p>
                    <div class="button-to-Insight">
                        <button onclick="myButtonInsight()">
                            Go to <i class='bx bx-right-arrow-alt'></i>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section id="Classroom" onclick="myButtonClassroom()">
            <div class="classroom-background">
                <div class="classroom-header">
                    <h2>
                        Teacher Classroom
                    </h2>
                </div>
                <div class="classroom-cantainer">
                    <h3>
                        Classroom Course
                    </h3>
                    <div class="classroom-container-box-1">
                    <form method="POST" action="" class="Classroom_Drp">
                            <label for="classroom" style="color: white;">Choose a classroom:</label>
                            <select name="classroom" id="classroom-dropdown-classroom" onchange="this.form.submit()">
                                <option value="">-- Select Classroom --</option>
                                <?php while ($row = $classrooms->fetch_assoc()): ?>
                                    <option value="<?php echo $row['id']; ?>" <?php echo ($row['id'] == $selected_classroom) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($row['classroom_name']); ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                    </form>
                    </div>
                </div>

                <div class="student-hour-selection">
                    <div class="hour-selection-container">
                        <form method="#">
                        <label for="student-list">Student Name:</label>
                        <select name="student-list" id="student-list" class="student-list">
                            <option value="">Select a student</option>
                        </select>
                        </form>
                        <div class="detail-info-container">
                            <div class="details-info-1">
                                <p>
                                    Time Spent
                                </p>
                                <h1>
                                    <i class='bx bxs-time'></i>
                                    Time
                                </h1>
                                <p>Learn</p>
                            </div>
                            <div class="details-info-2">
                                <p>
                                    Answered
                                </p>
                                <h1>
                                    <i class='bx bx-list-check' ></i>
                                    <div class="text-answer">Number</div>
                                </h1>
                                <p class="question-list">Questions</p>
                            </div>
                            <div class="details-info-3">
                                <p>
                                    Completed
                                </p>
                                <h1>
                                    <i class='bx bxs-book' ></i>
                                    <div class="completed-list">Number</div>
                                </h1>
                                <p class="lesson-list">Lesson</p>
                            </div>
                            <div class="details-info-4">
                                <p>
                                    Solve
                                </p>
                                <h1>
                                    <i class='bx bx-desktop' ></i>
                                    Time
                                </h1>
                                <p>Challenges</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="classroom-piechart-container">
                    <div class="classroom-piechart-background">
                        <h2>
                            Class Overall Progress
                        </h2>
                        <div class="card" id="chart-container">
                            <canvas id="graphCanvas"></canvas>
                        </div>
                    </div>
                </div>

                <div class="table">
                    <table>
                        <tr>
                            <tbody><!--Add the live table here cause i gave up--></tbody>
                        </tr>
                    </table>
                </div>
            </div>
        </section>

        <section id="Plan" onclick="myButtonPlan()">
            <div class="plan_background">
                <header class="classroom_selection" style="position: relative;left: 7em;">
                    <?php echo $selected_classroom ? "Classroom ID: " . htmlspecialchars($selected_classroom) : "Select a Classroom"; ?>
                </header>

                <!-- Success Message -->
                <?php if (isset($success_message)): ?>
                    <p style="color: green; text-align: center;"><?php echo $success_message; ?></p>
                <?php endif; ?>

                <!-- Classroom Dropdown -->
                <form method="POST" action="" class="Classroom_Drp">
                    <label for="classroom">Choose a classroom:</label>
                    <select name="classroom" id="classroom-dropdown" onchange="this.form.submit()">
                        <option value="">-- Select Classroom --</option>
                        <?php while ($row = $classrooms->fetch_assoc()): ?>
                            <option value="<?php echo $row['id']; ?>" <?php echo ($row['id'] == $selected_classroom) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($row['classroom_name']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </form>


                <!-- Manage Resources -->
                 <div class="content">
                    <h2>Manage Resources</h2>
                    <table border="1">
                        <tr>
                            <th>Title</th>
                            <th>Type</th>
                            <th>URL</th>
                            <th>Actions</th>
                        </tr>
                        <?php if ($classroom_resources && $classroom_resources->num_rows > 0): ?>
                            <?php while ($resource = $classroom_resources->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($resource['title']); ?></td>
                                    <td><?php echo htmlspecialchars($resource['resource_type']); ?></td>
                                    <td><?php echo htmlspecialchars($resource['resource_url']); ?></td>
                                    <td>
                                        <form method="POST" action="" style="display:inline;">
                                            <input type="hidden" name="delete_resource_id" value="<?php echo $resource['id']; ?>">
                                            <button type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="4">No resources found for this classroom.</td></tr>
                        <?php endif; ?>
                    </table>

                    <!-- Add Resource Form -->
                    <h3>Add New Resource</h3>
                    <form method="POST" action="" class="question_test">
                        <input type="hidden" name="classroom_id" value="<?php echo $selected_classroom; ?>">
                        <label>Title:</label>
                        <input type="text" name="title" required>
                        <label>Type:</label>
                        <select name="resource_type">
                            <option value="link">Link</option>
                            <option value="video">Video</option>
                            <option value="document">Document</option>
                        </select>
                        <label>URL:</label>
                        <input type="text" name="resource_url" required>
                        <button type="submit" name="add_resource">Add Resource</button>
                    </form>
                </div>
            </div>
            <div class="exam-container">
                <h3>Select Exam and Add Questions</h3>

                <!-- Display success or error messages -->
                <?php if (!empty($success_message)): ?>
                    <p style="color: green;"><?php echo $success_message; ?></p>
                <?php elseif (!empty($error_message)): ?>
                    <p style="color: red;"><?php echo $error_message; ?></p>
                <?php endif; ?>

                <!-- Dropdown to select an exam -->
                <form method="POST" action="">
                    <label for="examSelect">Choose Exam:</label>
                    <select name="exam_id" id="examSelect" required>
                        <option value="">-- Select an Exam --</option>
                        <?php while ($exam = $examQuery->fetch_assoc()): ?>
                            <option value="<?php echo $exam['ex_id']; ?>">
                                <?php echo htmlspecialchars($exam['ex_title']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>

                    <!-- Question Input Fields -->
                    <label>Question:</label>
                    <textarea name="question" required></textarea>

                    <label>Option A:</label>
                    <input type="text" name="option_a" required>

                    <label>Option B:</label>
                    <input type="text" name="option_b" required>

                    <label>Option C:</label>
                    <input type="text" name="option_c" required>

                    <label>Option D:</label>
                    <input type="text" name="option_d" required>

                    <label>Correct Answer (A, B, C, D):</label>
                    <input type="text" name="correct_answer" pattern="[A-Da-d]" maxlength="1" required>

                    <button type="submit" name="add_question">Add Question</button>
                </form>
            </div>
        </section>

        <section id="Insight" onclick="myButtonInsight()">
            <div class="insight_background">
                <h1>Student Performance Dashboard</h1>
                <table id="performanceTable" class="Student-progress">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Task Name</th>
                            <th>Completion Rate (%)</th>
                            <th>Time Spent (Seconds)</th>
                            <th>Core Concept Understanding (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be inserted here dynamically -->
                    </tbody>
                </table>

                <div id="charts">
                    <canvas id="completionRateChart"></canvas>
                    <canvas id="timeSpentChart" style="margin-top: -22em;"></canvas>
                    <canvas id="coreUnderstandingChart"></canvas>
                </div>
            </div>
        </section>

        <section id="user-page">
            <div class="user-background">
                <div class="code_text">HTML</div>
                <div class="code_text">CSS</div>
                <div class="code_text">JavaScript</div>
                <div class="code_text">PHP</div>
                <div class="code_text">Java</div>
                <div class="code_text">C++</div>
                <div class="code_text">Ruby</div>
                <div class="code_text">Python</div>
                <div class="code_text">Node.js</div>
                <div class="code_text">React.js</div>
                <div class="code_text">React</div>
                <div class="code_text">Kotlin</div>
                <div class="code_text">Swift</div>
                <div class="code_text">Go</div>
                <div class="code_text">Rust</div>
                <div class="code_text">SQL</div>
                <div class="code_text">TypeScript</div>
                <div class="code_text">Perl</div>
                <div class="code_text">Angular</div>
                <div class="code_text">Vue.js</div>
                <div class="code_text">MongoDB</div>
    
                <div class="user-profile">
                    <div class="user-profile-container">
                        <h1>Welcome, <?php echo $user['username']; ?></h1>
                        <p class="email-text">Email: <?php echo $user['email']; ?></p>
                        <p class="bio-text">Bio: <?php echo isset($user['bio']) ? $user['bio'] : 'No bio added yet'; ?></p>
                        <img src="user2.jpg" class="user-image">

                        <form action="update_user.php" method="POST">
                            <textarea name="bio" placeholder="Update your bio" class="textfield"><?php echo isset($user['bio']) ? $user['bio'] : ''; // Safely check if 'bio' exists ?></textarea>
                            <button type="submit" class="updates-button">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 36 36"
                                width="36px"
                                height="36px"
                            >
                                <rect width="36" height="36" x="0" y="0" fill="#fdd835"></rect>
                                <path
                                fill="#e53935"
                                d="M38.67,42H11.52C11.27,40.62,11,38.57,11,36c0-5,0-11,0-11s1.44-7.39,3.22-9.59 c1.67-2.06,2.76-3.48,6.78-4.41c3-0.7,7.13-0.23,9,1c2.15,1.42,3.37,6.67,3.81,11.29c1.49-0.3,5.21,0.2,5.5,1.28 C40.89,30.29,39.48,38.31,38.67,42z"
                                ></path>
                                <path
                                fill="#b71c1c"
                                d="M39.02,42H11.99c-0.22-2.67-0.48-7.05-0.49-12.72c0.83,4.18,1.63,9.59,6.98,9.79 c3.48,0.12,8.27,0.55,9.83-2.45c1.57-3,3.72-8.95,3.51-15.62c-0.19-5.84-1.75-8.2-2.13-8.7c0.59,0.66,3.74,4.49,4.01,11.7 c0.03,0.83,0.06,1.72,0.08,2.66c4.21-0.15,5.93,1.5,6.07,2.35C40.68,33.85,39.8,38.9,39.02,42z"
                                ></path>
                                <path
                                fill="#212121"
                                d="M35,27.17c0,3.67-0.28,11.2-0.42,14.83h-2C32.72,38.42,33,30.83,33,27.17 c0-5.54-1.46-12.65-3.55-14.02c-1.65-1.08-5.49-1.48-8.23-0.85c-3.62,0.83-4.57,1.99-6.14,3.92L15,16.32 c-1.31,1.6-2.59,6.92-3,8.96v10.8c0,2.58,0.28,4.61,0.54,5.92H10.5c-0.25-1.41-0.5-3.42-0.5-5.92l0.02-11.09 c0.15-0.77,1.55-7.63,3.43-9.94l0.08-0.09c1.65-2.03,2.96-3.63,7.25-4.61c3.28-0.76,7.67-0.25,9.77,1.13 C33.79,13.6,35,22.23,35,27.17z"
                                ></path>
                                <path
                                fill="#01579b"
                                d="M17.165,17.283c5.217-0.055,9.391,0.283,9,6.011c-0.391,5.728-8.478,5.533-9.391,5.337 c-0.913-0.196-7.826-0.043-7.696-5.337C9.209,18,13.645,17.32,17.165,17.283z"
                                ></path>
                                <path
                                fill="#212121"
                                d="M40.739,37.38c-0.28,1.99-0.69,3.53-1.22,4.62h-2.43c0.25-0.19,1.13-1.11,1.67-4.9 c0.57-4-0.23-11.79-0.93-12.78c-0.4-0.4-2.63-0.8-4.37-0.89l0.1-1.99c1.04,0.05,4.53,0.31,5.71,1.49 C40.689,24.36,41.289,33.53,40.739,37.38z"
                                ></path>
                                <path
                                fill="#81d4fa"
                                d="M10.154,20.201c0.261,2.059-0.196,3.351,2.543,3.546s8.076,1.022,9.402-0.554 c1.326-1.576,1.75-4.365-0.891-5.267C19.336,17.287,12.959,16.251,10.154,20.201z"
                                ></path>
                                <path
                                fill="#212121"
                                d="M17.615,29.677c-0.502,0-0.873-0.03-1.052-0.069c-0.086-0.019-0.236-0.035-0.434-0.06 c-5.344-0.679-8.053-2.784-8.052-6.255c0.001-2.698,1.17-7.238,8.986-7.32l0.181-0.002c3.444-0.038,6.414-0.068,8.272,1.818 c1.173,1.191,1.712,3,1.647,5.53c-0.044,1.688-0.785,3.147-2.144,4.217C22.785,29.296,19.388,29.677,17.615,29.677z M17.086,17.973 c-7.006,0.074-7.008,4.023-7.008,5.321c-0.001,3.109,3.598,3.926,6.305,4.27c0.273,0.035,0.48,0.063,0.601,0.089 c0.563,0.101,4.68,0.035,6.855-1.732c0.865-0.702,1.299-1.57,1.326-2.653c0.051-1.958-0.301-3.291-1.073-4.075 c-1.262-1.281-3.834-1.255-6.825-1.222L17.086,17.973z"
                                ></path>
                                <path
                                fill="#e1f5fe"
                                d="M15.078,19.043c1.957-0.326,5.122-0.529,4.435,1.304c-0.489,1.304-7.185,2.185-7.185,0.652 C12.328,19.467,15.078,19.043,15.078,19.043z"
                                ></path>
                            </svg>
                            <span class="now">Update</span>
                            <span class="play">SUS</span>
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $.ajax({
                url: "pie_chart_data.php",
                method: "GET",
                success: function(data){
                    console.log(data);
                    var name = [];
                    var progress = [];

                    for (var i in data){
                        name.push(data[i].lan_name);

                        progress.puch(data[i].progress);
                    }
                    var chardata = {
                        labels: name,
                        datasets: [{
                            label: "Progress",
                            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                            hoverBackgroundColor: 'rgba(230, 236, 235, 0.75)',
                            hoverBorderColor: 'rgba(230, 236, 235, 0.75)',
                            data: progress


                        }]
                    };
                    var graphProg = $("graphCanvas");
                    var Graph = new Chart(graphProg, {
                        type: "pie",
                        data: chardata,


                    })
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="teacher.js"></script>



</body>
<footer>
    <div class="content3">
    <div class="top">
        <div class="logo-details">
            <i class="fa-solid fa-memory"></i>
        <span class="logo_name">TechTribe</span>
        </div>
        <div class="media-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-linkedin-in"></i></a>
        <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
    <div class="link-boxes">
        <ul class="box">
        <li class="link_name">Communities</li>
        <li><a href="#">Home</a></li>
        <li><a href="#">Contact us</a></li>
        </ul>
        <ul class="box">
        <li class="link_name">Services</li>
        <li><a href="#">Coding Tutorial</a></li>
        <li><a href="#">Workshop</a></li>
        <li><a href="#">Mentorship Program</a></li>
        <li><a href="#">Resource Library</a></li>
        </ul>
        <ul class="box">
        <li class="link_name">Account</li>
        <li><a href="#">Profile</a></li>
        </ul>
        <ul class="box input-box">
        <li class="link_name">Subscribe</li>
        <li><input type="text" placeholder="Enter your email"></li>
        <li><input type="button" value="Subscribe"></li>
        </ul>
    </div>
    </div>
    <div class="bottom-details">
    <div class="bottom_text">
        <span class="copyright_text">Copyright © 2024 <a href="#">TechTribe </a>All rights reserved</span>
        <span class="policy_terms">
        <a href="#">Privacy policy</a>
        <a href="#">Terms & condition</a>
        </span>
    </div>
    </div>
</footer>
</html>
