document.addEventListener("DOMContentLoaded", function() {
    // Get the form element
    var loginForm = document.getElementById('loginForm');

    // Add event listener to the form
    loginForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Get form field values
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var emailExpression = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var passwordExpression = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W\_])[A-Za-z\d\W\_]{8,}$/;

        // Basic form validation
        if (!email || !password) {
            // If any field is empty, show an error message
            swal({
                title: 'Error!',
                text: 'Please fill out all the fields.',
                icon: 'error',
                button: 'OK'
            });
            return; // Stop form submission
        }

        // Submit the form data using fetch or AJAX
        fetch('../action/login_action.php', {
            method: 'POST',
            body: new FormData(loginForm)
        })
        .then(response => {
            // Check status code of the response
            switch (response.status) {
                case 200: // Success
                    // Redirect to homepage after successful login
                    window.location.href = '../view/homepage.php';
                    break;
                case 500: // Internal Server Error
                    // Login failed, handle errors
                    swal({
                        title: 'Error!',
                        text: 'Login failed. Please try again later.',
                        icon: 'error',
                        button: 'OK'
                    });
                    break;
                default: // Other status codes
                    // Handle other status codes if needed
                    swal({
                        title: 'Error!',
                        text: 'An unexpected error occurred. Please try again later.',
                        icon: 'error',
                        button: 'OK'
                    });
                    break;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle any unexpected errors if needed
            swal({
                title: 'Error!',
                text: 'An unexpected error occurred. Please try again later.',
                icon: 'error',
                button: 'OK'
            });
        });
    });
});
