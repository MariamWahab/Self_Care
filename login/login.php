
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/login.css">
<title>Login</title>
</head>
<body>

<div class="container">
  <div class="image">
    <a href="../view/landingPage.php"><img src="../assets/logo.png" alt="Restore Logo"></a>
  </div>
  <div class="form">
    <h2> Restore</h2>
    <h3>Login</h3>
    <form action="../action/login_action.php" method="POST" id="loginForm">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
      <input type="submit" value="SIGN IN">
    </form>
    <div class="forgot-password">
      <a href="#">Forgot password?</a>
    </div>
    <div class="login">
      <!-- <a href="../login/signUp.php"><button class="signUp">Sign Up</button></a> -->
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../js/login.js"></script>



</body>
</html>
