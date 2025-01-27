<?php

session_start();

include_once("init.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $field_to_update = $_POST["field"];
    $new_value = $_POST["value"];

    // Prepare SQL statement to update data in the database
    $sql = "UPDATE employees SET $field_to_update = ? WHERE Name='" . $_SESSION['username'] . "'";

    // Check for SQL syntax errors
    if (!$stmt = $conn->prepare($sql)) {
        die("Error in SQL query: " . $conn->error);
    }

    // Bind parameters to the prepared statement
    $stmt->bind_param("s", $new_value);

    // Execute the update statement
    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Information updated successfully!');</script>";
    } else {
        echo "Error updating student information: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

