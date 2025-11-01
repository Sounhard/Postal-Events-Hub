<?php
session_start();
include("connect.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the ministry name is set in the session
if (!isset($_SESSION['ministryname'])) {
    echo json_encode(['error' => 'Ministry name not set in session']);
    exit;
}

// Query to fetch events for Post Offices under the logged-in Ministry
$query = "
    SELECT postname, eventname, eventdate, eventphoto
    FROM users
    LEFT JOIN events ON users.id = events.user_id
    WHERE users.divisionalname IN (
        SELECT divisionalname FROM users2 WHERE ministryname = ?
    )";

$stmt = $conn->prepare($query);
if (!$stmt) {
    echo json_encode(['error' => 'Database query preparation failed: ' . $conn->error]);
    exit;
}

$stmt->bind_param("s", $_SESSION['ministryname']);
if (!$stmt->execute()) {
    echo json_encode(['error' => 'Query execution failed: ' . $stmt->error]);
    exit;
}

$result = $stmt->get_result();
$postOffices = [];

// Fetching results and organizing them
while ($row = $result->fetch_assoc()) {
    $postname = $row['postname'];
    if (!isset($postOffices[$postname])) {
        $postOffices[$postname] = [
            'postname' => $postname,
            'events' => []
        ];
    }
    if ($row['eventname']) {
        $postOffices[$postname]['events'][] = [
            'eventname' => $row['eventname'],
            'eventdate' => $row['eventdate'],
            'eventphoto' => $row['eventphoto']
        ];
    }
}

header('Content-Type: application/json');
echo json_encode(array_values($postOffices));

$stmt->close();
$conn->close();
?>
