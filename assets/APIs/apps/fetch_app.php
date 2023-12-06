<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require("../../connection/connection.php");

// Fetch all members
$stmt = $conn->prepare("SELECT * FROM members");
$stmt->execute();
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all departments
$stmt = $conn->prepare("SELECT * FROM department");
$stmt->execute();
$departments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Initialize an array to store member counts for each department
$memberCounts = array();

// Iterate through departments to get member counts
foreach ($departments as $department) {
    $departmentId = $department['department_id'];

    // Use a placeholder for the count alias, and bind the actual values
    $stmt = $conn->prepare("SELECT COUNT(*) as member_count FROM members WHERE department_id = ?");
    $stmt->bindParam(1, $departmentId, PDO::PARAM_INT);

    // Execute the query
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Access the count value using the alias
    $memberCount = $result['member_count'];

    // Store the member count in the array
    $memberCounts[$departmentId] = $memberCount;
}

// Merge the memberCounts array with the departments array
foreach ($departments as &$department) {
    $departmentId = $department['department_id'];

    // Add the member count to the department
    $department['member_count'] = $memberCounts[$departmentId];
}

// Add the memberCounts array to the response
$response = array('success' => true, 'members' => $members, 'departments' => $departments);

// Return the data as JSON
header("Content-Type: application/json");
echo json_encode($response);

// Clean up
$stmt = null;
$conn = null;
?>
