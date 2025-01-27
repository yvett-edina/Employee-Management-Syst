<?php

include_once("../init.php");

$sql = "SELECT p.Name as name, p.MemberNr as memberNr, d.Name as department
        FROM projects p
        JOIN departments d ON p.idDepartments = d.idDepartments";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Name</th>';
    echo '<th>Number of members</th>';
    echo '<th>Department</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['memberNr'] . '</td>';
        echo '<td>' . $row['department'] . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo 'No projects found.';
}

$conn->close();
?>
