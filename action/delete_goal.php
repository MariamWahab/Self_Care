<?php
include '../settings/connection.php';
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['goal_id'])) {
        $goal_id = $_POST['goal_id'];

        $sql = "DELETE FROM goals WHERE GoalID = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $goal_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['deleteSuccess'] = true;
        } else {
            $_SESSION['deleteSuccess'] = false;
        }
        header('Location: ../view/goal.php');
        // exit;

        $stmt->close();
    } else {
        echo "Missing required parameters.";
    }
} else {
    echo "Wrong request method. Please try again.";
}


$connection->close();
?>
