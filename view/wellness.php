
<?php
include "../settings/core.php";
loginCheck();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercises</title>
    <link rel="stylesheet" href="../css/skinCare.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <link rel="stylesheet" href="../css/nav-bar.css">
</head>
<body>
    <?php
        // Retrieve the message parameter from the URL
        $message = isset($_GET['msg']) ? $_GET['msg'] : 'Wellness';
    ?>
    
    <header>
        <div class="nav-bar">
            <div class="nav-bar-title">
            Wellness Tips 
            </div>

            <nav>
                <ul >
                    <li class="<?php echo ($message === 'home' || $message === '') ? 'active' : '';?>"><a href="homePage.php">Home</a></li>
                    <li class="<?php echo ($message === 'goal' || $message === '') ? 'active' : '';?>"><a href="goal.php">Goals</a></li>
                    <li class="<?php echo ($message === 'skincare' || $message === '') ? 'active' : '';?>"><a href="skinCare.php">Skin Care Corner</a></li>
                    <li class="<?php echo ($message === 'exercise' || $message === '') ? 'active' : '';?>"><a href="exercise.php?"> Exercise</a></li>
                    <li class="<?php echo ($message === 'community' || $message === '') ? 'active' : '';?>"><a href="community.php">Community</a></li>
                    <li class="<?php echo ($message === 'profile' || $message === '') ? 'active' : '';?>"><a href="profile.php?msg=profile">Profile</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="skin-Care">
            <section class="BodyCare">
            <h1>General Wellness Tips</h1>
            <div class="link1">
                    <h3>1. Eat healthy</h3>
                    <p style="margin-left: 2%; font-size: 16pt;">Eating well?</p>
                    <a href="https://www.cdc.gov/healthyweight/healthy_eating/index.html#:~:text=Emphasizes%20fruits%2C%20vegetables%2C%20whole%20grains,products%2C%20nuts%2C%20and%20seeds." style="margin-left: 2%; font-size: 16pt;">Read More</a>

                    <h3>2. Rest</h3>
                    <p style="margin-left: 2%; font-size: 16pt;">Why is rest important?</p>
                    <a href="https://ivypanda.com/blog/how-to-rest-effectively/" style="margin-left: 2%; font-size: 16pt;">Read More</a>
                
                    <h3>3. Drink lots of water</h3>
                    <p style="margin-left: 2%; font-size: 16pt;">How much water is toomuch water?</p>
                    <a href="https://www.mayoclinichealthsystem.org/hometown-health/speaking-of-health/tips-for-drinking-more-water#:~:text=Mayo%20Clinic%20recommends%20this%20minimum,15.5%20cups%2C%20or%20124%20ounces" style="margin-left: 2%; font-size: 16pt;">Read More</a>
             
                    <h3>4. Take your vitamins</h3>
                    <p style="margin-left: 2%; font-size: 16pt;">Vitamins are important</p>
                    <a href="https://www.nationaljewish.org/conditions/healthy-eating/taking-multivitamins" style="margin-left: 2%; font-size: 16pt;">Read More</a>

                    <h3>5. Exercise</h3>
                    <p style="margin-left: 2%; font-size: 16pt;">Wellness means check your physical health</p>
                    <a href="https://patient.info/healthy-living/physical-activity-for-health" style="margin-left: 2%; font-size: 16pt;">Read More</a>

                    <h3>6. Take breaks</h3>
                    <p style="margin-left: 2%; font-size: 16pt;">Pause</p>
                    <a href="https://www.betterup.com/blog/the-importance-of-taking-breaks" style="margin-left: 2%; font-size: 16pt;">Read More</a>

            </div>
           

            </section>

            <section class="facialCare">
                <h1>Therapy sites</h1>
                <a href="https://www.betterhelp.com/get-started/?go=true&utm_source=AdWords&utm_medium=Search_PPC_c&utm_term=online+therapy_b&utm_content=136971342842&network=g&placement=&target=&matchtype=b&utm_campaign=16805123991&ad_type=text&adposition=&kwd_id=kwd-11476751&gad_source=1&gclid=Cj0KCQjwlN6wBhCcARIsAKZvD5gNhTJ_IdSOxLkq2YG7w4PcY1RoHiadZaGXyEK_NEl7E9XkQqOv9nwaAjbIEALw_wcB&not_found=1&gor=start"><p>BetterHelp</p>
                <img src="../assets/therapy1.jpg" alt="therapy" class="skin1" ></a>
            </section>

            <section class="links" >
                <h1>Journaling Tips</h1>
                <div class="link1">
                    <h3>1. How to Start Journaling </h3>
                    <p style="margin-left: 2%; font-size: 16pt;">7 tips for Beginners</p>
                    <a href="https://moonsterleather.com/en-gb/blogs/news/how-to-start-journaling" style="margin-left: 2%; font-size: 16pt;">Read More</a>
                </div>

                <div class="link2" >
                    <h3>2. A video for Journaling</h3>
                    <p style="margin-left: 2%; font-size: 16pt;">How important is journaling?</p>
                    <a href="https://www.youtube.com/watch?v=2d4w3IfJsO0" style="margin-left: 2%; font-size: 16pt;">View</a>
                </div>

                <img src="../assets/journaling1.webp" alt="skincare" class="skin2" >

                
            </section>



        </div>    
            

    </main>

    <footer>
        <p>&copy; 2024 Relaxation Exercises. All rights reserved.</p>
    </footer>
</body>
</html>