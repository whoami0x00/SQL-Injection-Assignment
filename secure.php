<?php
// secure.php

$host = "localhost";
$dbname = "injection_demo";
$user = "root";
$pass = "YOUR_DB_ROOT_PASSWORD"; // Replace with actual password

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];

// Parameterized query prevents SQL injection
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    echo "Login successful (secure)!";
} else {
    echo "Login failed!";
}

$stmt->close();
$conn->close();
?>
