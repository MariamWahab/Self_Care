<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection file
    include '../settings/connection.php';

    // Check if the user is logged in
    session_start();
    if (!isset($_SESSION['UserID'])) {
        echo json_encode(array('status' => 'error', 'message' => 'User is not logged in.'));
        exit;
    }

    // Get post ID and comment text from the form
    $postID = $_POST['postID'];
    $commentText = $_POST['comment-text'];
    $userID = $_SESSION['UserID'];

    // Insert the comment into the database
    $insertQuery = "INSERT INTO Comments (PostID, UserID, CommentText, CommentDate) VALUES (?, ?, ?, NOW())";
    $statement = $connection->prepare($insertQuery);
    $statement->bind_param("iis", $postID, $userID, $commentText);

    if ($statement->execute()) {
        // Increment the comment count for the post
        $updateQuery = "UPDATE CommunityPosts SET CommentsCount = CommentsCount + 1 WHERE PostID = ?";
        $statement = $connection->prepare($updateQuery);
        $statement->bind_param("i", $postID);
        $statement->execute();

        // Successfully inserted comment, return success message
        echo json_encode(array('status' => 'success', 'message' => 'Comment added successfully.'));
    } else {
        // Error inserting comment
        echo json_encode(array('status' => 'error', 'message' => 'Error adding comment.'));
    }

    // Close the statement and database connection
    $statement->close();
    $connection->close();
} else {
    // Invalid request
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request.'));
}
?>
