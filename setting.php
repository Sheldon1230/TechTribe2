<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services</title>
    <link rel="stylesheet" href="services_css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="footerr.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-details">
            <i class="fa-solid fa-memory"></i>
            <div class="logo_name">TechTribe</div>
        </div>
        <ul class="nav-list">
            <li>
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search...">
            </li>
            <li>
                <a href="dash.html">
                    <i class="fa-solid fa-house"></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="profile.html">
                    <i class="fa-solid fa-user"></i>
                    <span class="links_name">Profile</span>
                </a>
            </li>
            <li>
                <a href="Services.html">
                    <i class="fa-solid fa-code"></i>
                    <span class="links_name">Services</span>
                </a>
            </li>
            <li>
                <a href="setting.html">
                    <i class="fa-solid fa-gear"></i>
                    <span class="links_name">Setting</span>
                </a>
            </li>
            <li class="profile">
                <div class="profile-details">
                    <img src="/dist/profile.png" alt="profileImg">
                    <div class="name_job">
                        <div class="name">Benny Yong</div>
                        <div class="roles">Student</div>
                    </div>
                </div>
                <i class="fa-solid fa-right-from-bracket" id="log_out"></i>
            </li>
        </ul>
    </div>
    
    <!-- Services Section -->
    <div class="container">
        <div class="service-wrapper">
            <div class="service">
                <h1>Our Services</h1>
                <div class="cards">
                    <div class="card">
                        <i class="fa-solid fa-terminal"></i>
                        <h2>Coding Tutorial</h2>
                        <p>A step-by-step guide to teach programming concepts, from basic syntax to advanced skills, in languages like Python, Java, or JavaScript.</p>
                    </div>
                    <div class="card">
                        <i class="fa-solid fa-chalkboard-user"></i>
                        <h2>Coding Lesson</h2>
                        <p>Interactive sessions focused on developing specific programming skills, emphasizing collaboration, problem-solving, and hands-on practice.</p>
                    </div>
                    <div class="card">
                        <i class="fa-solid fa-school"></i>
                        <h2>Progression</h2>
                        <p>Mentorship programs that connect experienced mentors with learners to provide guidance, support, and career growth.</p>
                    </div>
                    <div class="card">
                        <i class="fa-solid fa-book"></i>
                        <h2>Resource Library</h2>
                        <p>A curated collection of guides, videos, and materials designed to help users solve problems and expand their knowledge on various topics.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
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
                    <li><a href="#">Coding Tutorial</a></li>
                    <li><a href="#">Coding Lesson</a></li>
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
                <span class="copyright_text">Copyright © 2024 <a href="#">TechTribe</a> All rights reserved</span>
                <span class="policy_terms">
                    <a href="#">Privacy policy</a>
                    <a href="#">Terms & condition</a>
                </span>
            </div>
        </div>
    </footer>
</body>
</html>
