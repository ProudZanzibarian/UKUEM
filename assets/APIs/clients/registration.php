<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("../../connection/connection.php");

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $last_name = $_POST["last_name"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $username = $_POST["username"];
    $id_type = $_POST["register-ids"];
    $id_photo = $_POST["id_photo"];
    $id_number = $_POST["id_number"];
    $nationality = $_POST["nationality"];
    $password = $_POST["password"];
    $profile_photo = $_POST["profile_photo"];
    $user_status_id = 1;


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO tb_client (first_name, middle_name, last_name, address, email, phone_number, nationality, id_type_id, id_number, id_photo, profile_photo, username, password, position, user_status_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bindParam(1, $first_name, PDO::PARAM_STR);
    $stmt->bindParam(2, $middle_name, PDO::PARAM_STR);
    $stmt->bindParam(3, $last_name, PDO::PARAM_STR);
    $stmt->bindParam(4, $address, PDO::PARAM_STR);
    $stmt->bindParam(5, $email, PDO::PARAM_STR);
    $stmt->bindParam(6, $phone_number, PDO::PARAM_STR);
    $stmt->bindParam(7, $nationality, PDO::PARAM_STR);
    $stmt->bindParam(8, $id_type, PDO::PARAM_STR);
    $stmt->bindParam(9, $id_number, PDO::PARAM_STR);
    $stmt->bindParam(10, $id_photo, PDO::PARAM_STR);
    $stmt->bindParam(11, $profile_photo, PDO::PARAM_STR);
    $stmt->bindParam(12, $username, PDO::PARAM_STR);
    $stmt->bindParam(13, $hashed_password, PDO::PARAM_STR);
    $stmt->bindParam(14, $position, PDO::PARAM_STR);
    $stmt->bindParam(15, $user_status_id, PDO::PARAM_STR);
    
    // Execute the SQL statement
    if ($stmt->execute()) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false));
    }

    $stmt->closeCursor();
}

$conn = null;
?>
