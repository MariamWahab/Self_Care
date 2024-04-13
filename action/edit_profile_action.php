<?php
// Include database connection file
include('../settings/connection.php');
include('../settings/core.php');

// Start session
session_start();

// Fetch user profile information from the database
$user_id = $_SESSION['UserID']; // Assuming 'UserID' is stored in the session

// Query to get user information
$user_sql = "SELECT * FROM users WHERE UserID = ?";
$user_stmt = $connection->prepare($user_sql);
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_result = $user_stmt->get_result();

// Initialize variables to store user information
$fname = $lname = $email = $dob = $gender = '';

// Fetch user information
if ($user_row = $user_result->fetch_assoc()) {
    // Assign fetched values to variables
    $fname = $user_row['FirstName'];
    $lname = $user_row['LastName'];
    $email = $user_row['Email'];
    $dob = $user_row['DateOfBirth'];
    $gender = $user_row['Gender'];
}

$user_stmt->close();

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];

    // Prepare update statement
    $sql = "UPDATE users SET FirstName=?, LastName=?, Email=?, DateOfBirth=?, Gender=? WHERE UserID=?";
    if ($stmt = $connection->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("sssssi", $fname, $lname, $email, $dob, $gender, $_SESSION['UserID']);
        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to profile page after successful update
            header("Location: ../view/profile.php");
            exit();
        } else {
            // Set error message if update fails
            $errorMsg = "Failed to update profile. Please try again later.";
        }
        // Close the prepared statement
        $stmt->close();
    } else {
        // Set error message if preparation fails
        $errorMsg = "Database error. Please try again later.";
    }
}

// Close database connection
$connection->close();

// If there's an error or direct access without POST request, redirect to profile page with error message
if (!empty($errorMsg)) {
    header("Location: ../view/profile.php?error=" . urlencode($errorMsg));
    exit();
}
?>
