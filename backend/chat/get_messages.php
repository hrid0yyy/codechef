<?php
require '../dbconnection.php'; // Adjust path if needed
session_start();

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['receiver_id'])) {
    $sender_id = $_SESSION['user_id']; // Get sender ID from session
    $receiver_id = $_GET['receiver_id'];

    $stmt = $conn->prepare("
        SELECT sender_id, message, timestamp 
        FROM messages 
        WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?)
        ORDER BY timestamp ASC
    ");
    $stmt->bind_param("iiii", $sender_id, $receiver_id, $receiver_id, $sender_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }

    echo json_encode(["status" => "success", "messages" => $messages]);

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}

$conn->close();
?>
