<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("../../connection/connection.php");

// Initialize the response array
$response = array();

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $member_id = $_POST["member_id"];
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $last_name = $_POST["last_name"];
    $user_name = $_POST["user_name"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $position = $_POST["position"];
    $date_of_joining = $_POST["date_of_joining"];
    $position_in_ukeum = $_POST["position_in_ukeum"];
    $department_id = $_POST["department_id"];

    // Check if the user already exists
    $checkUserStmt = $conn->prepare("SELECT * FROM members WHERE user_name = :user_name OR email = :email");
    $checkUserStmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
    $checkUserStmt->bindParam(':email', $email, PDO::PARAM_STR);
    $checkUserStmt->execute();

    if ($checkUserStmt->rowCount() > 0) {
        // User already exists
        $response["success"] = false;
        $response["error"] = "User with the same username or email already exists.";
    } else {
        // Insert new user
        $sql = "INSERT INTO members (member_id, first_name, middle_name, last_name, user_name, password, email, phone_number, position, date_of_joining, position_in_ukeum, department_id, member_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Active')";
        
        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind parameters
            $stmt->bindParam(1, $member_id, PDO::PARAM_STR);
            $stmt->bindParam(2, $first_name, PDO::PARAM_STR);
            $stmt->bindParam(3, $middle_name, PDO::PARAM_STR);
            $stmt->bindParam(4, $last_name, PDO::PARAM_STR);
            $stmt->bindParam(5, $user_name, PDO::PARAM_STR);
            $stmt->bindParam(6, $password, PDO::PARAM_STR);
            $stmt->bindParam(7, $email, PDO::PARAM_STR);
            $stmt->bindParam(8, $phone_number, PDO::PARAM_STR);
            $stmt->bindParam(9, $position, PDO::PARAM_STR);
            $stmt->bindParam(10, $date_of_joining, PDO::PARAM_STR);
            $stmt->bindParam(11, $position_in_ukeum, PDO::PARAM_STR);
            $stmt->bindParam(12, $department_id, PDO::PARAM_STR);
    
            // Execute the SQL statement
            if ($stmt->execute()) {
                // Set success message in the response
                $response["success"] = true;
            } else {
                // Set error message in the response
                $response["success"] = false;
                $response["error"] = "Error: " . $stmt->errorInfo();
            }

            // Close the prepared statement
            $stmt->closeCursor();
        } else {
            // Set error message in the response if statement preparation fails
            $response["success"] = false;
            $response["error"] = "Statement preparation failed.";
        }
    }
} else {
    // Set error message in the response for invalid request
    $response["success"] = false;
    $response["error"] = "Invalid request.";
}

// Close the database connection
$conn = null;

// Send the response as JSON
header("Content-Type: application/json");
echo json_encode($response);
?>
