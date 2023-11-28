<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("../connection/connection.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $permit_date = date("Y-m-d");
    $type_of_plastic = $_POST["type_of_plastic"];
    $reason = $_POST["reason"];
    $amount = $_POST["amount"];
    $size = $_POST["size"];
    $date_of_arrival = $_POST["date_of_arrival"];
    $place_of_storage = $_POST["place_of_storage"];
    $duration_of_storage = $_POST["duration_of_storage"];
    $uses = $_POST["uses"];
    $duration_of_uses = $_POST["duration_of_uses"];
    $amount_disposed = $_POST["amount_disposed"];
    $disposal_date = $_POST["disposal_date"];
    $app_status_id = 1;

    $id_type_id = 1;
    $id_photo = "photo"; 
    
    // Insert data into tb_vendor
    $vendorInsertQuery = "INSERT INTO tb_vendor (first_name, middle_name, last_name, address, phone_number, email, nationality, id_type_id, id_photo, office_address, contact_person_name, contact_person_no, role_in_office)
    VALUES (:first_name, :middle_name, :last_name, :address, :phone_number, :email, :nationality, :id_type_id, :id_photo, :office_address, :contact_person_name, :contact_person_no, :role_in_office)";
    
    $stmt = $conn->prepare($vendorInsertQuery);
    
    // Bind parameters for the vendor table
    $stmt->bindParam(':first_name', $_POST["first-name"]);
    $stmt->bindParam(':middle_name', $_POST["middle-name"]);
    $stmt->bindParam(':last_name', $_POST["last-name"]);
    $stmt->bindParam(':address', $_POST["correspondence-address"]);
    $stmt->bindParam(':phone_number', $_POST["phone"]);
    $stmt->bindParam(':email', $_POST["email"]);
    $stmt->bindParam(':nationality', $_POST["nationality"]);
    $stmt->bindParam(':id_type_id', $id_type_id);
    $stmt->bindParam(':id_photo', $id_photo); 
    $stmt->bindParam(':office_address', $_POST["address_of_office"]);
    $stmt->bindParam(':contact_person_name', $_POST["contact-person"]);
    $stmt->bindParam(':contact_person_no', $_POST["contact_person_no"]);
    $stmt->bindParam(':role_in_office', $_POST["address_of_office"]);
    $stmt->bindParam(':contact_person_name', $_POST["contact-person"]);
    $stmt->bindParam(':contact_person_no', $_POST["contact_person_no"]);
    $stmt->bindParam(':role_in_office', $_POST["address_of_office"]);

    // Execute the vendor query
    if ($stmt->execute()) {
        // Get the generated vendor_id
        $vendor_id = $conn->lastInsertId();

        // Insert data into plastic_permit using the vendor_id
        $permitInsertQuery = "INSERT INTO plastic_permit (vendor_id, app_date, type_of_plastic, reason, amount, size, date_of_arrival, place_of_storage, duration_of_storage, uses, duration_of_uses, amount_disposed, disposal_date, app_status_id)
        VALUES (:vendor_id, :app_date, :type_of_plastic, :reason, :amount, :size, :date_of_arrival, :place_of_storage, :duration_of_storage, :uses, :duration_of_uses, :amount_disposed, :disposal_date, :app_status_id)";

        $stmt = $conn->prepare($permitInsertQuery);

        // Bind parameters for the permit table
        $stmt->bindParam(':vendor_id', $vendor_id);
        $stmt->bindParam(':app_date', $permit_date);
        $stmt->bindParam(':type_of_plastic', $type_of_plastic);
        $stmt->bindParam(':reason', $reason);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':date_of_arrival', $date_of_arrival);
        $stmt->bindParam(':place_of_storage', $place_of_storage);
        $stmt->bindParam(':duration_of_storage', $duration_of_storage);
        $stmt->bindParam(':uses', $uses);
        $stmt->bindParam(':duration_of_uses', $duration_of_uses);
        $stmt->bindParam(':amount_disposed', $amount_disposed);
        $stmt->bindParam(':disposal_date', $disposal_date);
        $stmt->bindParam(':app_status_id', $app_status_id);

        // Execute the permit query
        if ($stmt->execute()) {
            // Send a success response back to the JavaScript code
            $response = array("success" => "Plastic Permit Application Captured Successfully");
            header("Content-Type: application/json");
            echo json_encode($response);
        } else {
            // Handle the database insert error for plastic_permit
            $response = array("message" => "Error inserting data into plastic_permit");
            header("Content-Type: application/json");
            echo json_encode($response);
        }
    } else {
        // Handle the database insert error for tb_vendor
        $response = array("message" => "Error inserting data into tb_vendor");
        header("Content-Type: application/json");
        echo json_encode($response);
    }
}
?>
