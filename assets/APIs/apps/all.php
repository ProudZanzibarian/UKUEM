<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("../../connection/connection.php");

try {
    $plastic = "SELECT * FROM plastic_permit p, app_status a, tb_vendor v WHERE v.vendor_id = p.vendor_id AND p.app_status_id = a.app_status_id ";
    $iron = "SELECT * FROM iron_permit p, app_status a, tb_vendor v WHERE v.vendor_id = p.vendor_id AND p.app_status_id = a.app_status_id ";
    
    $stmtPlastic = $conn->prepare($plastic);
    $stmtIron = $conn->prepare($iron);

    $stmtPlastic->execute();
    $stmtIron->execute();

    $dataPlastic = $stmtPlastic->fetchAll(PDO::FETCH_ASSOC);
    $dataIron = $stmtIron->fetchAll(PDO::FETCH_ASSOC);

    $data = array_merge($dataPlastic, $dataIron);

    echo json_encode($data);
} catch(PDOException $e) {
    echo json_encode("Error: " . $e->getMessage());
}

$conn = null;
?>
