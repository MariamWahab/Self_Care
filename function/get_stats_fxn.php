<?php
// Include the file containing the database connection
include '../settings/connection.php';

session_start();

// Check if user_id is set in session
if (isset($_SESSION['UserID'])) {
    $user_id = $_SESSION['UserID'];

    // Prepare SQL query to count completed and incomplete goals
    $sql = "SELECT 
                SUM(CASE WHEN GoalStatus = 'complete' THEN 1 ELSE 0 END) AS completed_goals,
                SUM(CASE WHEN GoalStatus = 'incomplete' THEN 1 ELSE 0 END) AS incomplete_goals
            FROM Goals
            WHERE UserID = ?";

    // Prepare the statement
    $stmt = $connection->prepare($sql);

    if ($stmt) {
        // Bind the user ID parameter
        $stmt->bind_param("i", $user_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Get the result
            $result = $stmt->get_result();

            // Fetch result as associative array
            $row = $result->fetch_assoc();

            // Check if the row is fetched successfully
            if ($row) {
                // Output result as JSON
                echo json_encode(array(
                    'completedGoals' => $row['completed_goals'],
                    'incompleteGoals' => $row['incomplete_goals']
                ));
            } else {
                // Handle case where no data is fetched
                echo json_encode(array('error' => 'No data found'));
            }
        } else {
            // Handle execution error
            echo json_encode(array('error' => 'Failed to execute query'));
        }

        // Close statement
        $stmt->close();
    } else {
        // Handle preparation error
        echo json_encode(array('error' => 'Failed to prepare statement'));
    }
} else {
    // If user_id is not set in session, return an error message
    echo json_encode(array('error' => 'User ID is not provided'));
}

// Close connection
$connection->close();
?>
