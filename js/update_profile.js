document.addEventListener("DOMContentLoaded", function() {
    // Function to fetch user profile data
    function fetchProfileData() {
        // Make a fetch request to the PHP script to get user profile data
        fetch('../function/get_profile_fxn.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch user profile data');
            }
            return response.json();
        })
        .then(data => {
            // Log the fetched data to the console for debugging
            console.log('Fetched profile data:', data);

            // Fill form fields with fetched profile information
            document.getElementById('fname').value = data.fname;
            document.getElementById('lname').value = data.lname;
            document.getElementById('email').value = data.email;
            document.getElementById('dob').value = data.dob;
            document.getElementById('gender').value = data.gender;
        })
        .catch(error => {
            console.error('Error fetching profile data:', error);
            // Handle error appropriately, e.g., display error message to the user
        });
    }

    // Fetch user profile information
    fetchProfileData();

    // Redirect to profile page when the update button is clicked
    document.getElementById('updateButton').addEventListener('click', function() {
        // Submit the form when the button is clicked
        document.getElementById('updateForm').submit();
    });
});
