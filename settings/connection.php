<?php

$database = "self_caredb";
$serverName = "localhost";
$username = "root";
$password = "";

// Create connection
$connection = new mysqli($serverName, $username, $password, $database);

// Check connection
if ($connection->connect_errno) {
    die("Connection failed: " . $connection->connect_error);
}

// } else {
//     echo "Connected successfully!";
// }

// Close the connection when done (uncomment if needed)
// $connection->close();

