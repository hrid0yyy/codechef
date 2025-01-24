<?php
require_once '../dbconnection.php'; // Include your database connection file

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Validate required parameters
    if (!isset($_GET['contestId']) || !isset($_GET['userId'])) {
        echo json_encode(["error" => "Contest ID and User ID are required."]);
        exit();
    }

    $contestId = $_GET['contestId'];
    $userId = $_GET['userId'];

    // SQL query to check registration
    $query = "
        SELECT COUNT(*) AS is_registered
        FROM registrations
        WHERE contest_id = ? AND user_id = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $contestId, $userId);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $isRegistered = $row['is_registered'] > 0;
        echo json_encode(["isRegistered" => $isRegistered]);
    } else {
        echo json_encode(["error" => "Failed to check registration."]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid request method. Use GET."]);
}

$conn->close();
