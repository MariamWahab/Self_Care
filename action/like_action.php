<?php
session_start();
include '../settings/connection.php';
// include '../settings/core.php';

// Check if the user is logged in (you may need to implement user authentication)
// For demonstration purposes, let's assume the user ID is stored in a session variable
if (!isset($_SESSION['UserID'])) {
    echo json_encode(array('status' => 'error', 'message' => 'User is not logged in.'));
    exit;
}

// Get post ID from the request
if (isset($_POST['postID'])) {
    $postID = $_POST['postID'];
    
    // Check if the user has already liked the post
    $userID = $_SESSION['UserID'];
    $checkQuery = "SELECT * FROM Likes WHERE UserID = $userID AND PostID = $postID";
    $checkResult = $connection->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // User has already liked the post, return error message
        echo json_encode(array('status' => 'error', 'message' => 'You have already liked this post.'));
    } else {
        // User has not liked the post, insert a new like record
        $insertQuery = "INSERT INTO Likes (UserID, PostID) VALUES ($userID, $postID)";
        if ($connection->query($insertQuery) === TRUE) {
            // Increment the like count for the post
            $updateQuery = "UPDATE CommunityPosts SET Likes = Likes + 1 WHERE PostID = $postID";
            $connection->query($updateQuery);

            // Successfully inserted like, return success message
            echo json_encode(array('status' => 'success', 'message' => 'Post liked successfully.'));
        } else {
            // Error inserting like
            echo json_encode(array('status' => 'error', 'message' => 'Error liking the post.'));
        }
    }
}    
// } else {
//     // Invalid request, post ID not provided
//     echo json_encode(array('status' => 'error', 'message' => 'Post ID not provided.'));
// }

// Close the database connection
$connection->close();
?>
