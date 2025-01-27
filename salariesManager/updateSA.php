<?php

session_start();

include_once("../init.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST["name"];
    $field_to_update = $_POST["field"];
    
     
    if ($field_to_update == "sum") {
        $value = $_POST["value"];
    } else if ($field_to_update == "payDate") {
        $value = $_POST["date"];
    } else {
        die("Invalid field to update.");
    }

    $sql = "SELECT idEmployees FROM employees WHERE Name = ?";
    
    if (!$stmt = $conn->prepare($sql)) {
        die("Error in SQL query: " . $conn->error);
    }

    $stmt->bind_param("s", $name);

    if (!$stmt->execute()) {
        die("Error retrieving employee ID: " . $conn->error);
    }

    $stmt->bind_result($idEmployee);
    $stmt->fetch();
    $stmt->close();

    if (!$idEmployee) {
        die("Employee not found.");
    }

    $sql = "UPDATE salaries SET $field_to_update = ? WHERE idEmployee = ?";
    
    if (!$stmt = $conn->prepare($sql)) {
        die("Error in SQL query: " . $conn->error);
    }

    $stmt->bind_param("si", $value, $idEmployee);

    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Information updated successfully!');</script>";
    } else {
        echo "Error updating salary information: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
