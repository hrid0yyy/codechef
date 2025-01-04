<?php
session_start();
require '../dbconnection.php'; // Ensure correct path to DB connection

header('Content-Type: application/json'); // Set JSON response

if (!isset($_SESSION['user'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit();
}

$user_email = $_SESSION['user']; // Get email from session

$query = "SELECT total_problems_solved, rank_position FROM (
             SELECT email, total_problems_solved, 
                    RANK() OVER (ORDER BY total_problems_solved DESC, created_at ASC) AS rank_position
             FROM users
         ) ranked_users
         WHERE email = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$stmt->bind_result($total_solved, $rank_position);
$stmt->fetch();
$stmt->close();

if ($total_solved !== null) {
    echo json_encode([
        "status" => "success",
        "total_problems_solved" => $total_solved,
        "rank_position" => $rank_position
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "User not found"]);
}
?>
