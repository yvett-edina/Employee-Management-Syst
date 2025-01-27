<?php

session_start();

include_once("../init.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];

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

    $sql = "DELETE FROM salaries WHERE idEmployee = ?";

    // Check for SQL syntax errors
    if (!$stmt = $conn->prepare($sql)) {
        die("Error in SQL query: " . $conn->error);
    }

    // Bind parameters to the prepared statement
    $stmt->bind_param("i", $idEmployee);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Check if any rows were affected
        if ($stmt->affected_rows > 0) {
            echo "<script type='text/javascript'>alert('Salary deleted successfully!');</script>";
        } else {
            echo "No salary found for the employee with the provided name.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
}

$conn->close();
?>
