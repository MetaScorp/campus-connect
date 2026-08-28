<?php
require_once 'config.php';

$username = $conn->real_escape_string($_POST['username'] ?? '');
$teacherid = $conn->real_escape_string($_POST['teacherid'] ?? '');
$password = $_POST['password'] ?? '';
$confirmpassword = $_POST['confirmpassword'] ?? '';

if ($password !== $confirmpassword) {
    echo json_encode(["error" => true, "error_msg" => "Passwords do not match."]);
    exit();
}

$result = $conn->query("SELECT id FROM teachers WHERE username = '$username' AND teacherid = '$teacherid' LIMIT 1");

if ($result && $result->num_rows === 1) {
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE teachers SET password = ? WHERE username = ? AND teacherid = ?");
    $stmt->bind_param("sss", $hashed, $username, $teacherid);
    $stmt->execute();
    echo json_encode(["error" => false]);
    $stmt->close();
} else {
    echo json_encode(["error" => true, "error_msg" => "No account found for that username / Teacher ID."]);
}

$conn->close();
