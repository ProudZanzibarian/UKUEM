<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("../../connection/connection.php");

try {
    $plastic = "SELECT * FROM plastic_permit p, app_status a WHERE p.app_status_id = a.app_status_id AND a.app_status_name = 'Completed'";
    $iron = "SELECT * FROM iron_permit p, app_status a WHERE p.app_status_id = a.app_status_id AND a.app_status_name = 'Completed'";

    $stmtPlastic = $conn->prepare($plastic);
    $stmtIron = $conn->prepare($iron);

    $stmtPlastic->execute();
    $stmtIron->execute();

    $dataPlastic = $stmtPlastic->fetchAll(PDO::FETCH_ASSOC);
    $dataIron = $stmtIron->fetchAll(PDO::FETCH_ASSOC);

    // Concatenate the results into a single array
    $data = array_merge($dataPlastic, $dataIron);

    echo json_encode($data);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
