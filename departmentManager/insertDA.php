<?php

session_start();

include_once("../init.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $location = $_POST["location"];

    $sql = "INSERT INTO departments (Name, Location)
            VALUES (?, ?)";

    // Check for SQL syntax errors
    if (!$stmt = $conn->prepare($sql)) {
        die("Error in SQL query: " . $conn->error);
    }

    // Bind parameters to the prepared statement
    $stmt->bind_param("ss", $name, $location);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Department added successfully!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
}

$conn->close();
?>
