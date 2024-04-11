document.addEventListener('DOMContentLoaded', function() {
    var likeButtons = document.querySelectorAll('.like-btn');
    likeButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var postID = this.getAttribute('data-post-id');
            likePost(postID);
        });
    });

    function likePost(postID) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../action/like_action.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        // Reload the page to display the updated like count
                        location.reload();
                    } else {
                        // Handle error
                        alert(response.message);
                    }
                } else {
                    // Handle error
                    alert('Error: ' + xhr.statusText);
                }
            }
        };
        xhr.send('postID=' + encodeURIComponent(postID));
    }

    // Function to fetch comments for a post
    function fetchComments(postID) {
        var commentsContainer = document.querySelector('.comments[data-post-id="' + postID + '"]');
        if (commentsContainer) {
            // Fetch comments via AJAX and update the comments container
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Update comments container with fetched comments
                        commentsContainer.innerHTML = xhr.responseText;
                    } else {
                        // Handle error
                        alert('Error fetching comments: ' + xhr.statusText);
                    }
                }
            };
            xhr.open('GET', '../action/get_comments_action.php?postID=' + encodeURIComponent(postID), true);
            xhr.send();
        }
    }

    // Add event listener to each post to fetch comments when clicked
    var posts = document.querySelectorAll('.post');
    posts.forEach(function(post) {
        post.addEventListener('click', function() {
            var postID = this.getAttribute('data-post-id');
            fetchComments(postID);
        });
    });

    // Submit comment form via AJAX
    var commentForms = document.querySelectorAll('.comment-form');
    commentForms.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            var formData = new FormData(form);
            var postID = formData.get('postID');
            var commentText = formData.get('comment-text');

            // Check if comment is not empty
            if (!commentText.trim()) {
                alert('Please enter a comment.');
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../action/comment_action.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.status === 'success') {
                            // Comment added successfully, refresh the page to display it
                            location.reload();
                        } else {
                            // Handle error
                            alert(response.message);
                        }
                    } else {
                        // Handle error
                        alert('Error: ' + xhr.statusText);
                    }
                }
            };
            xhr.send(formData);
        });
    });
});
