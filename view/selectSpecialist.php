<?php
include ("../settings/core.php");
include ("../settings/connection.php");
loginCheck();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../css/specialistRequest.css">
    <link rel="stylesheet" href="../css/nav-bar.css">
</head>

<body>
    <?php

    // Retrieve the message parameter from the URL
    $message = isset($_GET['msg']) ? $_GET['msg'] : 'chooseSpecialist';
    ?>
    <header>
        <div class="nav-bar">
            <div class="nav-bar-title">
                Hello
                <?php echo isset($_SESSION["fname"]) ? $_SESSION["fname"] : ''; ?>
            </div>
            <nav>
                <ul>
                    <li class="<?php echo ($message === 'home' || $message === '') ? 'active' : ''; ?>"><a href="homePage.php?msg=profile">Home</a></li>
                    <li class="<?php echo ($message === 'goal' || $message === '') ? 'active' : ''; ?>"><a href="goal.php">Goals</a></li>
                    <li class="<?php echo ($message === 'exercise' || $message === '') ? 'active' : ''; ?>"><a href="exercisesPageView.php?msg=relaxationExercise">Exercise</a></li>
                    <li class="<?php echo ($message === 'wellnessTips' || $message === '') ? 'active' : ''; ?>"><a href="wellness.php?msg=wellnessTips"> Wellness Tips</a></li>
                    <li class="<?php echo ($message === 'community' || $message === '') ? 'active' : ''; ?>"><a href="community.php?msg=interactiveCommunity"> Community</a></li>
                    <li class="<?php echo ($message === 'profile' || $message === '') ? 'active' : ''; ?>"><a href="profile.php?msg=profile"> Profile</a></li>


                </ul>
            </nav>
        </div>
    </header>
    <div class="content">
        <div class="container">
            <div class="profile-content">
                <h2>Choose Specialist</h2>
                <form action="../action/request_action.php" method="post" id="specialistForm" >
                    <label for="specialist">Select a Specialist(Optional)</label>
                    <select id="specialist" name="specialist">
                        <option value="">None</option>

                        <?php
                        // Include database connection file
                        include ("../settings/connection.php");

                        // Fetch available specialists from the database
                        $query = "SELECT SpecialistID, Name, Specialization FROM Specialists";
                        $result = $connection->query($query);

                        // Check if there are specialists available
                        if ($result->num_rows > 0) {
                            // Loop through each specialist and populate the dropdown options
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['SpecialistID'] . '">' . $row['Name'] . ' - ' . $row['Specialization'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <div class="actions">
                    <div class="request-specialist">
                        <button class="requestButton">Request</button>
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/requestSpecialist.js"></script>
</body>

</html>