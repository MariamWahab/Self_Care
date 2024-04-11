<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define response codes
$responseCodes = [
    'success' => 200,
    'error' => 500,
    'redirect' => 302
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include('../settings/connection.php');

    // Get email and password from POST data
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        // Prepare and execute the SQL query to fetch user details by email
        $sql = "SELECT * FROM Users WHERE Email = ?";
        $stmt = $connection->prepare($sql);

        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $row['Password'])) {
                // Store user ID in session variable
                $_SESSION['UserID'] = $row['UserID'];
                $_SESSION['fname'] = $row['FirstName']; // Assuming "FirstName" is the column name in your database
                // Other session variables if needed

                // Return success response with redirect URL
                http_response_code($responseCodes['success']);
                echo json_encode(['message' => 'Login successful', 'redirect' => '../view/homepage.php']);
                exit; // Make sure to exit after sending the response
            } else {
                // Return error response for incorrect password
                http_response_code($responseCodes['error']);
                echo json_encode(['message' => 'Incorrect password.']);
                exit; // Make sure to exit after sending the response
            }
        } else {
            // Return error response for user not found
            http_response_code($responseCodes['error']);
            echo json_encode(['message' => 'User not found.']);
            exit; // Make sure to exit after sending the response
        }
    } else {
        // Return error response for empty fields
        http_response_code($responseCodes['error']);
        echo json_encode(['message' => 'Error: Empty email or password field.']);
        exit; // Make sure to exit after sending the response
    }

    // Close statement
    // $stmt->close();
    // // Close connection
    // $connection->close();
}
?>
