<?php

session_start();

include_once("../init.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $sum = $_POST["sum"];
    $date = $_POST["date"];

    // Retrieve the idEmployees from the employees table
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

    $sql = "INSERT INTO salaries (idEmployee, Sum, PayDate) VALUES (?, ?, ?)";

    if (!$stmt = $conn->prepare($sql)) {
        die("Error in SQL query: " . $conn->error);
    }

    $stmt->bind_param("ids", $idEmployee, $sum, $date,);

    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Salary added successfully!');</script>";
    } else {
        echo "Error adding salary: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>