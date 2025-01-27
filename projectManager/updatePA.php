<?php

session_start();

include_once("../init.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $new_value = $_POST["value"];

    $sql = "UPDATE projects SET MemberNr = ? WHERE Name = ?";

    // Check for SQL syntax errors
    if (!$stmt = $conn->prepare($sql)) {
        die("Error in SQL query: " . $conn->error);
    }

    // Bind parameters to the prepared statement
    $stmt->bind_param("ss", $new_value, $name);

    // Execute the update statement
    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Information updated successfully!');</script>";
    } else {
        echo "Error updating number of member: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

$conn->close();
?>