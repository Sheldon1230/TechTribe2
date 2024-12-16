<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materials Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="footerr.css">
    
    <style>
        /* Materials Section */
        .materials-section {
            width: 90%;
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .material-item {
            margin-bottom: 20px;
        }

        .material-item iframe {
            width: 100%;
            max-width: 800px;
            height: 400px;
            border-radius: 8px;
        }

        .material-item h3 {
            margin-top: 10px;
            font-size: 20px;
            color: #333;
        }

        .material-item p {
            color: #555;
        }
    </style>
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

    <!-- Materials Section -->
    <div class="materials-section">
        <h2>Materials</h2>

                <?php
            $servername = "localhost";
            $username = "DanishLam";
            $password = "Dsl140904";
            $database = "quiz_db";
            
            try {
                $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
                
                // Query to get the video details from the database
                $sql = "SELECT resource_url, title FROM resources";
                $stmt = $pdo->query($sql);
                
                // Check if the materials are available
                if ($stmt->rowCount() > 0) {
                    // Process each material item from the database
                    while ($row = $stmt->fetch()) {
                        echo '<div class="material-item">';
                        echo '<iframe src="' . htmlspecialchars($row['resource_url']) . '" frameborder="0" allowfullscreen></iframe>';
                        echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                        echo '<p>Video from Lecturer materials.</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No videos available.</p>';
                }
            } catch (PDOException $e) {
                echo '<p>Error: ' . $e->getMessage() . '</p>';
            }
        ?>

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
