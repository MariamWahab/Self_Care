<?php
include "../settings/core.php";
loginCheck();

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

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
        $message = isset($_GET['msg']) ? $_GET['msg'] : 'Exercise';
    ?>
    
    <header>
        <div class="nav-bar">
            <div class="nav-bar-title">
            Exercises 
            </div>

            <nav>
                <ul >
                    <li class="<?php echo ($message === 'home' || $message === '') ? 'active' : '';?>"><a href="homePage.php">Home</a></li>
                    <li class="<?php echo ($message === 'goal' || $message === '') ? 'active' : '';?>"><a href="goal.php">Goals</a></li>
                    <li class="<?php echo ($message === 'exercise' || $message === '') ? 'active' : '';?>"><a href="exercise.php">Exercise</a></li>
                    <li class="<?php echo ($message === 'wellnessTips' || $message === '') ? 'active' : '';?>"><a href="wellness.php?msg=wellnessTips"> Wellness Tips</a></li>
                    <li class="<?php echo ($message === 'community' || $message === '') ? 'active' : '';?>"><a href="community.php">Community</a></li>
                    <li class="<?php echo ($message === 'profile' || $message === '') ? 'active' : '';?>"><a href="profile.php?msg=profile">Profile</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="skin-Care">
            <section class="BodyCare">
            <h1>Body Care Tips</h1>
            <p style="font-size: 20pt; font-family: cursive; margin-left: 5%;">Body is very important because how you smell adds to how attractive you are.</p>
            <p style="font-size: 20pt; font-family: cursive; margin-left: 5%;">Here are some tips for good body care</p>
            <ul>
                    <li><span style="font-weight: bold;">STEP 1:</span> <em>Scrub</em> </li>
                    <img src="../assets/scrub.webp" alt="scrub" class="scrub">

                    <li><span style="font-weight: bold;" >STEP 2:</span> <em>Wash</em></li>
                    <img src="../assets/wash.jpg" alt="wash" class="wash" >

                    <li><span style="font-weight: bold;" >Step 3:</span> <em>Moisturize</em> </li>
                    <img src="../assets/moisturizer.webp" alt="moisturizer" class="moisturizer" >

                    <li><span style="font-weight: bold;" >STEP 4:</span> <em>Layer with good scent</em></li>
                    <img src="../assets/perfume.jpg" alt="perfume" class="perfume" >
                </ul>

            </section>

            <section class="facialCare">
                <h1>Facial Care</h1>
                <p>Recommended Facial Products</p>
                <img src="../assets/skin1.jpg" alt="skincare" class="skin1" >
                <img src="../assets/skin2.jpg" alt="skincare" class="skin2" >
            </section>

            <section class="links" >
                <h1>Links to Skin Type Recommendations</h1>
                <div class="link1">
                    <h3>1. Oily Skin</h3>
                    <p style="margin-left: 2%; font-size: 16pt;">Keeping oily skin looking and feeling healthy requires a daily skincare regimen.</p>
                    <a href="https://www.cerave.com/skin-smarts/skincare-routines/a-gentle-skincare-routine-for-oily-skin" style="margin-left: 2%; font-size: 16pt;">Read More</a>
                </div>

                <div class="link2" >
                    <h3>2. Dry Skin</h3>
                    <p style="margin-left: 2%; font-size: 16pt;">Why is my skin so dry even when I moisturize?</p>
                    <a href="https://www.refinery29.com/en-us/best-skincare-dry-skin-dermatologist-advice" style="margin-left: 2%; font-size: 16pt;">Read More</a>
                </div>

                <div>
                    <h3>3. Sensitive Skin</h3>
                    <p style="margin-left: 2%; font-size: 16pt;">Keep your sensitive skin in check with right products</p>
                    <a href="https://www.cultbeauty.co.uk/skin-care/skin-concern/sensitive-skin.list" style="margin-left: 2%; font-size: 16pt;">Read More</a>
                </div>

                <div>
                    <h3>4. More Recommendations</h3>
                    <p style="margin-left: 2%; font-size: 16pt;">Keep your skin glowy</p>
                    <a href="https://www.allure.com/skin-care" style="margin-left: 2%; font-size: 16pt;">Read More</a>

                </div>
                
                
            </section>



        </div>    
            

    </main>

    <footer>
        <p>&copy; 2024 Relaxation Exercises. All rights reserved.</p>
    </footer>
</body>
</html>