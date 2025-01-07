<?php
session_start();
require '../dbconnection.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$user_id = (int) $_SESSION['user_id'];
$chat_partner = (int) $_POST['chat_partner'];
$message = trim($_POST['message']);

if (empty($message)) {
    echo json_encode(["error" => "Message cannot be empty"]);
    exit;
}

// Insert message into database
$sql = "INSERT INTO messages (sender_id, receiver_id, message, status) VALUES (?, ?, ?, 'unseen')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $user_id, $chat_partner, $message);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => $message]);
} else {
    echo json_encode(["error" => "Failed to send message"]);
}
?>
