<?php
include('../settings/connection.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if goal_id and status parameters are set
    if (isset($_POST['goal_id'], $_POST['goal_status'])) {
        // Sanitize and validate input
        $goal_id = intval($_POST['goal_id']);
        $status = ($_POST['goal_status'] === "complete") ? "complete" : "incomplete";

        // Prepare and execute the SQL statement
        $sql = "UPDATE goals SET GoalStatus = ? WHERE GoalID = ?";
        $stmt = $connection->prepare($sql);

        // Check if the statement was prepared successfully
        if (!$stmt) {
            $message = "Failed to prepare statement.";
        } else {
            $stmt->bind_param("si", $status, $goal_id);

            // Execute the statement
            if ($stmt->execute()) {
                $message = "Goal status updated successfully.";
            } else {
                $message = "Failed to update goal status.";
            }

            // Close the statement
            $stmt->close();
        }
    } else {
        $message = "Missing goal_id or status parameter.";
    }

} else {
    $message = "Invalid request method.";
}

// Close the database connection
$connection->close();

// Redirect back to the goals page with a message
header("Location: ../view/goal.php?msg=" . urlencode($message));
exit();


