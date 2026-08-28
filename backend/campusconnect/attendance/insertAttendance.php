<?php
require_once '../config.php';

$tablename = $conn->real_escape_string($_POST['tablename'] ?? '');
$atrollno = $conn->real_escape_string($_POST['atrollno'] ?? '');
$atdate = $conn->real_escape_string($_POST['atdate'] ?? '');
$atstatus = $conn->real_escape_string($_POST['atstatus'] ?? '');

$stmt = $conn->prepare("INSERT INTO attendance (table_key, atrollno, atdate, atstatus) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $tablename, $atrollno, $atdate, $atstatus);

if ($stmt->execute()) {
    echo json_encode(["error" => false]);
} else {
    echo json_encode(["error" => true, "error_msg" => "Could not save attendance."]);
}

$stmt->close();
$conn->close();
