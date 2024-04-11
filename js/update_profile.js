document.addEventListener("DOMContentLoaded", function() {
    // Make an AJAX request to fetch interests data
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../function/get_profile_fxn.php', true); // Open the XMLHttpRequest
    xhr.send();
    
    // Fetch user profile information from the server
    fetch('../function/get_profile_fxn.php')
    .then(response => response.json())
    .then(data => {
        console.log(data);
        // Fill form fields with fetched profile information
        document.getElementById('fname').value = data.fname;
        document.getElementById('lname').value = data.lname;
        document.getElementById('email').value = data.email;
        document.getElementById('dob').value = data.dob;
        document.getElementById('gender').value = data.gender;
    })
    .catch(error => console.error('Error:', error));

    // Add event listener for form submission
    document.getElementById('updateForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Collect form data
        const formData = new FormData(this);
      
        // Send form data to update_profile.php using fetch
        fetch('../action/edit_profile_action.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                swal({
                    title: 'Success!',
                    text: 'Successfully Updated .',
                    icon: 'success',
                    button: 'OK'
                }).then((value) => {
                    if (value) {
                        // Redirect to another page after success if needed
                        window.location.href = '../view/profile.php';
                    }
                });
                
            } else {
                swal({
                    title: 'Error!',
                    text: 'Update failed. Please try again ',
                    icon: 'error',
                    button: 'OK'
                });
                // Display error message if update fails
                console.error('Update failed:', response.statusText);
                // You can display a message to the user using a modal or alert
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle any unexpected errors if needed
            swal({
                title: 'Error!',
                text: 'An unexpected error occurred. Try again.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    });
});
