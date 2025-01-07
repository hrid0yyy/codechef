<?php
session_start();
require '../dbconnection.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$user_id = (int) $_SESSION['user_id'];
$chat_partner = (int) $_GET['chat_partner']; // ID of the selected user

// ✅ 1️⃣ Update messages to "seen"
$update_sql = "UPDATE messages SET status = 'seen' WHERE receiver_id = ? AND sender_id = ? AND status = 'unseen'";
$update_stmt = $conn->prepare($update_sql);
$update_stmt->bind_param("ii", $user_id, $chat_partner);
$update_stmt->execute();

// ✅ 2️⃣ Fetch messages after updating status
$sql = "SELECT * FROM messages 
        WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?)
        ORDER BY timestamp ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iiii", $user_id, $chat_partner, $chat_partner, $user_id);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

echo json_encode($messages);
?>
