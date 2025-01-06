<?php
require '../dbconnection.php'; // Adjust path if needed
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sender_id = $_SESSION['user_id']; // Get sender ID from session
    $receiver_id = $_POST['receiver_id'];
    $message = trim($_POST['message']);

    if (!empty($message)) {
        $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $sender_id, $receiver_id, $message);
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Message sent"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to send message"]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Message cannot be empty"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}

$conn->close();
?>
