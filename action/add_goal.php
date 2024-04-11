<?php
include '../settings/connection.php';

$response = array('success' => false, 'goal_text' => '', 'reminder_time' => '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $goalName = $_POST['goal'];
    $reminderTime = isset($_POST['reminder']) ? $_POST['reminder'] : '12:00'; // Default reminder time if not provided

     
    $sql = "INSERT INTO Goals (GoalText, ReminderTime, UserID) VALUES (?, ?, ?)";

    $stmt = $connection->prepare($sql);
    // Assuming UserID is needed to link the goal to the user
    $user_id = 1; // Change this to fetch the actual user ID
    $stmt->bind_param("ssi", $goalName, $reminderTime, $user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $response['success'] = true;
        $response['goal_text'] = $goalName;
        $response['reminder_time'] = $reminderTime;
    } else {
        $response['message'] = "Error: Unable to add goal. Please try again.";
    }

    $stmt->close();
} else {
    $response['message'] = "Wrong request method. Please try again.";
}

$connection->close();
echo json_encode($response);
?>