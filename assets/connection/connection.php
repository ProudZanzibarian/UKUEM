<?php
try {
    // Create a PDO instance
    $conn = new PDO("mysql:host=127.0.0.1;dbname=ukuem-members", "root", "");

    // Set PDO to throw exceptions on errors
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Failed to connect to MySQL: " . $e->getMessage());
}
?>
