<?php
require_once '../config.php';

$chaptername = $conn->real_escape_string($_POST['chaptername'] ?? '');
$tablename = $conn->real_escape_string($_POST['tablename'] ?? '');

$stmt = $conn->prepare("UPDATE syllabus SET checked = '0' WHERE chaptername = ? AND table_key = ?");
$stmt->bind_param("ss", $chaptername, $tablename);

if ($stmt->execute()) {
    echo json_encode(["error" => false]);
} else {
    echo json_encode(["error" => true, "error_msg" => "Could not update syllabus."]);
}

$stmt->close();
$conn->close();
