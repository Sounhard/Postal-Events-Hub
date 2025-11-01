<?php
include 'connect.php';

// Secure session start
session_set_cookie_params([
    'httponly' => true,
    'samesite' => 'Strict',
    'secure' => isset($_SERVER['HTTPS']), // Set 'secure' to true if HTTPS is used
]);
session_start();

// Check if form_type is set to differentiate between login and registration
$form_type = $_POST['form_type'] ?? '';

// Registration process
if ($form_type === 'register' && isset($_POST['signUp'])) {
    $divisionalname = $conn->real_escape_string($_POST['divisionalname']);
    $ministryname = $conn->real_escape_string($_POST['ministryname']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        header("Location: logindivisional.php?error=password_mismatch");
        exit();
    }

    // Hash the password securely
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Check if email already exists
    $checkEmail = $conn->prepare("SELECT * FROM users2 WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if ($result->num_rows > 0) {
        header("Location: logindivisional.php?error=email_exists");
        exit();
    } else {
        // Insert user data
        $insertQuery = $conn->prepare("INSERT INTO users2 (divisionalname, ministryname, email, password) VALUES (?, ?, ?, ?)");
        $insertQuery->bind_param("ssss", $divisionalname, $ministryname, $email, $hashed_password);

        if ($insertQuery->execute()) {
            header("Location: logindivisional.php?success=registered");
            exit();
        } else {
            header("Location: logindivisional.php?error=insert_failed");
            exit();
        }
    }

    // Close statements
    $checkEmail->close();
    $insertQuery->close();
}

// Login process
if ($form_type === 'login' && isset($_POST["signIn"])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Fetch the user by email
    $sql = $conn->prepare("SELECT * FROM users2 WHERE email = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['divisionalname'] = $row['divisionalname'];
            $_SESSION['ministryname'] = $row['ministryname'];
            header("Location: divisionaldashboard.php");
            exit();
        } else {
            header("Location: logindivisional.php?error=incorrect_password");
            exit();
        }
    } else {
        header("Location: logindivisional.php?error=email_not_found");
        exit();
    }

    // Close statement
    $sql->close();
}

// Close connection
$conn->close();
?>
