<?php

require_once "../connection.php";
require_once "../functions.php";

$text = $_POST["text"];
$state = isset($_POST["state"]) ? $_POST["state"] : "todo"; // Optional: Set default state
$important = isset($_POST["important"]) ? $_POST["important"] : 0; // Convert to boolean

// **Sanitize and Validate Data (Important!)**
$text = mysqli_real_escape_string($conn, $text);  // Prevent SQL injection
$state = in_array($state, ["todo", "progress", "completed"]) ? $state : "todo"; // Validate state

$q = "INSERT INTO todos (`text`, `state`, `important`) VALUES (?, ?, ?)";
$stmt = $conn->prepare($q);
$stmt->bind_param("sss", $text, $state, $important);

if ($stmt->execute()) {
  $id = $stmt->insert_id;
  $response = array("status" => "success", "message" => "todo added successfully", "id" => "$id");
  echo json_encode($response);
} else {
  $error = mysqli_error($conn);
  $response = array("status" => "error", "message" => "Failed to add item: $error");
  echo json_encode($response);
}



$stmt->close();
$conn->close();
