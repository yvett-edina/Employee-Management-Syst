<?php

session_start();

include_once("../init.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $employee_name = $_POST["name"];
    $new_location = $_POST["value"];

    $sql = "UPDATE departments SET Location = ? WHERE Name = ?";

    // Check for SQL syntax errors
    if (!$stmt = $conn->prepare($sql)) {
        die("Error in SQL query: " . $conn->error);
    }

    // Bind parameters to the prepared statement
    $stmt->bind_param("ss", $new_location, $employee_name);

    // Execute the update statement
    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Location updated successfully!');</script>";
    } else {
        echo "Error updating department location: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

$conn->close();
?>