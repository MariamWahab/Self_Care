<?php
// Include database connection file
include '../settings/connection.php';
session_start();

// Check if user_id is provided
if (isset($_SESSION['UserID'])) {
    // Sanitize user_id input to prevent SQL injection
    $user_id = intval($_SESSION['UserID']);

    // Check if goal text and reminder time are provided
    if (isset($_POST['goal']) && isset($_POST['reminder'])) {
        // Prepare the SQL query with placeholders
        $query = "INSERT INTO goals (UserID, GoalText,ReminderTime) VALUES (?, ?, ?)";

        // Prepare and execute the statement
        if ($stmt = mysqli_prepare($connection, $query)) {
            // Bind the parameters to the placeholders directly from $_POST
            mysqli_stmt_bind_param($stmt, "iss", $user_id, $_POST['goal'],$_POST['reminder']);

            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // If insertion is successful, return success message
                echo json_encode(array('success' => true, 'message' => 'Goal added successfully'));
            } else {
                // If execution fails, return an error message
                echo json_encode(array('error' => 'Failed to execute query'));
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            // If preparation fails, return an error message
            echo json_encode(array('error' => 'Failed to prepare statement'));
        }
    } else {
        // If goal text or reminder time is not provided, return an error message
        echo json_encode(array('error' => 'Goal text or reminder time is not provided'));
    }

    // Close the database connection
    mysqli_close($connection);
} else {
    // If user_id is not provided, return an error message
    echo json_encode(array('error' => 'User ID is not provided'));
}
?>
