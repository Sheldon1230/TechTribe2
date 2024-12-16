<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TechTribe</title>
<link rel="stylesheet" type="text/css" href="contact_us.css">
<link rel="stylesheet" href="footerr.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
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
        <a href="dash.php">
            <i class="fa-solid fa-house"></i>
        <span class="links_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
    </li>
    <li>
        <a href="profile.php">
            <i class="fa-solid fa-user"></i>
        <span class="links_name">Profile</span>
        </a>
        <span class="tooltip">Profile</span>
    </li>
    <li>
        <a href="Services.php">
            <i class="fa-solid fa-code"></i>
        <span class="links_name">Services</span>
        </a>
        <span class="tooltip">Services</span>
    </li>
    <li>
        <a href=setting.html">
            <i class="fa-solid fa-gear"></i>
        <span class="links_name">Setting</span>
        </a>
        <span class="tooltip">Setting</span>
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
<script  src="script.js"></script>


<!-------- Contact Us----------->
	<section class="contact">
		<div class="content">
			<h2>Contact Us</h2>
			<p></p>
		</div>
		<div class="container">
			<div class="contactInfo">
				<div class="box">
					<div class="icon"><ion-icon name="location-outline"></ion-icon></div>
					<div class="text">
						<h3>Address</h3>
						<p>APU,<br>Bukit Jalil,<br>81000</p>
					</div>
				</div>
				<div class="box">
					<div class="icon"><ion-icon name="call-outline"></ion-icon></div>
					<div class="text">
						<h3>Phone</h3>
						<p>000-000-0000</p>
					</div>
				</div>
				<div class="box">
					<div class="icon"><ion-icon name="mail-outline"></ion-icon></div>
					<div class="text">
						<h3>Email</h3>
						<p>techteribe@gmail.com</p>
					</div>
				</div>
				<h2 class="txt">Connect with us</h2>
				<ul class="sci">
					<li><a href="#"><ion-icon name="logo-facebook"></ion-icon></a></li>
					<li><a href="#"><ion-icon name="logo-twitter"></ion-icon></a></li>
					<li><a href="#"><ion-icon name="logo-linkedin"></ion-icon></a></li>
					<li><a href="#"><ion-icon name="logo-instagram"></ion-icon></a></li>
				</ul>
			</div>

			<div class="contactForm">
				<form method="POST" action="submit_feedback.php">
					<h2>Send Message</h2>
					<div class="inputBox">
						<input type="text" name="full_name" required="required">
						<span>Full Name</span>
					</div>
					<div class="inputBox">
						<input type="email" name="email" required="required">
						<span>Email</span>
					</div>
					<div class="inputBox">
						<textarea name="message" required="required"></textarea>
						<span>Type your Message...</span>
					</div>
					<div class="inputBox">
						<input type="submit" value="Send">
					</div>
				</form>
			</div>
			
		</div>
	</section>
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

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
		<li><a href="#">Workshop</a></li>
		<li><a href="#">Mentorship Program</a></li>
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
