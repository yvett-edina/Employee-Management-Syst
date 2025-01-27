<?php

include_once("../init.php");

$sql = "SELECT e.Name as name, s.Sum as sum, s.PayDate as payDate
        FROM salaries s
        JOIN employees e ON e.idEmployees = s.idEmployee";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Name</th>';
    echo '<th>Salary</th>';
    echo '<th>Pay Date</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['sum'] . '</td>';
        echo '<td>' . $row['payDate'] . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo 'No salaries found.';
}

$conn->close();
?>
