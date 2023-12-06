<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require("../connection/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user_name'];
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT * FROM members m, department d WHERE  m.user_name = ? OR m.email = ? AND m.department_id = d.department_id ");
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $username);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_name'] = $username;
                $_SESSION['position'] = $row['position'];
                $_SESSION['status'] = $row['member_status'];

                if ($_SESSION["user_name"] == $row["head"]) {
                    $_SESSION["head"] = $row['head'];
                }

                if ($_SESSION['status'] !== "Active") {
                    // Return a JSON response indicating an error
                    echo json_encode(array("success" => false, "message" => "This user is inactive"));
                } else {
                    // Return a JSON response indicating success
                    echo json_encode(array("success" => true, "position" => $row['position']));
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
