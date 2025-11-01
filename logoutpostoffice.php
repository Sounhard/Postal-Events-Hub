<?php
session_start();             // Starts the session to access session data
session_destroy();            // Destroys the session and removes all session variables
header("Location: index.html"); // Redirects the user to the login page
exit();                       // Ensures no further code is executed after the redirection

?>
