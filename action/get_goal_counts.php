<?php
include('../settings/connection.php');
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

// Fetch goal counts
$sql = "SELECT COUNT(*) AS completedGoals FROM Goals WHERE GoalStatus = 'complete' AND UserID = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($completedGoals);
$stmt->fetch();
$stmt->close();

$remainingGoals = 10 - $completedGoals; // Assuming there are 10 total goals

// Prepare JSON response
$response = [
    'success' => true,
    'completedGoals' => $completedGoals,
    'remainingGoals' => $remainingGoals
];

header('Content-Type: application/json');
echo json_encode($response);
?>
