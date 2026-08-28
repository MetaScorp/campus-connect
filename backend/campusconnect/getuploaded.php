<?php
require_once 'config.php';

$tablename = $conn->real_escape_string($_POST['tablename'] ?? '');

$result = $conn->query("SELECT name, url FROM files WHERE table_key = '$tablename' ORDER BY uploaded_at DESC");

$rows = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $rows[] = [
            "name" => $row['name'],
            "url" => $row['url'],
        ];
    }
}

echo json_encode($rows);

$conn->close();
