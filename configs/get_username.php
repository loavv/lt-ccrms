<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    die('Not authenticated');
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT username FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

echo $user['username'];

$stmt->close();
$conn->close();
?> 