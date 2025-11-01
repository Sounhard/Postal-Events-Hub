<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - Post Office</title>
    <link rel="stylesheet" href="css/loginpostoffice.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <!-- Login Form -->
            <div class="login-card">
                <img src="images/logo.jpg" alt="Post Office Logo" class="logo">
                <h2>Login to Post Office Dashboard</h2>
                <form id="loginForm" action="registerpost.php" method="POST">
                    <input type="hidden" name="form_type" value="login">
                    <div class="form-group">
                        <label for="loginEmail">Email</label>
                        <input type="email" id="loginEmail" name="email" placeholder="Enter your email" required autocomplete="username">
                    </div>
                    <div class="form-group">
                        <label for="loginPassword">Password</label>
                        <input type="password" id="loginPassword" name="password" placeholder="Enter your password" required minlength="6" autocomplete="current-password">
                    </div>
                    <button type="submit" class="btn login-btn" value="Sign In" name="signIn">Login</button>
                    <p class="toggle">Don't have an account? <a href="#" id="showRegister">Register here</a></p>
                </form>
            </div>

            <!-- Registration Form -->
            <div class="register-card" style="display:none;">
                <img src="images/logo.jpg" alt="Post Office Logo" class="logo">
                <h2>Register for Post Office</h2>
                <form id="registerForm" action="registerpost.php" method="POST">
                    <input type="hidden" name="form_type" value="register">
                    <div class="form-group">
                        <label for="registerPostName">Post Office Name</label>
                        <input type="text" id="registerPostName" name="postname" placeholder="Enter your post office name" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="registerDivisionalName">Divisional Office Name</label>
                        <input type="text" id="registerDivisionalName" name="divisionalname" placeholder="Enter your divisional office name" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="registerMinistryName">Ministry Name</label>
                        <input type="text" id="registerMinistryName" name="ministryname" placeholder="Enter your ministry name" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="registerEmail">Email</label>
                        <input type="email" id="registerEmail" name="email" placeholder="Enter your email" required autocomplete="email">
                    </div>
                    <div class="form-group">
                        <label for="registerPassword">Password</label>
                        <input type="password" id="registerPassword" name="password" placeholder="Enter your password" required minlength="6" autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" id="confirmPassword" name="confirm_password" placeholder="Confirm your password" required minlength="6" autocomplete="new-password">
                    </div>
                    <button type="submit" class="btn" value="Sign Up" name="signUp">Register</button>
                    <p class="toggle">Already have an account? <a href="#" id="showLogin">Login here</a></p>
                </form>
            </div>
        </div>
    </div>

    <script src="js/loginpostoffice.js"></script>
</body>
</html>
