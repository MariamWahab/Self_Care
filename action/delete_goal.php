<?php
include '../settings/connection.php';

$response = array('success' => false, 'message' => '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the request body
    $data = json_decode(file_get_contents("php://input"), true);

    // Check if the goal_id is present
    if (isset($data['goal_id'])) {
        $goal_id = $data['goal_id'];

        // Delete the goal from the database
        $sql = "DELETE FROM Goals WHERE GoalID = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $goal_id);
        $stmt->execute();

        // Check if the deletion was successful
        if ($stmt->affected_rows > 0) {
            $response['success'] = true;
            $response['message'] = "Goal deleted successfully.";
        } else {
            $response['message'] = "Error deleting goal. Please try again.";
        }

        $stmt->close();
    } else {
        $response['message'] = "Missing required parameters.";
    }
} else {
    $response['message'] = "Wrong request method. Please try again.";
}

$connection->close();

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
