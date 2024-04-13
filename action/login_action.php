<?php
session_start();

include("../settings/connection.php");

if(isset($_POST["email"]) && isset($_POST["password"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE Email = ?";
    $statement = $connection->prepare($query);
    $statement->bind_param("s", $email);
    $statement->execute();    
    $result = $statement->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if(password_verify($password, $row["Password"])){
            $_SESSION["UserID"] = $row["UserID"];
            $_SESSION["fname"] = $row["FirstName"];

            // Redirect to user dashboard
            header("Location: ../view/homePage.php");
            exit;
        } else {
            // Redirect back to login page with error message
            header("Location: ../login/login.php?msg=invalid");
            exit;
        }
    } else {
        // Redirect back to login page with error message
        header("Location: ../login/login.php?msg=invalid");
        exit;
    }
}
?>
