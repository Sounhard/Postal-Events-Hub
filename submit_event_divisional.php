<?php
session_start();
include 'connect.php'; // Ensure this file connects to your database

// Check if the user is logged in and get user_id from session
if (!isset($_SESSION['user_id'])) {
    header("Location: logindivisional.php"); // Redirect to login if not logged in
    exit();
}

$user_id = $_SESSION['user_id']; // Assuming user_id is stored in session

// Handle event submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit_event'])) {
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $event_photo = null; // Default value

    // Handle file upload
    if (isset($_FILES['event_photo']) && $_FILES['event_photo']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/"; // Ensure this directory exists and is writable
        $event_photo = basename($_FILES["event_photo"]["name"]);
        $target_file = $target_dir . $event_photo;

        // Check if the file is an actual image
        $check = getimagesize($_FILES["event_photo"]["tmp_name"]);
        if ($check !== false) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["event_photo"]["tmp_name"], $target_file)) {
                // File successfully uploaded
            } else {
                $_SESSION['error_message'] = "Error uploading the file.";
                header("Location: divisionaldashboard.php");
                exit();
            }
        } else {
            $_SESSION['error_message'] = "File is not an image.";
            header("Location: divisionaldashboard.php");
            exit();
        }
    }

    // Set the status as 'pending' or 'submitted' based on your requirements
    $status = 'pending';

    // Prepare the SQL statement to insert the event
    $stmt = $conn->prepare("INSERT INTO events2 (user_id, event_name, event_date, status, event_photo) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $event_name, $event_date, $status, $event_photo);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Event submitted successfully!";
    } else {
        $_SESSION['error_message'] = "Error submitting event: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();

    // Refresh the page to see the newly submitted event
    header("Location: divisionaldashboard.php");
    exit();
}
?>
