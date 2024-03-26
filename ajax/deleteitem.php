<?php

require_once "../connection.php";
require_once "../functions.php";

$id = $_POST["id"];

$stmt = $conn->prepare("DELETE FROM `todos` WHERE id = ?");
$stmt->bind_param("i", $id); // Bind ID as an integer

if ($stmt->execute()) {
    $response = array("status" => "success", "message" => "Item deleted successfully");
    echo json_encode($response);
} else {
    $error = mysqli_error($conn); // Retrieve specific error message
    $response = array("status" => "error", "message" => "Deletion failed: $error");
    echo json_encode($response);
}

$stmt->close();
$conn->close();