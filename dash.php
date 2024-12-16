<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | TechTribe</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="footerr.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<!-------- Sidebar----------->
<div class="sidebar">
    <div class="logo-details">
        <i class="fa-solid fa-memory"></i>
    <div class="logo_name">TechTribe</div>
    <i class="fa-solid fa-bars" id="btn"></i>
    </div>
    <ul class="nav-list">
    <li>
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" placeholder="Search...">
        <span class="tooltip">Search</span>
    </li>
    <li>
        <a href="dash.html">
            <i class="fa-solid fa-house"></i>
        <span class="links_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
    </li>
    <li>
        <a href="profile.html">
            <i class="fa-solid fa-user"></i>
        <span class="links_name">Profile</span>
        </a>
        <span class="tooltip">Profile</span>
    </li>
    <li>
        <a href="Services.html">
            <i class="fa-solid fa-code"></i>
        <span class="links_name">Services</span>
        </a>
        <span class="tooltip">Services</span>
    </li>
    <li>
        <a href="setting.html">
            <i class="fa-solid fa-gear"></i>
        <span class="links_name">Setting</span>
        </a>
        <span class="tooltip">Setting</span>
    </li>
    <li class="profile">
        <div class="profile-details">
        <img src="profile.png" alt="profileImg">
        <div class="name_job">
            <div class="name"></div>
            <div class="roles">Student</div>
        </div>
        </div>
        <i class="fa-solid fa-right-from-bracket" id="log_out"></i>
    </li>
    </ul>
</div>
    <script  src="script.js"></script>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Quick Options -->
        <div class="quick-options">
            <h1>Quick Options</h1>
            <div class="cards" >
                <div class="card">
                    <i class="fa-solid fa-user-graduate"></i>
                    <div class="card-details">
                        <h2><a href="profile.html">Profile</a></h2>
                    </div>
                </div>
                <div class="card">
                    <i class="fa-solid fa-book"></i>
                    <div class="card-details">
                        <h2><a href="course.php">Courses</a></h2>
                    </div>
                </div>
                <div class="card">
                    <i class="fa-solid fa-code"></i>
                    <div class="card-details">
                        <h2><a href="">Quiz</a></h2>
                    </div>
                </div>
                <div class="card">
                    <i class="fa-solid fa-trophy"></i>
                    <div class="card-details">
                        <h2><a href="Services.html">Services</a></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="courses">
            <h1>Courses</h1>
            <div class="content">
                <?php
                // Database Connection
                $servername = "localhost"; 
                $username = "root";        
                $password = "";            
                $dbname = "techtribe";     
        
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
        
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
        
                // Query to fetch courses from 'resources' table
                $sql = "SELECT course_name, description, image_url FROM resources";
                $result = $conn->query($sql);
        
                // Display the courses if any records are found
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="course-card">';
                        echo '<img src="' . $row["image_url"] . '" alt="Course Image">';
                        echo '<h2>' . htmlspecialchars($row["course_name"]) . '</h2>';
                        echo '<p>' . htmlspecialchars($row["description"]) . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No courses available at the moment.</p>";
                }
        
                // Close the connection
                $conn->close();
                ?>
            </div>
        </div>


<!-- Footer -->
<!-------Footer------>
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
        <li><a href="contact_us.html">Contact us</a></li>
        </ul>
        <ul class="box">
        <li class="link_name">Services</li>
        <li><a href="">Coding Tutorial</a></li>
        <li><a href="#">Coding Lession</a></li>
        <li><a href="#">Progression</a></li>
        <li><a href="#">Resource Library</a></li>
        </ul>
        <ul class="box">
        <li class="link_name">Account</li>
        <li><a href="profile.html">Profile</a></li>
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
</body>
</html>