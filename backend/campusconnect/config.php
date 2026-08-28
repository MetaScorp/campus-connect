<?php
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "campusconnect";

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($conn->connect_error) {
    header('Content-Type: application/json');
    echo json_encode(["error" => true, "error_msg" => "Database connection failed."]);
    exit();
}

header('Content-Type: application/json');
