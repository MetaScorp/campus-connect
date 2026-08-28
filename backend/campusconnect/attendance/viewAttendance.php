<?php
require_once '../config.php';

$tablename = $conn->real_escape_string($_POST['tablename'] ?? '');
$startdate = $conn->real_escape_string($_POST['startdate'] ?? '');
$enddate = $conn->real_escape_string($_POST['enddate'] ?? '');
$lect = (int) ($_POST['lect'] ?? 0);
if ($lect <= 0) {
    $lect = 1; // avoid divide-by-zero; original app passes its own lecture counter
}

$sql = "SELECT atrollno, COUNT(*) AS total
        FROM attendance
        WHERE table_key = '$tablename'
          AND atstatus = 'present'
          AND atdate BETWEEN '$startdate' AND '$enddate'
        GROUP BY atrollno
        ORDER BY CAST(atrollno AS UNSIGNED) ASC";

$result = $conn->query($sql);

$rows = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $percentage = round(($row['total'] / $lect) * 100, 2);
        $rows[] = [
            "Rollno" => $row['atrollno'],
            "Total" => (string) $row['total'],
            "Percentage" => (string) $percentage,
        ];
    }
}

echo json_encode($rows);

$conn->close();
