<?php
session_start();
include("connect.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: loginpostoffice.php");
    exit();
}

// Handle event submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventname = trim($_POST['event_name']); // Change to 'event_name'
    $eventdate = trim($_POST['event_date']); // Change to 'event_date'
    $user_id = $_SESSION['user_id'];
    $divisionalname = $_SESSION['divisionalname']; // Assuming you want to save this as well
    $eventphoto = null;

    // Validate inputs
    if (empty($eventname)) {
        echo "Event name is required.";
        exit();
    }

    if (empty($eventdate)) {
        echo "Event date is required.";
        exit();
    }

    // Handle file upload if a file is selected
    if (isset($_FILES['event_photo']) && $_FILES['event_photo']['error'] == UPLOAD_ERR_OK) { // Change to 'event_photo'
        $upload_dir = 'uploads/'; // Directory where photos will be stored
        $event_photo_name = basename($_FILES['event_photo']['name']); // Change to 'event_photo'
        $upload_file = $upload_dir . $event_photo_name;

        // Validate if the file is an image
        $image_file_type = strtolower(pathinfo($upload_file, PATHINFO_EXTENSION));
        $valid_extensions = array("jpg", "jpeg", "png", "gif");

        if (!in_array($image_file_type, $valid_extensions)) {
            echo "Invalid file type. Only JPG, JPEG, PNG & GIF files are allowed.";
            exit();
        }

        // Move the uploaded file to the designated directory
        if (move_uploaded_file($_FILES['event_photo']['tmp_name'], $upload_file)) { // Change to 'event_photo'
            // Save only the filename to the database
            $eventphoto = $event_photo_name;
        } else {
            echo "Error uploading the file.";
            exit();
        }
    }

    // Prepare the SQL statement to insert the event
    $stmt = $conn->prepare("INSERT INTO events (user_id, divisionalname, eventname, eventdate, eventphoto) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $divisionalname, $eventname, $eventdate, $eventphoto);

    if ($stmt->execute()) {
        echo "Event submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close(); // Ensure to close the database connection
?>
