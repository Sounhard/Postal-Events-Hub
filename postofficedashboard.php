<?php
session_start();
include("connect.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: loginpostoffice.php");
    exit();
}

// Fetch submitted events for the logged-in user
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT eventid, eventname AS event_name, eventdate AS event_date, eventphoto AS event_photo FROM events WHERE user_id = ?");
if ($stmt === false) {
    die("Error preparing the statement: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$submitted_events = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $submitted_events[] = $row;
    }
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Office Dashboard</title>
    <link rel="stylesheet" href="css/postofficedashboard.css">
    <script src="js/postofficedashboard.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <div class="navbar">
            <img src="images/logo.jpg" alt="Post Office Logo" class="logo">
            <h1>Post Office Dashboard</h1>
            <a href="logoutpostoffice.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </header>
    
    <div class="main-container">
        <aside class="dashboard-menu">
            <ul>
                <!-- <li><a href="#" onclick="showSection('event-list-section')"><i class="fas fa-list"></i> Activities</a></li> -->
                <li><a href="#" onclick="showSection('upcoming-activities-section')"><i class="fas fa-calendar-alt"></i> All Events list</a></li>
                <li><a href="#" onclick="showSection('submission-form-section')"><i class="fas fa-plus-circle"></i> Submit Event</a></li>
                <li><a href="#" onclick="showSection('submitted-events-section')"><i class="fas fa-chart-line"></i> Submitted Events</a></li>
            </ul>
        </aside>
        
        <section class="dashboard-content" id="dashboard-content">
            <h2>Welcome to the Post Office Dashboard</h2>
            <p>Select an option from the menu to get started.</p>

            <!-- Event List Section -->
            <section id="event-list-section" class="hidden">
                <ul id="event-list"></ul>
            </section>

            <!-- Event Submission Form -->
            <section id="submission-form-section" class="hidden">
                <h3>Submit Completed Event</h3>
                <form id="event-form" enctype="multipart/form-data" action="submit_event_postoffice.php" method="POST">
                    <label for="event-name">Event Name:</label>
                    <input type="text" id="event-name" name="event_name" required>
                    
                    <label for="event-date">Event Date:</label>
                    <input type="date" id="event-date" name="event_date" required>
                    
                    <label for="event-photo">Upload Photo:</label>
                    <input type="file" id="event-photo" name="event_photo" accept="image/*" required>
                    
                    <button type="submit">Submit</button>
                </form>
            </section>

            <!-- Submitted Events Section -->
            <section id="submitted-events-section" class="hidden">
                <h3>Submitted Events</h3>
                <ul id="submitted-events">
                    <?php if (!empty($submitted_events)): ?>
                        <?php foreach ($submitted_events as $event): ?>
                            <li>
                                <strong><?= htmlspecialchars($event['event_name']) ?></strong> - <?= htmlspecialchars($event['event_date']) ?>
                                <?php if ($event['event_photo']): ?>
                                    <img src="<?= 'uploads/' . htmlspecialchars($event['event_photo']) ?>" alt="Event Photo" width="100" height="100">
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No submitted events found.</li>
                    <?php endif; ?>
                </ul>
            </section>

            <!-- Upcoming Activities Section -->
            <section id="upcoming-activities-section" class="hidden">
                <h3>All Events list</h3>
                <ul>
    <li>
        <strong>Community Clean-Up</strong> - March 15, 2024
        <p>A day dedicated to cleaning the neighborhood.</p>
    </li>
    <li>
        <strong>Tree Plantation Drive</strong> - April 10, 2024
        <p>Planting trees to enhance greenery in the area.</p>
    </li>
    <li>
        <strong>Health Awareness Camp</strong> - May 5, 2024
        <p>Free health check-ups and health awareness sessions.</p>
    </li>
    <li>
        <strong>Cultural Fest</strong> - June 20, 2024
        <p>A celebration of culture and tradition in our community.</p>
    </li>
    <li>
        <strong>World Post Day Celebration</strong> - October 9, 2024
        <p>Commemorating the importance of postal services worldwide.</p>
    </li>
    <li>
        <strong>Blood Donation Camp</strong> - November 15, 2024
        <p>Encouraging community members to donate blood for a noble cause.</p>
    </li>
    <li>
        <strong>Philately Exhibition</strong> - December 5, 2024
        <p>Showcasing rare and unique stamps to promote philately.</p>
    </li>
    <li>
        <strong>Digital Payment Awareness Drive</strong> - January 10, 2025
        <p>Educating the public about digital payment options and their benefits.</p>
    </li>
    <li>
        <strong>Financial Literacy Workshop</strong> - February 14, 2025
        <p>Sessions on saving, investing, and managing finances effectively.</p>
    </li>
    <li>
        <strong>Customer Grievance Redressal Camp</strong> - March 22, 2025
        <p>Addressing customer issues and improving services.</p>
    </li>
    <li>
        <strong>Philately Workshop for Students</strong> - April 5, 2025
        <p>An educational session on stamp collecting and its importance.</p>
    </li>
    <li>
        <strong>Children’s Day Stamp Exhibition</strong> - November 14, 2024
        <p>A fun and educational event for children to explore stamps.</p>
    </li>
    <li>
        <strong>Aadhaar Enrollment Drive</strong> - May 18, 2024
        <p>Helping residents enroll or update their Aadhaar information.</p>
    </li>
    <li>
        <strong>Senior Citizen Savings Awareness Camp</strong> - June 12, 2024
        <p>Highlighting benefits of the Senior Citizen Savings Scheme.</p>
    </li>
    <li>
        <strong>Letter Writing Competition</strong> - July 7, 2024
        <p>An event to revive the art of letter writing.</p>
    </li>
    <li>
        <strong>Swachh Bharat Drive</strong> - August 15, 2024
        <p>A clean-up initiative under the Swachh Bharat mission.</p>
    </li>
    <li>
        <strong>Postal Heritage Tour</strong> - September 20, 2024
        <p>A tour showcasing the history of postal services in India.</p>
    </li>
    <li>
        <strong>National Postal Week Activities</strong> - October 9-15, 2024
        <p>Events and activities to celebrate National Postal Week.</p>
    </li>
    <li>
        <strong>Postal Life Insurance Awareness</strong> - November 25, 2024
        <p>Promoting the benefits of Postal Life Insurance (PLI).</p>
    </li>
    <li>
        <strong>Speed Post Delivery Awareness</strong> - December 12, 2024
        <p>Highlighting the features and benefits of Speed Post services.</p>
    </li>
    <li>
        <strong>Business Solutions Campaign</strong> - January 15, 2025
        <p>Showcasing customized solutions for small and medium enterprises.</p>
    </li>
</ul>

            </section>
        </section>
    </div>

    <footer>
        <p>&copy; 2024 Postal Events Hub - Post Office Dashboard </p>
    </footer>
</body>
</html>
