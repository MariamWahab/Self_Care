<?php
include '../settings/connection.php';
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['goal_id'], $_POST['new_goal_text'], $_POST['new_reminder'])) {
        $goal_id = $_POST['goal_id'];
        $new_goal_text = $_POST['new_goal_text']; // Corrected variable name
        $new_reminder = $_POST['new_reminder']; // Corrected variable name

        $sql = "UPDATE goals SET GoalText = ?, ReminderTime = ? WHERE GoalID = ?";
        $stmt = $connection->prepare($sql);
        if (!$stmt) {
            echo "Error preparing statement: " . $connection->error;
        } else {
            $stmt->bind_param("ssi", $new_goal_text, $new_reminder, $goal_id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "Goal updated successfully.";
            } else {
                echo "Error updating goal. Please try again.";
            }

            $stmt->close();
        }
    } else {
        echo "Missing required parameters or empty goal text.";
    }
} else {
    echo "Wrong request method. Please try again.";
}

$connection->close();
