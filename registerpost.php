<?php
include 'connect.php'; // Ensure this includes your database connection
session_start(); // Start the session to manage user login state

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to log errors
function logError($message) {
    error_log($message);
    echo "<p style='color:red;'>$message</p>"; // Display errors directly on the page for debugging
}

// Registration process
if (isset($_POST['signUp'])) {
    $postname = $conn->real_escape_string(trim($_POST['postname']));
    $divisionalname = $conn->real_escape_string(trim($_POST['divisionalname']));
    $ministryname = $conn->real_escape_string(trim($_POST['ministryname']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        logError("Passwords do not match!");
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Check if the email already exists
    $checkEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    // If email exists, log the error
    if ($result->num_rows > 0) {
        logError("Email Address Already Exists!");
    } else {
        // Insert the new user into the database
        $insertQuery = $conn->prepare("INSERT INTO users (postname, divisionalname, ministryname, email, password) VALUES (?, ?, ?, ?, ?)");
        $insertQuery->bind_param("sssss", $postname, $divisionalname, $ministryname, $email, $hashed_password);

        if ($insertQuery->execute()) {
            header("Location: loginpostoffice.php");
            exit();
        } else {
            logError("Error inserting user: " . $insertQuery->error);
        }
    }

    $checkEmail->close();
    $insertQuery->close();
}

// Login process
if (isset($_POST["signIn"])) {
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = $_POST['password'];

    logError("Login attempt: Email = $email");

    // Select user based on email
    $sql = $conn->prepare("SELECT id, password, postname, divisionalname, ministryname FROM users WHERE email = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    // If the user exists, verify the password
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        logError("User found: ID = " . $row['id']);

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Set session variables for logged in user
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['postname'] = $row['postname'];
            $_SESSION['divisionalname'] = $row['divisionalname'];
            $_SESSION['ministryname'] = $row['ministryname'];
            logError("Session set successfully for user_id: " . $_SESSION['user_id']);
            header("Location: postofficedashboard.php");
            exit();
        } else {
            logError("Incorrect Password!");
        }
    } else {
        logError("Email not found!");
    }

    $sql->close();
}

$conn->close();
?>
