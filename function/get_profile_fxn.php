<?php
// Include database connection file
include('../settings/connection.php');
include('../settings/core.php');

// Fetch user profile information from the database
$user_id = $_SESSION['UserID']; // Assuming 'UserID' is stored in the session

// Query to get user information
$user_sql = "SELECT * FROM Users WHERE UserID = ?";
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

// Close database connection
$connection->close();

// Return profile information as JSON
echo json_encode([
    'fname' => $fname,
    'lname' => $lname,
    'email' => $email,
    'dob' => $dob,
    'gender' => $gender
]);
?>
