<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - Divisional Office</title>
    <link rel="stylesheet" href="css/logindivisional.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <!-- Login Form -->
            <div class="login-card">
                <img src="images/logo.jpg" alt="Post Office Logo" class="logo">
                <h2>Login to Divisional Office Dashboard</h2>
                
                <?php if (isset($_GET['error'])): ?>
                    <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
                <?php elseif (isset($_GET['success'])): ?>
                    <p class="success">Registration successful! You can now log in.</p>
                <?php endif; ?>
                
                <form id="loginForm" action="registerdivisional.php" method="POST">
                    <input type="hidden" name="form_type" value="login">
                    <div class="form-group">
                        <label for="login_email">Email</label>
                        <input type="email" id="login_email" name="email" placeholder="Enter your email" autocomplete="email" required>
                    </div>
                    <div class="form-group">
                        <label for="login_password">Password</label>
                        <input type="password" id="login_password" name="password" placeholder="Enter your password" autocomplete="current-password" required minlength="6">
                    </div>
                    <button type="submit" class="btn login-btn" name="signIn">Login</button>
                    <p class="toggle">Don't have an account? <a href="#" id="showRegister">Register here</a></p>
                </form>
            </div>

            <!-- Registration Form -->
            <div class="register-card" style="display:none;">
                <img src="images/logo.jpg" alt="Post Office Logo" class="logo">
                <h2>Register for Divisional Office</h2>
                <form id="registerForm" action="registerdivisional.php" method="POST">
                    <input type="hidden" name="form_type" value="register">
                    <div class="form-group">
                        <label for="divisionalname">Divisional Name</label>
                        <input type="text" id="divisionalname" name="divisionalname" placeholder="Enter your divisional name" required>
                    </div>
                    <div class="form-group">
                        <label for="ministryname">Ministry Name</label>
                        <input type="text" id="ministryname" name="ministryname" placeholder="Enter your ministry name" required>
                    </div>
                    <div class="form-group">
                        <label for="register_email">Email</label>
                        <input type="email" id="register_email" name="email" placeholder="Enter your email" autocomplete="email" required>
                    </div>
                    <div class="form-group">
                        <label for="register_password">Password</label>
                        <input type="password" id="register_password" name="password" placeholder="Enter your password" autocomplete="new-password" required minlength="6">
                    </div>
                    <div class="form-group">
    <label for="confirm_password">Confirm Password</label>
    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required minlength="6" autocomplete="new-password">
</div>

                    <button type="submit" class="btn" name="signUp">Register</button>
                    <p class="toggle">Already have an account? <a href="#" id="showLogin">Login here</a></p>
                </form>
            </div>
        </div>
    </div>

    <script src="js/logindivisional.js"></script>
</body>
</html>
