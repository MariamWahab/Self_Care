document.addEventListener('DOMContentLoaded', function() {
    var likeButtons = document.querySelectorAll('.like-btn');
    likeButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var postID = this.getAttribute('data-post-id');
            likePost(postID);
        });
    });

    function likePost(postID) {
        var formData = new FormData();
        formData.append('postID', postID);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../action/like_action.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    alert(xhr.responseText); // Display the response message
                    location.reload(); // Reload the page to show updated like count
                } else {
                    alert('Error: ' + xhr.statusText);
                }
            }
        };
        xhr.send(formData);
    }

    var commentForms = document.querySelectorAll('.comment-form');
    commentForms.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            var formData = new FormData(form);
            var commentText = formData.get('comment-text');

            // Check if comment is not empty
            if (!commentText.trim()) {
                alert('Please enter a comment.');
                return;
            }

            // Set the action URL of the form
            form.action = '../action/comment_action.php';

            // Submit the form
            var xhr = new XMLHttpRequest();
            xhr.open('POST', form.action, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Comment submitted successfully, reload the page
                        location.reload();
                    } else {
                        alert('Error submitting comment: ' + xhr.statusText);
                    }
                }
            };
            xhr.send(formData);
        });
    });
});
