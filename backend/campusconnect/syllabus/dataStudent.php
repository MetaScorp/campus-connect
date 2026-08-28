<?php
require_once '../config.php';

$tablename = $conn->real_escape_string($_POST['tablename'] ?? '');

$result = $conn->query("SELECT id, chaptername, checked FROM syllabus WHERE table_key = '$tablename' ORDER BY id ASC");

$rows = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $rows[] = [
            "id" => (string) $row['id'],
            "chaptername" => $row['chaptername'],
            "checked" => $row['checked'],
        ];
    }
}

echo json_encode($rows);

$conn->close();
