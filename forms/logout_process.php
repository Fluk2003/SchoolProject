<?php
echo "logout";

session_start();
session_unset();  // Unset all session variables
session_destroy(); // Destroy the session

// Redirect to login page or home page
header("Location: ../index.php");
exit();
?>
