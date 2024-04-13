<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

$database = "self_caredb";
$serverName = "127.0.0.1";
$username = "root";
$password = "T6Cncmt8CX5:";

// Create connection
$connection = new mysqli($serverName, $username, $password, $database);

// Check connection
if ($connection->connect_errno) {
    die("Connection failed: " . $connection->connect_error);
}

// echo 'yeah';

// } else {
//     echo "Connected successfully!";
// }

// Close the connection when done (uncomment if needed)
// $connection->close();

