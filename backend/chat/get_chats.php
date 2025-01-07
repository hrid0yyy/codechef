<?php

session_start();
require '../dbconnection.php'; 

$user_id = $_SESSION['user_id']; 

$sql = "
WITH LastMessages AS (
    SELECT 
        CASE 
            WHEN sender_id = $user_id THEN receiver_id 
            ELSE sender_id 
        END AS chat_partner,
        message,
        timestamp,
        sender_id AS last_sender
    FROM messages
    WHERE sender_id = $user_id OR receiver_id = $user_id
    ORDER BY timestamp DESC
)
SELECT 
    u.user_id AS chat_partner_id,
    u.name AS chat_partner_name,
    u.profilePicture AS chat_partner_profile,
    lm.message AS last_message,
    lm.timestamp AS last_message_time,
    lm.last_sender,
    COALESCE(unseen.count_unseen, 0) AS unseen_messages
FROM (
    SELECT 
        *,
        ROW_NUMBER() OVER (PARTITION BY chat_partner ORDER BY timestamp DESC) AS rn
    FROM LastMessages
) lm
JOIN users u ON lm.chat_partner = u.user_id
LEFT JOIN (
    SELECT 
        CASE 
            WHEN sender_id = $user_id THEN receiver_id 
            ELSE sender_id 
        END AS chat_partner,
        COUNT(*) AS count_unseen
    FROM messages
    WHERE receiver_id = $user_id AND status = 'unseen'
    GROUP BY chat_partner
) unseen ON lm.chat_partner = unseen.chat_partner
WHERE lm.rn = 1;
";

$result = $conn->query($sql);
$chats = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $chats[] = $row;
    }
}

header('Content-Type: application/json');

echo json_encode($chats);
?>
