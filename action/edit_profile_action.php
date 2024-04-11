<?php
// Include database connection file
include('../settings/connection.php');
include('../settings/core.php');

// Get form data
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];

// Prepare update statement
$sql = "UPDATE Users SET FirstName=?, LastName=?, Email=?, DateOfBirth=?, Gender=? WHERE UserID=?";
if ($stmt = $connection->prepare($sql)) {
    $stmt->bind_param("sssssi", $fname, $lname, $email, $dob, $gender, $_SESSION['UserID']);
    if ($stmt->execute()) {
        // Redirect back to profile page after successful update
        header("Location: ../view/profile.php");
        exit();
    } else {
        // Redirect to an error page if update fails
        header("Location: error.php");
        exit();
    }
} else {
    // Redirect to an error page if preparation fails
    header("Location: error.php");
    exit();
}

// Close statement and database connection
// $stmt->close();
// $connection->close();

