<?php
include("../settings/connection.php");

// Define response codes
$responseCodes = [
    'success' => 200,
    'error' => 500
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $gender = $_POST["gender"];
    $dob = $_POST["dob"];
    // $number = $_POST["phoneNo"];

    // Server-side validation
    $errors = []; // Initialize an array to store validation errors

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Validate password length
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }

    // If there are no validation errors, proceed with inserting data into the database
    if (empty($errors)) {
        // Hash password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Prepare insert statement
        $sql = "INSERT INTO Users (FirstName, LastName, Email, Gender, DateOfBirth,Password) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);

        // Bind parameters and execute the statement
        $stmt->bind_param("ssssss", $fname, $lname, $email, $gender, $dob, $passwordHash);
        if ($stmt->execute()) {
            // User registered successfully
            $response = ['status' => 'success', 'message' => 'User registered successfully'];
            http_response_code($responseCodes['success']);
        } else {
            // Error occurred while inserting data
            $response = ['status' => 'error', 'message' => 'Error registering user: ' . $stmt->error];
            http_response_code($responseCodes['error']);
        }

        // Close statement
        $stmt->close();
    } else {
        // Validation errors occurred
        $response = ['status' => 'error', 'message' => $errors];
        http_response_code($responseCodes['error']);
    }

    // Close connection
    $connection->close();

    // Send JSON response
    echo json_encode($response);
}
?>
