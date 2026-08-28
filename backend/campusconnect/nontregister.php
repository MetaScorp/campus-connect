<?php
require_once 'config.php';

$fullname = $conn->real_escape_string($_POST['fullname'] ?? '');
$username = $conn->real_escape_string($_POST['username'] ?? '');
$email = $conn->real_escape_string($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirmpassword = $_POST['confirmpassword'] ?? '';

if ($password !== $confirmpassword) {
    echo json_encode(["error" => true, "error_msg" => "Passwords do not match."]);
    exit();
}

if (empty($fullname) || empty($username) || empty($email) || empty($password)) {
    echo json_encode(["error" => true, "error_msg" => "All fields are required."]);
    exit();
}

$existing = $conn->query("SELECT id FROM nonteaching WHERE username = '$username'");
if ($existing && $existing->num_rows > 0) {
    echo json_encode(["error" => true, "error_msg" => "Username already taken."]);
    exit();
}

$nonteachid = "NT" . str_pad(mt_rand(1, 9999), 4, "0", STR_PAD_LEFT);
$hashed = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO nonteaching (fullname, username, nonteachid, email, password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $fullname, $username, $nonteachid, $email, $hashed);

if ($stmt->execute()) {
    echo json_encode(["error" => false, "nonteachid" => $nonteachid]);
} else {
    echo json_encode(["error" => true, "error_msg" => "Registration failed. Please try again."]);
}

$stmt->close();
$conn->close();
