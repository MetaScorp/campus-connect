<?php
require_once 'config.php';

$username = $conn->real_escape_string($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$teacherid = $conn->real_escape_string($_POST['teacherid'] ?? '');

$result = $conn->query("SELECT * FROM teachers WHERE username = '$username' AND teacherid = '$teacherid' LIMIT 1");

if ($result && $result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        echo json_encode([
            "error" => false,
            "user" => [
                "username" => $user['username'],
                "fullname" => $user['fullname'],
                "teacherid" => $user['teacherid'],
            ]
        ]);
    } else {
        echo json_encode(["error" => true, "error_msg" => "Incorrect password."]);
    }
} else {
    echo json_encode(["error" => true, "error_msg" => "No account found for that username / Teacher ID."]);
}

$conn->close();
