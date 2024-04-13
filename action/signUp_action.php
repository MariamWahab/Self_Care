<?php
include("../settings/connection.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $fname= $_POST["fname"];
    $lname= $_POST["lname"];
    $email= $_POST["email"];
    $password= $_POST["password"];
    $gender= $_POST["gender"];
    $dob = $_POST["dob"];

    $passwordHash= password_hash($password, PASSWORD_DEFAULT);

    $query = $connection->prepare("INSERT INTO users (`FirstName`, `LastName`, `Email`, `Gender`, `DateOfBirth`, `Password`) VALUES (?, ?, ?, ?, ?, ?)");
    $query->bind_param('ssssss', $fname, $lname, $email, $gender, $dob, $passwordHash);

    if ($query->execute()) {
        // echo "User registered successfully";
        header("Location: ../login/login.php");
        exit;
    } else {
        echo "Error: " . $query . "<br>" . $connection->error;
    }
    $query->close();
    $connection->close();
}
?>
