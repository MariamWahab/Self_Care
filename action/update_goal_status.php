<?php
include('../settings/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['goal_id']) && isset($_POST['status'])) {
        $goal_id = intval($_POST['goal_id']);
        $status = htmlspecialchars($_POST['status']);

        if ($status !== "complete" && $status !== "incomplete") {
            echo json_encode(array("success" => false, "message" => "Invalid status parameter."));
            exit;
        }

        $sql = "UPDATE Goals SET GoalStatus = ? WHERE GoalID = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("si", $status, $goal_id);

        if ($stmt->execute()) {
            $response = array("success" => true);
        } else {
            $response = array("success" => false, "message" => "Failed to update goal status.");
        }

        $stmt->close();
        echo json_encode($response);
    } else {
        echo json_encode(array("success" => false, "message" => "Missing goal_id or status parameter."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request method."));
}

$connection->close();
