<?php
// Include database connection and start session
include '../dbconnection.php'; // Adjust the path as needed
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user_id from the session
    $user_id = $_SESSION['user_id'] ?? null;
    $contest_id = $_POST['contest_id'] ?? null;

    // Validate inputs
    if (empty($user_id) || empty($contest_id)) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "User ID and Contest ID are required."]);
        exit;
    }

    try {
        // Check if the contest exists
        $contestCheckQuery = "SELECT contest_id FROM contests WHERE contest_id = ?";
        $contestCheckStmt = $conn->prepare($contestCheckQuery);
        $contestCheckStmt->bind_param("i", $contest_id);
        $contestCheckStmt->execute();
        $contestResult = $contestCheckStmt->get_result();

        if ($contestResult->num_rows === 0) {
            http_response_code(404); // Not Found
            echo json_encode(["error" => "Contest does not exist."]);
            exit;
        }

        // Insert registration into the database
        $query = "INSERT INTO registrations (user_id, contest_id) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $user_id, $contest_id);
        $stmt->execute();

        // Success response
        http_response_code(201); // Created
        echo json_encode(["success" => "User registered successfully for the contest!"]);
    } catch (Exception $e) {
        if ($conn->errno === 1062) { // Duplicate entry error
            http_response_code(409); // Conflict
            echo json_encode(["error" => "User is already registered for this contest."]);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Invalid request method."]);
}
?>
