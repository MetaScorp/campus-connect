<?php
require_once 'config.php';

$username = $conn->real_escape_string($_POST['username'] ?? '');
$nonteachid = $conn->real_escape_string($_POST['nonteachid'] ?? '');
$password = $_POST['password'] ?? '';
$confirmpassword = $_POST['confirmpassword'] ?? '';

if ($password !== $confirmpassword) {
    echo json_encode(["error" => true, "error_msg" => "Passwords do not match."]);
    exit();
}

$result = $conn->query("SELECT id FROM nonteaching WHERE username = '$username' AND nonteachid = '$nonteachid' LIMIT 1");

if ($result && $result->num_rows === 1) {
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE nonteaching SET password = ? WHERE username = ? AND nonteachid = ?");
    $stmt->bind_param("sss", $hashed, $username, $nonteachid);
    $stmt->execute();
    echo json_encode(["error" => false]);
    $stmt->close();
} else {
    echo json_encode(["error" => true, "error_msg" => "No account found for that username / Staff ID."]);
}

$conn->close();
