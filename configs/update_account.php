<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    die('Not authenticated');
}

$user_id = $_SESSION['user_id'];
$username = $_POST['username'];
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

// Validate current password
$stmt = $conn->prepare("SELECT password FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!password_verify($current_password, $user['password'])) {
    die('Current password is incorrect');
}

// Check if username is already taken by another user
$stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ? AND user_id != ?");
$stmt->bind_param("si", $username, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    die('Username is already taken');
}

// Update username
$stmt = $conn->prepare("UPDATE users SET username = ? WHERE user_id = ?");
$stmt->bind_param("si", $username, $user_id);
$stmt->execute();

// Update password if provided
if (!empty($new_password)) {
    if ($new_password !== $confirm_password) {
        die('New passwords do not match');
    }
    
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE user_id = ?");
    $stmt->bind_param("si", $hashed_password, $user_id);
    $stmt->execute();
}

echo 'success';

$stmt->close();
$conn->close();
?> 