<?php
session_start();
/* require("../connection/connection.php");
ini_set('display_errors', 1);
error_reporting(E_ALL);

$username = $_SESSION['username'];
$status = $_SESSION['position'];

try {
    $sql2 = "SELECT * FROM tb_user";
    $stmt = $conn->query($sql2);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $loginTime = $row['Login_Time'];
        $date = date('Y-m-d H:i:s');
        $sql = "UPDATE user_log SET Logout_Time = NOW() WHERE username = ? AND Login_Time = ?";
        $stmtUpdate = $conn->prepare($sql);
        $stmtUpdate->bindParam(1, $username);
        $stmtUpdate->bindParam(2, $loginTime);
        $stmtUpdate->execute();

        unset($_SESSION['username']);
        session_destroy();
        header('Location:.../../../index.php');
}
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} */

unset($_SESSION['username']);
header('Location:../../../index.php');
session_destroy();
?>
