<?php
session_start();
include("connect.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: loginpostoffice.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Prepare the SQL statement to fetch events for the logged-in user
$stmt = $conn->prepare("SELECT eventname, eventdate, eventphoto FROM events WHERE user_id = ?");
if (!$stmt) {
    die("Database query failed: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Display the submitted events
if ($result->num_rows > 0) {
    echo "<h2>Submitted Events</h2>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($row['eventname']) . " - " . htmlspecialchars($row['eventdate']);
        
        // Check if an image exists for the event
        if (!empty($row['eventphoto'])) {
            // Use only the filename stored in the database
            $imageSrc = 'uploads/' . htmlspecialchars($row['eventphoto']); // Ensure this only adds 'uploads/' once
            echo "<img src='$imageSrc' alt='Event Photo' style='max-width: 100px; height: auto;'>";
        }
        
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "No submitted events found.";
}

$stmt->close();
$conn->close(); // Close the database connection
?>
