function validateForm(event) {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirmPassword').value;

    // Regular expressions for email and password validation
    var emailExpression = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var passwordExpression = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W\_])[A-Za-z\d\W\_]{8,}$/;

    // Check if email is valid
    if (!emailExpression.test(email)) {
        alert('Please enter a valid email address');
        return false;
    }

    // Check if password meets criteria
    if (!passwordExpression.test(password)) {
        alert('Password must be at least 8 characters long and contain at least one uppercase letter, one digit, and one special character');
        return false;
    }

    // Check if password and confirm password match
    if (password !== confirmPassword) {
        alert('Passwords do not match');
        event.preventDefault(); // Prevent form submission
        return false;
    }

    // All validations passed
    alert('Registration successful!');
    return true;
}

// Add event listener when DOM content is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Get the form element
    var form = document.getElementById('register');

    // Add submit event listener to the form
    form.onsubmit = function(event) {
        // Call validateForm function when form is submitted
        return validateForm(event);
    };
});
