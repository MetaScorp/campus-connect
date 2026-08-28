<?php
require_once 'config.php';

$username = $conn->real_escape_string($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$grno = $conn->real_escape_string($_POST['grno'] ?? '');

$result = $conn->query("SELECT * FROM students WHERE username = '$username' AND grno = '$grno' LIMIT 1");

if ($result && $result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        echo json_encode([
            "error" => false,
            "user" => [
                "username" => $user['username'],
                "fullname" => $user['fullname'],
                "grno" => $user['grno'],
                "branch" => $user['branch'],
                "year" => $user['year'],
            ]
        ]);
    } else {
        echo json_encode(["error" => true, "error_msg" => "Incorrect password."]);
    }
} else {
    echo json_encode(["error" => true, "error_msg" => "No account found for that username / GR number."]);
}

$conn->close();
