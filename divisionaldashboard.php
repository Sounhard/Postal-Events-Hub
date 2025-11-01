<?php
session_start();
include("connect.php");

// Check if the Divisional Office user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: logindivisional.php");
    exit();
}

// Check if divisionname is set in the session
if (!isset($_SESSION['divisionalname'])) {
    die("Division name is not set in session.");
}

$division_name = $_SESSION['divisionalname'];
$user_id = $_SESSION['user_id']; // Get the user ID from the session

// Fetch post offices under the division
$stmt = $conn->prepare("SELECT postname FROM users WHERE divisionalname = ?");
$stmt->bind_param("s", $division_name);
$stmt->execute();
$post_offices = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Fetch events for each post office under this division
$post_office_events = [];
foreach ($post_offices as $office) {
    $postname = $office['postname'];
    
    $stmt = $conn->prepare("SELECT e.eventname, e.eventdate, e.eventphoto FROM events e JOIN users u ON e.user_id = u.id WHERE u.postname = ?");
    $stmt->bind_param("s", $postname);
    $stmt->execute();
    $event_result = $stmt->get_result();
    $post_office_events[$postname] = $event_result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

// Fetch submitted events by the Divisional Office user
$stmt = $conn->prepare("SELECT event_name, event_date, description, location, status, event_photo FROM events2 WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$submitted_events = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Handle event submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit_event'])) {
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    
    // You can set the status as 'pending' or 'submitted' based on your requirements
    $status = 'submitted';

    // Handle file upload
    if (isset($_FILES['event_photo']) && $_FILES['event_photo']['error'] == 0) {
        $target_dir = "uploads/";
        $event_photo = basename($_FILES['event_photo']['name']);
        $target_file = $target_dir . $event_photo;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['event_photo']['tmp_name'], $target_file)) {
            // Prepare the SQL statement to insert the event with the image
            $stmt = $conn->prepare("INSERT INTO events2 (user_id, event_name, event_date, description, location, status, event_photo) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssss", $user_id, $event_name, $event_date, $description, $location, $status, $event_photo);

            if ($stmt->execute()) {
                // Redirect or display a success message
                $_SESSION['success_message'] = "Event submitted successfully!";
            } else {
                $_SESSION['error_message'] = "Error submitting event: " . $stmt->error;
            }
        } else {
            $_SESSION['error_message'] = "Error uploading file.";
        }
    } else {
        $_SESSION['error_message'] = "No file uploaded or upload error.";
    }

    $stmt->close();
    // Refresh the page to see the newly submitted event
    header("Location: divisionaldashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Divisional Office Dashboard</title>
    <link rel="stylesheet" href="css/divisionaldahboard.css">
    <script src="js/divisionaldashboard.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.dashboard-content section');
            sections.forEach(section => section.classList.toggle('hidden', section.id !== sectionId));
        }
    </script>
</head>
<body>
    <header>
        <div class="navbar">
            <img src="images/logo.jpg" alt="Logo" class="logo">
            <h1>Divisional Office Dashboard</h1>
            <a href="logoutdivisional.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </header>
    
    <div class="main-container">
        <aside class="dashboard-menu">
            <ul>
                <li><a href="#" onclick="showSection('post-office-list-section')"><i class="fas fa-building"></i> Post Offices</a></li>
                <li><a href="#" onclick="showSection('celebrated-events-section')"><i class="fas fa-calendar-check"></i> Celebrated Events by Post Offices</a></li>
                <li><a href="#" onclick="showSection('upcoming-activities-section')"><i class="fas fa-calendar-alt"></i>Events list for divisional</a></li>
                 <li><a href="#" onclick="showSection('submit-event-section')"><i class="fas fa-plus"></i> Submit Event</a></li>
                <li><a href="#" onclick="showSection('submitted-events-section')"><i class="fas fa-paper-plane"></i> Submitted Events by divisional</a></li>
                
            </ul>
        </aside>
        
        <section class="dashboard-content">
            <section id="post-office-list-section">
                <h3>Post Offices Under This Division</h3>
                <ul>
                    <?php foreach ($post_offices as $office): ?>
                        <li><?= htmlspecialchars($office['postname']) ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>

            <section id="celebrated-events-section" class="hidden">
                <h3>Events Celebrated by Post Offices</h3>
                <?php foreach ($post_office_events as $postname => $events): ?>
                    <h4><?= htmlspecialchars($postname) ?> celebrated:</h4>
                    <?php if (!empty($events)): ?>
                        <ul>
                            <?php foreach ($events as $event): ?>
                                <li>
                                    <strong><?= htmlspecialchars($event['eventname']) ?></strong> on <?= htmlspecialchars($event['eventdate']) ?>
                                    <?php if ($event['eventphoto']): ?>
                                        <img src="<?= 'uploads/' . htmlspecialchars($event['eventphoto']) ?>" alt="Event Photo" width="100">
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No events found for <?= htmlspecialchars($postname) ?>.</p>
                    <?php endif; ?>
                <?php endforeach; ?>
            </section>

            <section id="submitted-events-section" class="hidden">
                <h3>Your Submitted Events</h3>
                <?php if (!empty($submitted_events)): ?>
                    <ul>
                        <?php foreach ($submitted_events as $event): ?>
                            <li>
                                <strong><?= htmlspecialchars($event['event_name']) ?></strong> on <?= htmlspecialchars($event['event_date']) ?> - 
                                <?= htmlspecialchars($event['description']) ?> at <?= htmlspecialchars($event['location']) ?> (Status: <?= htmlspecialchars($event['status']) ?>)
                                <?php if (!empty($event['event_photo'])): ?>
                                    <br>
                                    <img src="<?= 'uploads/' . htmlspecialchars($event['event_photo']) ?>" alt="Event Photo" width="100">
                                <?php else: ?>
                                    <p>No image available for this event.</p>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No submitted events found.</p>
                <?php endif; ?>
            </section>


            <section id="upcoming-activities-section" class="hidden">
                <h3>Events list for divisional</h3>
                <ul>
    <li>
        <strong>Divisional Office Training Program</strong> - January 15, 2024
        <p>A training program for post office staff on operational procedures and technology updates.</p>
    </li>
    <li>
        <strong>Postal Network Expansion Meeting</strong> - February 10, 2024
        <p>A meeting to plan and discuss the expansion of postal networks in underserved areas.</p>
    </li>
    <li>
        <strong>Inter-Office Coordination Workshop</strong> - March 5, 2024
        <p>A workshop to enhance collaboration and communication among post offices in the division.</p>
    </li>
    <li>
        <strong>Financial Inclusion Awareness Drive</strong> - April 20, 2024
        <p>Campaigns to promote government schemes like Jan Dhan Yojana and Sukanya Samriddhi Yojana.</p>
    </li>
    <li>
        <strong>Divisional Philately Day</strong> - May 15, 2024
        <p>An exhibition showcasing philately collections from all post offices in the division.</p>
    </li>
    <li>
        <strong>Grievance Redressal Camp</strong> - June 25, 2024
        <p>A special day dedicated to resolving public complaints at divisional and post office levels.</p>
    </li>
    <li>
        <strong>Technology Upgradation Drive</strong> - July 12, 2024
        <p>Introduction of new technologies or software systems for operational efficiency.</p>
    </li>
    <li>
        <strong>Stamp Design Competition</strong> - August 7, 2024
        <p>Inviting entries from the public to design new stamps, hosted by the divisional office.</p>
    </li>
    <li>
        <strong>Annual Performance Review Meet</strong> - September 18, 2024
        <p>Reviewing the yearly performance of all post offices under the division.</p>
    </li>
    <li>
        <strong>Divisional Sports and Cultural Fest</strong> - October 22, 2024
        <p>Sports and cultural activities for employees to foster team spirit.</p>
    </li>
</ul>

            </section>





            <section id="submit-event-section" class="hidden">
                <h3>Submit an Event</h3>
                <?php if (isset($_SESSION['success_message'])): ?>
                    <p class="success-message"><?= $_SESSION['success_message'] ?></p>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['error_message'])): ?>
                    <p class="error-message"><?= $_SESSION['error_message'] ?></p>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="event_name">Event Name:</label>
                    <input type="text" name="event_name" required>

                    <label for="event_date">Event Date:</label>
                    <input type="date" name="event_date" required>

                    <label for="event_photo">Event Photo:</label>
                    <input type="file" name="event_photo" accept="image/*" required>

                    <button type="submit" name="submit_event">Submit Event</button>
                </form>
            </section>
        </section>
    </div>

    <footer>
        <p>&copy; 2024 Postal Events Hub - Divisional Office Dashboard </p>
    </footer>
</body>
</html>
