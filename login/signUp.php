<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signUp.css">
    <title>Register</title>
</head>

<body>
    <div class="container">
        <div class="image">
            <a href="../view/landingPage.php"><img src="../assets/logo.png" alt="Restore Logo"></a>
        </div>
        <div class="form">
            <h2>Join <span style="font-family: 'Lucida handwriting';">Restore!</span></h2>
            <form id="register" onsubmit="return validateForm(event)" action="../action/signUp_action.php" method="POST" >
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fname" required>

                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lname" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>

                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>


                <button type="submit" class="account" id="signUp">Sign up</button>
            </form>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/signUp.js"></script>
</body>

</html>
