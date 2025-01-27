<?php

session_start();

include_once("../init.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $phoneNr = $_POST["phoneNr"];
    $pwd = $_POST["pwd"];
    $department = $_POST["field"];

    $dep = 0;
    if ($department == "IT") {
        $dep = 100;
    } elseif ($department == "CS") {
        $dep = 103;
    }

    $sql = "INSERT INTO employees (Name, Surname, Email, PhoneNumber, idDepartments, Password)
            VALUES (?, ?, ?, ?, ?, ?)";

    // Check for SQL syntax errors
    if (!$stmt = $conn->prepare($sql)) {
        die("Error in SQL query: " . $conn->error);
    }

    // Bind parameters to the prepared statement
    $stmt->bind_param("ssssis", $name, $surname, $email, $phoneNr, $dep, $pwd);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Employee added successfully!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
}

$conn->close();
?>
