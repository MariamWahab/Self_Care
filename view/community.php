<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Community</title>
    <link rel="stylesheet" href="../css/community.css">
    <link rel="stylesheet" href="../css/nav-bar.css">
</head>
<body>
<?php
// Include database connection file
include '../settings/connection.php';

// Function to format the date
function formatDate($dateString) {
    return date('F j, Y', strtotime($dateString));
}

// Retrieve the message parameter from the URL
$message = isset($_GET['msg']) ? $_GET['msg'] : 'goal';
?>

<header>
    <div class="nav-bar">
        <div class="nav-bar-title">
           Interactive Community
        </div>

        <nav>
            <ul>
                <li class="<?php echo ($message === 'home' || $message === '') ? 'active' : '';?>"><a href="homePage.php">Home</a></li>
                <li class="<?php echo ($message === 'goal' || $message === '') ? 'active' : '';?>"><a href="goal.php">Goal</a></li>
                <li class="<?php echo ($message === 'skinCare' || $message === '') ? 'active' : '';?>"><a href="skinCare.php?msg=skin_Care">Skin Care Corner</a></li>
                <li class="<?php echo ($message === 'exercise' || $message === '') ? 'active' : '';?>"><a href="exercise.php?msg=exercise">Exercises</a></li>
                <li class="<?php echo ($message === 'wellnessTips' || $message === '') ? 'active' : '';?>"><a href="wellness.php?msg=wellnessTips">Wellness Tips</a></li>
                <li class="<?php echo ($message === 'profile' || $message === '') ? 'active' : '';?>"><a href="profile.php?msg=profile">Profile</a></li>
            </ul>
        </nav>
    </div>
</header>

<main>
    <section id="create-post">
        <h2>Create Post</h2>
        <form action="../action/create_post_action.php" method="POST">
            <input type="hidden" name="postID" value="<?php echo $row['PostID']; ?>">
            <textarea name="post-text" id="post-text" rows="4" placeholder="Write your post..."></textarea>
            <button type="submit">Post</button>
        </form>
    </section>

    <section id="posts">
        <h2>Posts</h2>
        <!-- PHP code to fetch and display posts -->
        <?php
        // Query to fetch posts from the database
        $query = "SELECT CP.PostID, CP.PostText, CP.PostDate, U.FirstName, U.LastName, COUNT(L.LikeID) AS LikesCount,
            COUNT(C.CommentID) AS CommentsCount
          FROM communityposts CP
          JOIN users U ON CP.UserID = U.UserID
          LEFT JOIN likes L ON CP.PostID = L.PostID
          LEFT JOIN comments C ON CP.PostID = C.PostID
          GROUP BY CP.PostID
          ORDER BY CP.PostDate DESC";
        $result = $connection->query($query);

        // Loop through the query result and display each post
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Output post content
                echo '<div class="post" data-post-id="' . $row['PostID'] . '">';
                echo '<div class="post-header">';
                echo '<div class="user-info">';
                echo '<span class="username">' . $row['FirstName'] . ' ' . $row['LastName'] . '</span>';
                echo '<span class="post-date">' . formatDate($row['PostDate']) . '</span>';
                echo '</div>';
                echo '<div class="actions">';
                echo '<button class="like-btn" data-post-id="' . $row['PostID'] . '">Like</button>';
                echo '<span class="likes-count">' . $row['LikesCount'] . '</span>';
                echo '</div>';
                echo '</div>';
                echo '<div class="post-content">';
                echo '<p>' . $row['PostText'] . '</p>';
                echo '</div>';
                
                // Display number of comments beside the comments heading
                echo '<h3>Comments (' . $row['CommentsCount'] . ')</h3>';

                // Fetch and display comments for this post
                $postID = $row['PostID'];
                $commentsQuery = "SELECT C.CommentID, C.UserID, C.CommentText, C.CommentDate, U.FirstName, U.LastName 
                                  FROM comments C 
                                  JOIN users U ON C.UserID = U.UserID 
                                  WHERE C.PostID = $postID";
                $commentsResult = $connection->query($commentsQuery);

                if ($commentsResult->num_rows > 0) {
                    echo '<div class="post-comments">';
                    while ($comment = $commentsResult->fetch_assoc()) {
                        echo '<div class="comment">';
                        echo '<p><strong>' . $comment['FirstName'] . ' ' . $comment['LastName'] . '</strong>: ' . $comment['CommentText'] . '</p>';
                        echo '<span class="comment-date">' . formatDate($comment['CommentDate']) . '</span>';
                        echo '</div>';
                    }
                    echo '</div>';
                } else {
                    echo '<p>No comments found.</p>';
                }

                // Comment form
                echo '<form class="comment-form" action="../action/comment_action.php" method="POST">';
                echo '<input type="hidden" name="postID" value="' . $row['PostID'] . '">';
                echo '<textarea name="comment-text" rows="2" placeholder="Add a comment..."></textarea>';
                echo '<button type="submit">Comment</button>';
                echo '</form>';

                echo '</div>'; // Close .post div
            }
        } else {
            echo 'No posts found.';
        }

        // Close the database connection
        $connection->close();
        ?>
    </section>
</main>

<footer>
    <p>&copy; 2024 Interactive Community. All rights reserved.</p>
</footer>

<script src="../js/community.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
