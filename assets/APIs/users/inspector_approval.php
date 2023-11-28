<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Assuming you have a database connection established
require("../../connection/connection.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $app_type = $_POST['app_type'];
    $approval = $_POST['approval'];
    $vendor_id = $_POST['vendor_id'];

    if ($approval == "approve-button") {
        $status = 2;
    } else {
        $status = 3;
    }

    // Assuming you have valid tables
    $validTables = array('plastic', 'iron', 'disposal', 'eia');

    if (!in_array($app_type, $validTables)) {
        $response = array(
            'success' => false,
            'message' => 'Invalid Application Name provided.'
        );
        echo json_encode($response);
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM tb_vendor WHERE vendor_id = ?");
    $stmt->bindParam(1, $vendor_id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $vendorData = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = $conn->prepare("UPDATE " . $app_type . "_permit SET app_status_id = ? WHERE vendor_id = ?");
        $stmt->bindParam(1, $status, PDO::PARAM_INT); 
        $stmt->bindParam(2, $vendor_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            // Update successful, you can return a success response
            $response = array(
                "success" => true,
                "message" => "Application status updated successfully."
            );

            echo json_encode($response);
        } else {
            // Update failed
            $response = array(
                "success" => false,
                "message" => "Failed to update application status Or Status Exist."
            );

            echo json_encode($response);
        }
    } else {
        // Vendor data not found
        $response = array(
            "success" => false,
            "message" => "Vendor data not found."
        );

        echo json_encode($response);
    }
    $stmt = null;
    $conn = null;
} else {
    $response = array(
        "success" => false,
        "message" => "Invalid request"
    );

    echo json_encode($response);
}
