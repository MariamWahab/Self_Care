<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/edit_profile.css">
    <title>Profile</title>
</head>

<body>

    <div class="container">
        <div class="image homepage-view">
            <img src="../assets/logo.png" alt="Restore logo">
        </div>
        <div class="form">
            <h2>Profile</h2>
            <form action="#" method="post" id="updateForm">

                <div class="form-content">

                    <div class="first-col">
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="fname" required>

                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" name="lname" required>

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                        

                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" required>
                      
                        <div class="reg-other">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="register-actions">
                    <button type="submit" > Update </button>
                </div>
                

            </form>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/update_profile.js"></script>

</body>

</html>