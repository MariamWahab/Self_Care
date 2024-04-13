document.addEventListener("DOMContentLoaded", function() {
    // Get the form element
    var loginForm = document.getElementById('loginForm');

    // Add event listener to the form
    loginForm.addEventListener("submit", function(event) {
        // Get form field values
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;

        // Basic form validation
        if (!email || !password) {
            // If any field is empty, show an error message
            alert('Please fill out all the fields.');
            event.preventDefault(); // Prevent the form from submitting
            return; // Stop form submission
        }

        // Validate email
        if (!validateEmail(email)) {
            alert('Please enter a valid email address');
            event.preventDefault(); // Prevent the form from submitting
            return; // Stop form submission
        }

        // Validate password
        if (!validatePassword(password)) {
            alert('Password must be at least 8 characters long and contain at least one uppercase letter and one special character');
            event.preventDefault(); // Prevent the form from submitting
            return; // Stop form submission
        }

        // All validations passed
        alert('Login successful!');
    });
});
