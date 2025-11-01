<?php
session_start();
include 'connect.php';

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize an error message array
$errors = [];

// Registration process
if (isset($_POST['signUp'])) {
    $ministryname = $conn->real_escape_string($_POST['ministryname']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match!";
    }

    // Hash the password securely
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Check if email already exists
    $checkEmail = $conn->prepare("SELECT * FROM users3 WHERE email = ?");
    if (!$checkEmail) {
        die("Prepare failed: " . $conn->error);
    }

    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if ($result->num_rows > 0) {
        $errors[] = "Email Address Already Exists!";
    } else {
        // Insert user data
        $insertQuery = $conn->prepare("INSERT INTO users3 (ministryname, email, password) VALUES (?, ?, ?)");
        if (!$insertQuery) {
            die("Prepare failed: " . $conn->error);
        }

        $insertQuery->bind_param("sss", $ministryname, $email, $hashed_password);

        if (!$insertQuery->execute()) {
            $errors[] = "Error: " . $insertQuery->error;
        } else {
            // Redirect to login page after successful registration
            header("Location: loginministry.php");
            exit();
        }
    }

    // Close statements
    $checkEmail->close();
    $insertQuery->close();
}

// Login process
if (isset($_POST["signIn"])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Fetch the user by email
    $sql = $conn->prepare("SELECT * FROM users3 WHERE email = ?");
    if (!$sql) {
        die("SQL preparation error: " . $conn->error);
    }

    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['ministryname'] = $row['ministryname'];
            header("Location: ministrydashboard.php");
            exit();
        } else {
            $errors[] = "Incorrect Password!";
        }
    } else {
        $errors[] = "Email not found!";
    }

    // Close statement
    $sql->close();
}

// Close connection
$conn->close();

// Display errors if there are any
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
}
?>
