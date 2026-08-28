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

$existing = $conn->query("SELECT id FROM students WHERE username = '$username'");
if ($existing && $existing->num_rows > 0) {
    echo json_encode(["error" => true, "error_msg" => "Username already taken."]);
    exit();
}

// The original app's registration screen doesn't collect a GR number
// (that's assigned during the branch/year "Setup" screens after first
// login), so a placeholder GR number is generated here and can be
// updated later the same way the original init flow intended.
$grno = "GR" . str_pad(mt_rand(1, 99999), 5, "0", STR_PAD_LEFT);
$hashed = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO students (fullname, username, grno, email, password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $fullname, $username, $grno, $email, $hashed);

if ($stmt->execute()) {
    echo json_encode(["error" => false, "grno" => $grno]);
} else {
    echo json_encode(["error" => true, "error_msg" => "Registration failed. Please try again."]);
}

$stmt->close();
$conn->close();
