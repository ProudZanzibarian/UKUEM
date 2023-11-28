<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    if (isset($_POST['user_id'])) {
        // Sanitize and get the user_id, user, and user_status from the POST data
        $user_id = filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT);
        $user = $_POST['user'];
        $user_status = $_POST['user_status'];

        // Determine the new user_status
        $new_user_status = ($user_status == 1) ? 2 : (($user_status == 2) ? 1 : null);

        // Check if the new_user_status is valid
        if ($new_user_status === null) {
            $response = array(
                'success' => false,
                'message' => 'Invalid user status provided.'
            );
            echo json_encode($response);
            exit;
        }

        $validTables = array('user', 'client');

        if (!in_array($user, $validTables)) {
            $response = array(
                'success' => false,
                'message' => 'Invalid table name provided.'
            );
            echo json_encode($response);
            exit;
        }

        require_once('../connection/connection.php');

        $sql = "UPDATE tb_$user SET user_status_id = ? WHERE " .  $user . "_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $new_user_status, PDO::PARAM_INT);
        $stmt->bindParam(2, $user_id, PDO::PARAM_INT);

        if ($new_user_status == 1) {
            if ($stmt->execute()) {
                $response = array(
                    'success' => true,
                    'message' => "User enabled"
                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Error updating user status: ' . $stmt->errorInfo()[2]
                );
            }
        } else {
            if ($stmt->execute()) {
                $response = array(
                    'success' => true,
                    'message' => "User disabled"
                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Error updating user status: ' . $stmt->errorInfo()[2]
                );
            }        }

        echo json_encode($response);

        $conn = null;
    } else {
        $response = array(
            'success' => false,
            'message' => 'User ID not provided in the POST request.'
        );
        echo json_encode($response);
    }
} catch (\Throwable $th) {
    echo json_encode(array(
        'success' => false,
        'message' => 'Error: ' . $th->getMessage()
    ));
}
