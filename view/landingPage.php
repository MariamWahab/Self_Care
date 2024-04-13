<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="../css/landingPage.css">


</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="../view/aboutUs.php">About Us</a></li>
                <li><a href="../login/login.php">Login</a></li>
                <li><a href="../login/signUp.php">Sign up</a></li>
            </ul>
        </nav>
        <img src="../assets/logo.png" alt="Restore Logo" class="logo">
        <h1>Welcome to <span style="font-family:'Lucida handwriting';">Restore!</span> </h1>
        <p class="info">Restore is a website which helps people find ways to prioritize self care as well as inculcating it into their everyday lifes. </p>
    </header>
    
    <section id="methods">
        <h2>Functionalities</h2>
        <div class="feature">
            <h3>Goal List</h3>
            <img src="../assets/goal.jpeg" alt="Goal List">
            <p>Users would set and put their priority activity (skincare, exercise, journaling, <br> etc) which they would be reminded to focus on their goals.</p>
        </div>
        <div class="feature">
            <h3>Interactive Community</h3>
            <img src="../assets/community.jpeg" alt="Interactive Community">
            <p>People can share tips on achieving certain goals, be it the products they used <br> or advice they listened to while attaining their set self-care goals!</p>
        </div>
        <div class="feature">
            <h3>Specialist Assignment</h3>
            <img src="../assets/specialist.jpg" alt="Specialist Assignment">
            <p>With the goal set, it would be used to assign users to a someone who specializes in those areas. The specialist is assigned when the user requests it.</p>
        </div>
    </section>

    <footer>
        <p>Contact: <a href="mailto:restoreCare@gmail.com">restoreCare@gmail.com</a></p>
        <p>&copy; 2024 Restore. All rights reserved.</p>
    </footer>
</body>
</html>