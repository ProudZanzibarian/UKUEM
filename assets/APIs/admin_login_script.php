<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require("../connection/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("SELECT * FROM tb_user WHERE username = ?");
        $stmt->bindParam(1, $username);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            if (password_verify($_POST['password'], $row['pwd'])) {
                $_SESSION['username'] = $username;
                $_SESSION['position'] = $row['position'];
                $_SESSION['status'] = $row['user_status_id'];

                if ($_SESSION['status'] === 2) {
                    // Return a JSON response indicating an error
                    echo json_encode(array("success" => false, "message" => "This user is inactive" ));
                } else {
                    // Return a JSON response indicating success
                    echo json_encode(array("success" => true, "position" => $row['position'] ));
                }
            } else {
                // Password is incorrect
                echo json_encode(array("success" => false, "message" => "Incorrect password"));
            }
        } else {
            // User not found
            echo json_encode(array("success" => false, "message" => "User not found"));
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo json_encode(array("success" => false, "message" => "Database error: " . $e->getMessage()));
    }
} else {
    // Invalid request method
    echo json_encode(array("success" => false, "message" => "Invalid request"));
}
