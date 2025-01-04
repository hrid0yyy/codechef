<?php
session_start();
require '../dbconnection.php';

header("Content-Type: application/json");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit();
}

$user_id = $_SESSION['user_id'];
$contact_id = isset($_GET['contact_id']) ? intval($_GET['contact_id']) : 0;

$query = "
    SELECT id, sender_id, receiver_id, message, timestamp 
    FROM messages 
    WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) 
    ORDER BY timestamp ASC
";

$stmt = $conn->prepare($query);
$stmt->bind_param("iiii", $user_id, $contact_id, $contact_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$messages = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

echo json_encode(["status" => "success", "messages" => $messages]);
?>
