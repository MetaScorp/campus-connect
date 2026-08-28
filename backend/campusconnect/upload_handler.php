<?php
// Shared handler for all *upload.php endpoints. Each caller sets
// $tableKey to whichever bucket that endpoint represents (a branch,
// "notices", or "general") and includes this file.

require_once __DIR__ . '/config.php';

if (!isset($tableKey)) {
    echo json_encode(["error" => true, "error_msg" => "Server misconfiguration: no table key set."]);
    exit();
}

if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(["error" => true, "error_msg" => "No file received."]);
    exit();
}

$displayName = $_POST['name'] ?? $_FILES['file']['name'];
$safeName = time() . "_" . preg_replace('/[^A-Za-z0-9._-]/', '_', $displayName);
$destDir = __DIR__ . '/uploads/';
$destPath = $destDir . $safeName;

if (!is_dir($destDir)) {
    mkdir($destDir, 0755, true);
}

if (move_uploaded_file($_FILES['file']['tmp_name'], $destPath)) {
    $url = "uploads/" . $safeName;
    $stmt = $conn->prepare("INSERT INTO files (table_key, name, url) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $tableKey, $displayName, $url);
    if ($stmt->execute()) {
        echo json_encode(["error" => false, "name" => $displayName, "url" => $url]);
    } else {
        echo json_encode(["error" => true, "error_msg" => "File saved but database record failed."]);
    }
    $stmt->close();
} else {
    echo json_encode(["error" => true, "error_msg" => "Could not save the uploaded file."]);
}

$conn->close();
