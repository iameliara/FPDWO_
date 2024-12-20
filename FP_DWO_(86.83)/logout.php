/*
 * author Saquib Shaikh
 * created on 20-12-2024-10h-04m
 * github: https://github.com/saquibshaikh14
 * copyright 2024
*/

<!-- logout.php -->
<?php
// logout.php
session_start();

// Destroy session
session_unset();
session_destroy();

// Redirect to login page
header('Location: index.php');
exit;
?>
