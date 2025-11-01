<?php
session_start();
include("connect.php");

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: loginministry.php");
    exit();
}

// Ministry name from session
$ministryName = $_SESSION['ministryname'];

// Fetch Divisional Offices under this Ministry
$divisionsQuery = "SELECT id, divisionalname FROM users2 WHERE ministryname = ?";
$stmt = $conn->prepare($divisionsQuery);
if (!$stmt) {
    die("Error preparing the statement: " . $conn->error);
}
$stmt->bind_param("s", $ministryName);
$stmt->execute();
$divisions = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ministry Office Dashboard</title>
    <link rel="stylesheet" href="css/ministrydashboard.css">
    <script src="js/ministrydashboard.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <div class="navbar">
            <img src="images/logo.jpg" alt="Ministry Logo" class="logo">
            <h1>Ministry Office Dashboard</h1>
            <a href="logoutministry.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </header>

    <div class="main-container">
        <aside class="dashboard-menu">
            <ul>
                <li><a href="#" onclick="showSection('divisional-offices-section')"><i class="fas fa-building"></i> Divisional Offices</a></li>
                <li><a href="#" onclick="showSection('events-divisional-section')"><i class="fas fa-calendar-check"></i> Celebrated Events by Divisional Office</a></li>
                <li><a href="#" onclick="showSection('events-post-office-section')"><i class="fas fa-calendar-check"></i> Celebrated Events by Post Office</a></li>
            </ul>
        </aside>

        <section class="dashboard-content">
            <h2>Welcome to the Ministry Office Dashboard</h2>
            <p>Select an option from the menu to get started.</p>

            <!-- Divisional Offices Section -->
            <section id="divisional-offices-section" class="hidden">
                <h3>Divisional Offices</h3>
                <?php if ($divisions->num_rows > 0): ?>
                    <ul>
                    <?php while ($division = $divisions->fetch_assoc()): ?>
                        <li><?php echo htmlspecialchars($division['divisionalname']); ?></li>
                    <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p>No Divisional Offices under this Ministry.</p>
                <?php endif; ?>
            </section>

            <!-- Celebrated Events by Divisional Offices Section -->
            <section id="events-divisional-section" class="hidden">
                <h3>Events Celebrated by Divisional Offices</h3>
                <?php
                // Re-run the divisions query to fetch divisions again for this section
                $stmt->execute();
                $divisions = $stmt->get_result();

                while ($division = $divisions->fetch_assoc()):
                ?>
                    <h4><?php echo htmlspecialchars($division['divisionalname']); ?></h4>
                    <?php
                    $divisionalEventsQuery = "
                        SELECT event_name, event_date, event_photo
                        FROM events2
                        WHERE user_id IN (
                            SELECT id FROM users2 WHERE divisionalname = ?
                        )";
                    $divisionalEventStmt = $conn->prepare($divisionalEventsQuery);
                    $divisionalEventStmt->bind_param("s", $division['divisionalname']);
                    $divisionalEventStmt->execute();
                    $divisionalEventsResult = $divisionalEventStmt->get_result();

                    if ($divisionalEventsResult->num_rows > 0) {
                        echo "<h5>Celebrated Events:</h5><ul>";
                        while ($event = $divisionalEventsResult->fetch_assoc()) {
                            echo "<li><strong>" . htmlspecialchars($event['event_name']) . "</strong><br>";
                            echo "Date: " . htmlspecialchars($event['event_date']) . "<br>";
                            if (!empty($event['event_photo'])) {
                                echo "<img src='uploads/" . htmlspecialchars($event['event_photo']) . "' alt='" . htmlspecialchars($event['event_name']) . "' style='width:100px; height:auto;'><br>";
                            } else {
                                echo "<p>No image available for this event.</p>";
                            }
                            echo "</li><hr>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<p>No events celebrated by this Divisional Office.</p>";
                    }
                    $divisionalEventStmt->close();
                    ?>
                <?php endwhile; ?>
            </section>

            <!-- Celebrated Events by Post Offices Section -->
            <section id="events-post-office-section" class="hidden">
                <h3>Events Celebrated by Post Offices</h3>
                <?php
                $postOfficesQuery = "SELECT id, postname FROM users WHERE divisionalname IN (SELECT divisionalname FROM users2 WHERE ministryname = ?)";
                $postStmt = $conn->prepare($postOfficesQuery);
                $postStmt->bind_param("s", $ministryName);
                $postStmt->execute();
                $postOfficesResult = $postStmt->get_result();

                if ($postOfficesResult->num_rows > 0) {
                    echo "<h5>Post Offices:</h5><ul>";
                    while ($postOffice = $postOfficesResult->fetch_assoc()) {
                        echo "<li>" . htmlspecialchars($postOffice['postname']) . "</li>";
                        
                        // Fetch events for this Post Office
                        $eventsQuery = "SELECT eventname, eventdate, eventphoto FROM events WHERE user_id = ?";
                        $eventStmt = $conn->prepare($eventsQuery);
                        $eventStmt->bind_param("i", $postOffice['id']);
                        $eventStmt->execute();
                        $eventResult = $eventStmt->get_result();

                        if ($eventResult->num_rows > 0) {
                            echo "<ul>";
                            while ($event = $eventResult->fetch_assoc()) {
                                echo "<li><strong>" . htmlspecialchars($event['eventname']) . "</strong><br>";
                                echo "Date: " . htmlspecialchars($event['eventdate']) . "<br>";
                                if (!empty($event['eventphoto'])) {
                                    echo "<img src='uploads/" . htmlspecialchars($event['eventphoto']) . "' alt='" . htmlspecialchars($event['eventname']) . "' style='width:100px; height:auto;'><br>";
                                } else {
                                    echo "<p>No image available for this event.</p>";
                                }
                                echo "</li><hr>";
                            }
                            echo "</ul>";
                        } else {
                            echo "<p>No events celebrated by this Post Office.</p>";
                        }
                        $eventStmt->close();
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No Post Offices under this Ministry.</p>";
                }
                $postStmt->close();
                ?>
            </section>
        </section>
    </div>

    <footer>
        <p>&copy; 2024 Postal Events Hub - Ministry Office Dashboard </p>
    </footer>

    <script>
        // JavaScript function to show/hide sections
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.dashboard-content > section');
            sections.forEach(section => {
                section.classList.add('hidden'); // Hide all sections
            });
            if (sectionId) {
                document.getElementById(sectionId).classList.remove('hidden'); // Show the selected section
            }
        }
    </script>
</body>
</html>
