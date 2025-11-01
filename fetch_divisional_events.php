<?php
session_start();
include("connect.php");

// Check if the ministry name is set in the session
if (!isset($_SESSION['ministryname'])) {
    echo json_encode(['error' => 'Ministry name not set in session']);
    exit;
}

// Ministry name from session
$ministryName = $_SESSION['ministryname'];

// Fetch Divisional Offices under this Ministry
$divisionsQuery = "SELECT divisionalname FROM users2 WHERE ministryname = ?";
$stmt = $conn->prepare($divisionsQuery);
if (!$stmt) {
    echo json_encode(['error' => 'Database query preparation failed: ' . $conn->error]);
    exit;
}

$stmt->bind_param("s", $ministryName);
$stmt->execute();
$divisionsResult = $stmt->get_result();

$divisions = [];

while ($division = $divisionsResult->fetch_assoc()) {
    $divisionName = $division['divisionalname'];
    
    // Fetch events for this Divisional Office
    $eventsQuery = "
        SELECT event_name, event_date, event_photo
        FROM events2
        WHERE user_id IN (
            SELECT id FROM users2 WHERE divisionalname = ?
        )";
    $eventStmt = $conn->prepare($eventsQuery);
    if (!$eventStmt) {
        echo json_encode(['error' => 'Event query preparation failed: ' . $conn->error]);
        exit;
    }
    
    $eventStmt->bind_param("s", $divisionName);
    $eventStmt->execute();
    $eventResult = $eventStmt->get_result();

    $events = [];
    while ($event = $eventResult->fetch_assoc()) {
        $events[] = $event;
    }

    $divisions[] = [
        'divisionalname' => $divisionName,
        'events' => $events
    ];
}

header('Content-Type: application/json');
echo json_encode($divisions);

// Close the statement and connection
$stmt->close();
$eventStmt->close();
$conn->close();
?>
