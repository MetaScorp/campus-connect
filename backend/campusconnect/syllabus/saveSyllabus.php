<?php
require_once '../config.php';

$chaptername = $conn->real_escape_string($_POST['chaptername'] ?? '');
$checked = $conn->real_escape_string($_POST['checked'] ?? '');
$tablename = $conn->real_escape_string($_POST['tablename'] ?? '');

$stmt = $conn->prepare("UPDATE syllabus SET checked = ? WHERE chaptername = ? AND table_key = ?");
$stmt->bind_param("sss", $checked, $chaptername, $tablename);

if ($stmt->execute()) {
    echo json_encode(["error" => false]);
} else {
    echo json_encode(["error" => true, "error_msg" => "Could not save syllabus update."]);
}

$stmt->close();
$conn->close();
