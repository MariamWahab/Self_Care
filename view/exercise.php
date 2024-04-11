
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
    <link rel="stylesheet" href="../css/exercise.css">
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
                    <li class="<?php echo ($message === 'skinCare' || $message === '') ? 'active' : '';?>"><a href="skinCare.php?msg=skin_Care">Skin Care Corner</a></li>
                    <li class="<?php echo ($message === 'wellnessTips' || $message === '') ? 'active' : '';?>"><a href="wellness.php?msg=wellnessTips"> Wellness Tips</a></li>
                    <li class="<?php echo ($message === 'community' || $message === '') ? 'active' : '';?>"><a href="community.php">Community</a></li>
                    <li class="<?php echo ($message === 'profile' || $message === '') ? 'active' : '';?>"><a href="profile.php?msg=profile">Profile</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="videos">
            <section class="video">
            <h1>Advice</h1>
            <a href="https://www.youtube.com/watch?v=_A0udZPwHxs">
                    <button class="exercise" style="background-image: url('../assets/exercising.webp');">
                        <h2>How to Start Exercising</h2>
                        <p class="description">Little motivation to start working out.</p>
                    </button>
                </a>

                <a href="https://www.youtube.com/watch?v=Hxwd-9p54c8">
                    <button class="exercise" style="background-image: url('../assets/experience.jpg');">
                        <h2>Personal Experience on Starting to Workout</h2>
                        <p class="description">Personal experience on how to overcome laziness and start exercising.</p>
                    </button>
                </a>
            </section>
            
            <section>
                <h1>Exercising Videos</h1>
                <a href="https://www.youtube.com/watch?v=edx3Xa6Qt7M">
                <button class="exercise" style="background-image: url('../assets/lowerbody.jpg');">
                    <h2>lower body workout</h2>
                    <p class="description">Exercises to help tone lower body.</p>
                </button>
            </a>
            <a href="https://www.youtube.com/watch?v=BMLhJvhWZ0E">
                <button class="exercise" style="background-image: url('../assets/upperbody.jpg');">
                    <h2>upper body workout</h2>
                    <p class="description">Exercises to help your upper body look more toned.</p>
                </button>
            </a>
            <a href="https://www.youtube.com/watch?v=irfw1gQ0foQ">
                <button class="exercise" style="background-image: url('../assets/squats.avif');">
                    <h2>Effective Squats</h2>
                    <p class="description">This should be part of your lower body workout.</p>
                </button>
            </a>
            <a href="https://www.youtube.com/watch?v=ak_glVKt6-0">
                <button class="exercise" style="background-image: url('../assets/weightloss.jpg');">
                    <h2>Weight loss</h2>
                    <p class="description">Different exercises to help lose excess weight.</p>
                </button>
            </a>
                
            <a href="https://www.youtube.com/watch?v=6coSK5__cTE">
                <button class="exercise" style="background-image: url('../assets/flattummy.jpeg');">
                    <h2>Flat Tummy Exercise</h2>
                    <p class="description">A flat tummy is possible.</p>
                </button>
            </a>
            <a href="https://www.youtube.com/watch?v=ge1ALhE-Fqs">
                <button class="exercise" style="background-image: url('../assets/body.jpg');">
                    <h2>Effective Body Exercise</h2>
                    <p class="description">Get a full-body workout and improve overall fitness with these exercises.</p>
                </button>
            </a>
            <a href="https://www.youtube.com/watch?v=Qd4QBIoKrJM">
                <button class="exercise" style="background-image: url('../assets/pregnant.jpg');">
                    <h2>Exercise for Pregnant Women</h2>
                    <p class="description">Stay active and healthy during pregnancy with these safe exercises.</p>
                </button>
            </a>

            <a href="https://www.youtube.com/watch?v=lKx0sOz31C4">
                <button class="exercise" style="background-image: url('../assets/lazyexercise.webp');">
                    <h2>"Lazy" Exercise</h2>
                    <p class="description">Exercise in the comfort of your bed.</p>
                </button>
            </a>

            </section>

            <section>
                <h1>Workout Playlist</h1>
                <a href="https://www.youtube.com/watch?v=YnezhNgzdss">
                <button class="exercise" style="background-image: url('../assets/playlist.webp');">
                    <p class="description">Good music equals effective workout.</p>
                </button>
            </a>

            </section>
            
        </div>

    </main>

    <footer>
        <p>&copy; 2024 Relaxation Exercises. All rights reserved.</p>
    </footer>
</body>
</html>