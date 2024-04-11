document.addEventListener("DOMContentLoaded", function() {
    // Fetch user profile information from the server
    fetch('../function/get_profile_fxn.php')
    .then(response => response.json())
    .then(data => {
       console.log(data);
       // Fill form fields with fetched profile information
       document.getElementById('fname').textContent = data.fname;
       document.getElementById('lname').textContent = data.lname;
       document.getElementById('email').textContent = data.email;
       document.getElementById('dob').textContent = data.dob;
       document.getElementById('gender').textContent = data.gender;
   })
    .catch(error => console.error('Error:', error));

   // Get the update profile button
   var updateBtn = document.querySelector('.update-btn');

   // Add event listener for the click event
   updateBtn.addEventListener("click", function() {
       // Redirect to the edit form page
       window.location.href = '../view/edit_profile.php'; 
   });

   var logOutBtn = document.querySelector('.logout-btn');

   // Add event listener for the click event
   logOutBtn.addEventListener("click", function() {
       // Redirect to the logout action page
       window.location.href = '../action/logout_action.php'; 
   });
});
