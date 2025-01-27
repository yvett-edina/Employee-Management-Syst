<?php

include_once("../init.php");

$sql = "SELECT e.Name as name, e.Surname as surname, e.Email as email, e.PhoneNumber as phoneNr, d.Name as department
        FROM employees e
        JOIN departments d ON e.idDepartments = d.idDepartments";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Name</th>';
    echo '<th>Surname</th>';
    echo '<th>Email</th>';
    echo '<th>Phone Number</th>';
    echo '<th>Department</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['surname'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['phoneNr'] . '</td>';
        echo '<td>' . $row['department'] . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo 'No employees found.';
}

$conn->close();
?>
