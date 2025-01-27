<?php

session_start();

include_once("../init.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $memberNr = $_POST["memberNr"];
    $department = $_POST["field"];

    $dep = 0;
    if ($department == "IT") {
        $dep = 100;
    } elseif ($department == "CS") {
        $dep = 103;
    }

    $sql = "INSERT INTO projects (Name, MemberNr, idDepartments)
            VALUES (?, ?, ?)";

    // Check for SQL syntax errors
    if (!$stmt = $conn->prepare($sql)) {
        die("Error in SQL query: " . $conn->error);
    }

    // Bind parameters to the prepared statement
    $stmt->bind_param("ssi", $name, $memberNr, $dep);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Project added successfully!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
}

$conn->close();
?>
