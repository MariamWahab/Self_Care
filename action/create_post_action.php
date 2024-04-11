<?php
// Include database connection file
session_start();
include '../settings/connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the post text is provided
    if (isset($_POST['post-text']) && !empty($_POST['post-text'])) {
        // Get the post text from the form
        $postText = $_POST['post-text'];
        
        // Get the user ID (assuming it's stored in the session)
        if (!isset($_SESSION['UserID'])) {
            // If user is not logged in, redirect to login page or handle accordingly
            header("Location: ../login.php");
            exit();
        }
        $userID = $_SESSION['UserID'];

        // Prepare the SQL query to insert the post into the database
        $query = "INSERT INTO CommunityPosts (UserID, PostText, PostDate) VALUES (?, ?, NOW())";

        // Prepare and execute the statement
        $statement = $connection->prepare($query);
        $statement->bind_param("is", $userID, $postText);
        if ($statement->execute()) {
            // If insertion is successful, redirect to the community page or display a success message
            header("Location: ../view/community.php");
            exit();
        } else {
            // If insertion fails, display an error message
            echo "Error: " . $connection->error;
        }

        // Close the statement and database connection
        $statement->close();
        $connection->close();
    } else {
        // If post text is not provided, display an error message
        echo "Error: Post text is required";
    }
}
?>
