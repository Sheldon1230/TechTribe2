<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/CSS" href="css_design.css">
    
</head>

<body>
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
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <form id="signupForm" action="signup_process.php" method="POST">
                <label for="chk" aria-hidden="true">Sign Up</label>
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
            <div class="select">
                <select name="role" required>
                    <option value="">Select your role</option>
                    <option value="student">Student</option>
                    <option value="lecturer">Lecturer</option>
                </select>
            </div>
                <button type="submit">Sign Up</button>
                <?php if(isset($_SESSION['error'])): ?>
                    <div class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>
            </form>
        </div>

        <div class="login">
            <form action="login-process.php" method="POST">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
                <?php if(isset($_SESSION['login_error'])): ?>
                    <div class="error"><?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?></div>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('signupForm').addEventListener('submit', function(e) {
            const password = document.querySelector('input[name="password"]').value;
            if (password.length < 6) {
                e.preventDefault();
                alert('Password must be at least 6 characters long');
            }
        });
    </script>
</body>
</html>