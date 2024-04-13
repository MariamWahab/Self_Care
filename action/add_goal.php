<?php
include('../settings/connection.php');
session_start(); // Start the session

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Trim the goal name to remove leading and trailing white spaces
    $goalName = trim($_POST['goal']);
    $reminderTime = !empty($_POST['reminder']) ? $_POST['reminder'] : null; // Default to null if no reminder time provided

    // Check if the goal name is empty after trimming
    if (empty($goalName)) {
        $message = "Goal name cannot be empty.";
    } else {

        // Prepare and execute the SQL statement to insert the goal
        $sql = "INSERT INTO goals (GoalText, ReminderTime, UserID) VALUES (?, ?, ?)";

        $stmt = $connection->prepare($sql);
        // Assuming UserID is needed to link the goal to the user
        $user_id = 1; // Change this to fetch the actual user ID
        $stmt->bind_param("ssi", $goalName, $reminderTime, $user_id);
        $stmt->execute();

        // Check if the goal was successfully added
        if ($stmt->affected_rows > 0) {
            $message = "Goal added successfully.";
        } else {
            $message = "Error: Unable to add goal. Please try again.";
        }

        $stmt->close();
    }
} else {
    $message = "Wrong request method. Please try again.";
}

$connection->close();

// Reload the page after adding a goal
header("Location: ../view/goal.php?message=" . urlencode($message));
exit();