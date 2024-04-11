<?php
session_start();

// function isLoggedIn() {
//     return isset($_SESSION['UserID']);
// }
// Function to check for login using user ID session
function loginCheck() {
    // Check if user ID session exists
    if (!isset($_SESSION['UserID'])) {
        // Redirect to login page
        header("Location: ../login/login.php");
        die(); // Stop further execution
    }
}

loginCheck();

// Function to check for user role ID session
// function checkUserRole() {
//     // Check if user role ID session exists
//     if (!isset($_SESSION['user_role_id'])) {
//         return false; // Return false if session doesn't exist
//     } else {
//         return $_SESSION['user_role_id']; // Return user role ID
//     }
// }
?>
