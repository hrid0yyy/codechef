<?php
session_start();
require '../dbconnection.php';

header("Content-Type: application/json");

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT u.user_id, u.name, 
                 COALESCE(u.profilePicture, 'https://via.placeholder.com/40') AS profilePicture,
                 COALESCE(m.message, 'Start Chat') AS last_message, 
                 COALESCE(m.timestamp, '') AS last_message_time
          FROM users u
          LEFT JOIN (
              SELECT m1.sender_id, m1.receiver_id, m1.message, m1.timestamp
              FROM messages m1
              WHERE m1.timestamp = (
                  SELECT MAX(m2.timestamp) 
                  FROM messages m2 
                  WHERE (m2.sender_id = m1.sender_id AND m2.receiver_id = m1.receiver_id) 
                     OR (m2.sender_id = m1.receiver_id AND m2.receiver_id = m1.sender_id)
              )
          ) m ON (u.user_id = m.sender_id OR u.user_id = m.receiver_id)
          WHERE u.user_id != ?
          GROUP BY u.user_id
          ORDER BY last_message_time DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

echo json_encode(["status" => "success", "users" => $users]);
?>
