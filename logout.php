<?php
// Start session
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the homepage or any other page you prefer
header("Location: index.php");
exit();
?>
