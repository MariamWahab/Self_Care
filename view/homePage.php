<?php
include ("../settings/core.php");
loginCheck();
include("../settings/connection.php");

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <link rel="stylesheet" href="../css/homePage.css">
  <link rel="stylesheet" href="../css/nav-bar.css">

</head>
<body>
    <?php
        // Retrieve the message parameter from the URL
        $message = isset($_GET['msg']) ? $_GET['msg'] : 'home';
    ?>

  <header>
          <div class="nav-bar">
            <div class="nav-bar-title">
                    Hi <?php echo isset($_SESSION["fname"]) ? $_SESSION["fname"] : ''; ?>
                </div>
                  

                  <nav>
                      <ul >
                          <li class="<?php echo ($message === 'goal' || $message === '') ? 'active' : '';?>"><a href="goal.php">Goals</a></li>
                          <li class="<?php echo ($message === 'skinCare' || $message === '') ? 'active' : '';?>"><a href="skinCare.php?msg=skin_Care">Skin Care Corner</a></li>
                          <li class="<?php echo ($message === 'exercise' || $message === '') ? 'active' : '';?>"><a href="exercise.php?msg=exercise">Exerices</a></li>
                          <li class="<?php echo ($message === 'wellnessTips' || $message === '') ? 'active' : '';?>"><a href="wellness.php?msg=wellnessTips">Wellness Tips</a></li>
                          <li class="<?php echo ($message === 'community' || $message === '') ? 'active' : '';?>"><a href="community.php?msg=interactiveCommunity">Community </a></li>
                          <li class="<?php echo ($message === 'profile' || $message === '') ? 'active' : '';?>"><a href="profile.php?msg=profile">Profile </a></li>
                      </ul>
                  </nav>
          </div>
    </header>
  <main>
    <h3 style="font-size:23px;"><em>Self care boosts self love</em></h3>
    <section class="videos">
    <h2></h2>
    <div class="video-container">
        <video controls autoplay muted loop id="video" >
        <source src="../assets/selfcare.mp4" type="video/mp4">
        Your browser does not support the video tag.
        </video>
        <!-- Add more videos as needed -->
    </div>
    </section>

    <section class="self-care-articles">
    <h2>Self-care blogs</h2>
    <div class="article">
      <h4>1. Helpful tips</h4>
      <p>Making Yourself A Priority</p>
      <a href="https://www.mindsoother.com/blog/self-care-making-yourself-a-priority">Read More</a>
    </div>
    <div class="article">
      <h4>2. 40 one-sentence self-care tips</h4>
      <p>Following your heart is an act of self-care.</p>
      <a href="https://theblissfulmind.com/one-sentence-self-care-tips/">Read More</a>
    </div>
    <!-- Add more articles as needed -->
    </section>


    <!-- Track progress button -->
    <section class="feedback">
            <h2>Testimonial</h2>
            <div class="feedback">
                <p>Aneesa W</p>
                <blockquote>
                    "This website has made prioritizing my goals easy."
                </blockquote>
                
            </div>

            <div class="feedback">
                <p>Adora Smith</p>
                <blockquote>
                    "Glad my friend recommened this website! My self disciline is in check now!"
                </blockquote>
            </div>

    </section>

    <!-- <section><a href="../view/selectSpecialist.php">Need a Specialist?</a></section> -->

  </main>
  
  <footer>
    <p>&copy; 2024 Restore. All rights reserved.</p>
  </footer>
  
  <!-- JavaScript to show footer when user reaches end of page -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>