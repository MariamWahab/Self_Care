document.getElementById("registerForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission
    
    // Get form field values
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    var gender = document.getElementById("gender").value;
    var dob = document.getElementById("dob").value;
    var emailRegex = /^\S+@\S+\.\S+$/;
    var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W\_])[A-Za-z\d\W\_]{8,}$/;


    // Basic form validation
    if (!fname || !lname || !email || !password || !confirmPassword || !gender || !dob) {
        // If any field is empty, show an error message
        alert('Please fill out all the fields.');
        return; // Stop form submission
    }

    if (!passwordRegex.test(password)) {
        // If password doesn't meet requirements, show an error message
        swal({
            title: 'Error!',
            text: 'Password must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, and one number.',
            icon: 'error',
            button: 'OK'
        });
        return; // Stop form submission
    }

    // Check if passwords match
    if (password !== confirmPassword) {
        // If passwords don't match, show an error message
        swal({
            title: 'Error!',
            text: 'Passwords do not match.',
            icon: 'error',
            button: 'OK'
        });
        return; // Stop form submission
    }


    var form = new FormData(this);

    // Submit the form data using fetch or AJAX
    fetch('../action/signUp_action.php', {
        method: 'POST',
        body: form
    })
    .then(response => {
        if (response.ok) {
            // Registration successful
            alert('User registered successfully.');
            window.location.href = '../login/login.php'; // Redirect to login page
        } else {
            // Registration failed
            alert('Error registering user. Please try again later.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An unexpected error occurred. Please try again later.');
    });
});

document.querySelector('.image.homepage-view img').addEventListener("click", function() {
    // Redirect to the homepage
    window.location.href = '../view/landingPage.php';
});
