<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a database connection established already
    require("../../connection/connection.php");

    $app_type = $_POST['app_type'];
    $app_id = $_POST['app_id'];

    $validTables = array('plastic', 'iron', 'disposal', 'eia');

    if (!in_array($app_type, $validTables)) {
        $response = array(
            'success' => false,
            'message' => 'Invalid Application Name provided.'
        );
        echo json_encode($response);
        exit;
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM " . $app_type . "_permit p, tb_vendor v WHERE p.vendor_id = v.vendor_id AND p.vendor_id = ?");
    $stmt->bindParam(1, $app_id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            $response = array(
                "success" => true,
                "data" => $result,
            );

            echo json_encode($response);
        } else {
            $response = array(
                "success" => false,
                "message" => "Error Fetching data not found"
            );

            echo json_encode($response);
        }
    } else {
        // Application data not found
        $response = array(
            "success" => false,
            "message" => "Application data not found"
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
