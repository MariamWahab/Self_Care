<?php 
include "../settings/connection.php";
include "../settings/core.php"; 
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
// Define an array to hold the response data
$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    global $connection;
    
    // Check if user is logged in
    if(isset($_SESSION['UserID'])) {
        $user = $_SESSION['UserID']; // Assign user ID from session
        // Assuming specialist ID is sent via POST request
        if(isset($_POST['specialist'])) {
            // Retrieving specialist ID from POST data
            $specialistID = $_POST['specialist'];
            $date_requested = date("Y-m-d");

            // Prepare and bind parameters
            $sql = "INSERT INTO requests (user_id, specialist_id, date_requested) VALUES (?, ?, ?)";
            $stmt = $connection->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("iis", $user, $specialistID, $date_requested);
                // Execute the statement
                if ($stmt->execute()) {
                    // Check if the query was successful
                    if ($stmt->affected_rows > 0) {
                        // If successful, set response status and message
                        $response['status'] = 'success';
                        $response['message'] = 'Request successfully sent!';
                        header("Location: ../view/selectSpecialist.php?msg='Request sent successfully'");
                    } else {
                        // If unsuccessful, set appropriate response message
                        $response['status'] = 'error';
                        $response['message'] = 'Failed to send request. Please try again.';
                    }
                } else {
                    // If execute() fails, set database error message
                    $response['status'] = 'error';
                    $response['message'] = 'Database error. Please try again later.';
                }
                $stmt->close(); // Close statement
            } else {
                // Error in preparing the statement
                $response['status'] = 'error';
                $response['message'] = 'Database error. Please try again later.';
            }
        } else {
            // Handle case where specialist ID is missing in POST data
            $response['status'] = 'error';
            $response['message'] = 'Error: Specialist ID is missing in the POST request.';
        }
    } else {
        // Handle case where user is not logged in
        $response['status'] = 'error';
        $response['message'] = 'Error: User is not logged in.';
    }
}

// Encode the response array to JSON format and return it
echo json_encode($response);
?>
