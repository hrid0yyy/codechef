<?php
session_start();
require '../dbconnection.php';

header("Content-Type: application/json");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit();
}

$user_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);
$receiver_id = isset($data['receiver_id']) ? intval($data['receiver_id']) : 0;
$message = isset($data['message']) ? trim($data['message']) : "";

if (empty($receiver_id) || empty($message)) {
    echo json_encode(["status" => "error", "message" => "Invalid input"]);
    exit();
}

// Insert into messages table
$query = "INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iis", $user_id, $receiver_id, $message);
$stmt->execute();
$stmt->close();

// Update last message in user_chats table
$updateChat = "INSERT INTO user_chats (user1_id, user2_id, last_message, last_message_time) 
               VALUES (?, ?, ?, NOW()) 
               ON DUPLICATE KEY UPDATE last_message = ?, last_message_time = NOW()";
$stmt = $conn->prepare($updateChat);
$stmt->bind_param("iiss", $user_id, $receiver_id, $message, $message);
$stmt->execute();
$stmt->close();

echo json_encode(["status" => "success", "message" => "Message sent"]);
?>
