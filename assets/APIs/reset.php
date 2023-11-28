<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require("../connection/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $user = $_POST['user'];

    $validTables = array('user', 'client');

    if (!in_array($user, $validTables)) {
        $response = array(
            'success' => false,
            'message' => 'Invalid table name provided.'
        );
        echo json_encode($response);
        exit;
    }

    $random_password = generateRandomPassword();

    $hashed_password = password_hash($random_password, PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("UPDATE tb_$user SET password = ? WHERE ". $user ."_id = ?");
        $stmt->bindParam(1, $hashed_password);
        $stmt->bindParam(2, $user_id);
        $stmt->execute();

        $stmt = $conn->prepare("SELECT email FROM tb_$user WHERE ". $user ."_id = ?");
        $stmt->bindParam(1, $user_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_email = $row['email'];

        $subject = "Your New Password";
        $message = "Your new password is: " . $random_password;
        $headers = "From: mamenmasau@gmail.com";  // Usama Kumbuka umeeka email yako

        if (mail($user_email, $subject, $message, $headers)) {
            echo json_encode(array("success" => true, "message" => "Password sent successfully."));
        } else {
            echo json_encode(array("success" => false, "message" => "Failed to send password to email."));
        }
    } catch (PDOException $e) {
        echo json_encode(array("success" => false, "message" => "Database error: " . $e->getMessage()));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request"));
}

function generateRandomPassword($length = 8)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}
