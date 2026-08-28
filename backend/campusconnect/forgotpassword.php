<?php
require_once 'config.php';

$username = $conn->real_escape_string($_POST['username'] ?? '');
$grno = $conn->real_escape_string($_POST['grno'] ?? '');
$password = $_POST['password'] ?? '';
$confirmpassword = $_POST['confirmpassword'] ?? '';

if ($password !== $confirmpassword) {
    echo json_encode(["error" => true, "error_msg" => "Passwords do not match."]);
    exit();
}

$result = $conn->query("SELECT id FROM students WHERE username = '$username' AND grno = '$grno' LIMIT 1");

if ($result && $result->num_rows === 1) {
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE students SET password = ? WHERE username = ? AND grno = ?");
    $stmt->bind_param("sss", $hashed, $username, $grno);
    $stmt->execute();
    echo json_encode(["error" => false]);
    $stmt->close();
} else {
    echo json_encode(["error" => true, "error_msg" => "No account found for that username / GR number."]);
}

$conn->close();
