<?php
include ("../settings/core.php");
include("../settings/connection.php");
loginCheck();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/nav-bar.css">
</head>
<body>
    <?php
    
        // Retrieve the message parameter from the URL
        $message = isset($_GET['msg']) ? $_GET['msg'] : 'profile';
    ?>
    <header>
        <div class="nav-bar">
            <div class="nav-bar-title">
                Hello <?php echo isset($_SESSION["fname"]) ? $_SESSION["fname"] : ''; ?>
            </div>
            <nav>
                <ul>
                    <li class="<?php echo ($message === 'home' || $message === '') ? 'active' : ''; ?>"><a href="homePage.php?msg=profile">Home</a></li>
                    <li class="<?php echo ($message === 'goal' || $message === '') ? 'active' : ''; ?>"><a href="goal.php">Goals</a></li>
                    <li class="<?php echo ($message === 'exercise' || $message === '') ? 'active' : ''; ?>"><a href="exercisesPageView.php?msg=relaxationExercise">Exercise</a></li>
                    <li class="<?php echo ($message === 'wellnessTips' || $message === '') ? 'active' : ''; ?>"><a href="wellness.php?msg=wellnessTips"> Wellness Tips</a></li>
                    <li class="<?php echo ($message === 'community' || $message === '') ? 'active' : ''; ?>"><a href="community.php?msg=interactiveCommunity"> Community</a></li>
                    

                </ul>
            </nav>
        </div>
    </header>
    <div class="content">
        <div class="container">
            <div class="image">
                <!-- Your profile image here -->
                <img src="../assets/profile.jpg" alt="Profile Image">
            </div>
            <div class="profile-content">
                <h2>User Profile</h2>
                <p><strong>First Name:</strong> <span id="fname"></span></p>
                <p><strong>Last Name:</strong> <span id="lname"></span></p>
                <p><strong>Email:</strong> <span id="email"></span></p>
                <p><strong>Gender:</strong> <span id="gender"></span></p>
                <p><strong>Date of Birth:</strong> <span id="dob"></span></p>
                <div class="actions">
                    <div class="logout">
                        <button class="logout-btn">Logout</button>
                    </div>
                    <div class="update">
                        <button class="update-btn">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/profile.js"></script>
</body>
</html>