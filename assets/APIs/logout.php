<?php
session_start();

// Unset specific session variables
unset($_SESSION['user_name']);
unset($_SESSION['position']);

session_destroy();

header('Location: ../../index.php');
exit(); 
?>