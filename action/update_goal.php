<?php
include '../settings/connection.php';

$response = array('success' => false, 'message' => '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the request body
    $data = json_decode(file_get_contents("php://input"), true);

    // Check if all required fields are present and the goal text is not empty
    if (isset($data['goal_id'], $data['text'], $data['reminder'])) {
        $goal_id = $data['goal_id'];
        $new_goal_text = $data['text'];
        $new_reminder = $data['reminder'];

        // Update the goal in the database
        $sql = "UPDATE Goals SET GoalText = ?, ReminderTime = ? WHERE GoalID = ?";
        $stmt = $connection->prepare($sql);
        if (!$stmt) {
            $response['message'] = "Error preparing statement: " . $connection->error;
        } else {
            $stmt->bind_param("ssi", $new_goal_text, $new_reminder, $goal_id);
            $stmt->execute();

            // Check if the update was successful
            if ($stmt->affected_rows > 0) {
                $response['success'] = true;
                $response['new_goal_text'] = $new_goal_text;
                $response['new_reminder_time'] = $new_reminder;
                $response['message'] = "Goal updated successfully.";
            } else {
                $response['message'] = "Error updating goal. Please try again.";
            }

            $stmt->close();
        }
    } else {
        $response['message'] = "Missing required parameters or empty goal text.";
    }
} else {
    $response['message'] = "Wrong request method. Please try again.";
}

$connection->close();

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
