<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("../../connection/connection.php");

// Initialize the response array
$response = array();

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $last_name = $_POST["last_name"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $phone_no = $_POST["phone_no"];
    $username = $_POST["username"];
    $password = $_POST["pwd"];
    $position = $_POST["position"];
    $user_status_id = 1;

    // Hash the password for security (you should use a more secure method)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL statement to insert data into the database
    $sql = "INSERT INTO tb_user (first_name, middle_name, last_name, address, email, phone_no, username, pwd, position, user_status_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters
        $stmt->bindParam(1, $first_name, PDO::PARAM_STR);
        $stmt->bindParam(2, $middle_name, PDO::PARAM_STR);
        $stmt->bindParam(3, $last_name, PDO::PARAM_STR);
        $stmt->bindParam(4, $address, PDO::PARAM_STR);
        $stmt->bindParam(5, $email, PDO::PARAM_STR);
        $stmt->bindParam(6, $phone_no, PDO::PARAM_STR);
        $stmt->bindParam(7, $username, PDO::PARAM_STR);
        $stmt->bindParam(8, $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(9, $position, PDO::PARAM_STR);
        $stmt->bindParam(10, $user_status_id, PDO::PARAM_INT);

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
