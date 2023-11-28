<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("../../connection/connection.php");

try {
    $sql = "SELECT * FROM tb_client u, user_status s WHERE u.user_status_id = s.user_status_id AND u.user_status_id = 2";
    
    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
    
} catch(PDOException $e) {

    echo json_encode("Error: " . $e->getMessage());
}

$conn = null;
