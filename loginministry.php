<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - Ministry Office</title>
    <link rel="stylesheet" href="css/loginministry.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <!-- Login Form -->
            <div class="login-card">
                <img src="images/logo.jpg" alt="Ministry Office Logo" class="logo">
                <h2>Login to Ministry Office Dashboard</h2>
                <form id="loginForm" action="registerministry.php" method="POST">
                    <input type="hidden" name="form_type" value="login">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required minlength="6">
                    </div>
                    <button type="submit" class="btn login-btn" value="Sign In" name="signIn">Login</button>
                    <p class="toggle">Don't have an account? <a href="#" id="showRegister">Register here</a></p>
                </form>
            </div>

            <!-- Registration Form -->
            <div class="register-card" style="display:none;">
                <img src="images/logo.jpg" alt="Ministry Office Logo" class="logo">
                <h2>Register for Ministry Office</h2>
                <form id="registerForm" action="registerministry.php" method="POST">
                    <input type="hidden" name="form_type" value="register">
                    <div class="form-group">
                        <label for="ministryname">Ministry Name</label>
                        <input type="text" name="ministryname" placeholder="Enter ministry name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Enter your password" required minlength="6">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password" placeholder="Confirm your password" required minlength="6">
                    </div>
                    <button type="submit" class="btn" value="Sign Up" name="signUp">Register</button>
                    <p class="toggle">Already have an account? <a href="#" id="showLogin">Login here</a></p>
                </form>
            </div>
        </div>
    </div>

    <script src="js/loginministry.js"></script>
</body>
</html>
