<?php
// Include database connection
include '../dbconnection.php'; // Ensure the correct path to your dbconnection.php

// Check if contest_id is provided
if (!isset($_GET['contest_id']) && !isset($_POST['contest_id'])) {
    http_response_code(400); // Bad Request
    echo json_encode(["error" => "Contest ID is required."]);
    exit;
}

// Retrieve contest_id from GET or POST
$contest_id = isset($_GET['contest_id']) ? intval($_GET['contest_id']) : intval($_POST['contest_id']);

try {
    // Prepare SQL query to fetch contest details
    $query = "SELECT * FROM contests WHERE contest_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $contest_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a contest was found
    if ($result->num_rows === 0) {
        http_response_code(404); // Not Found
        echo json_encode(["error" => "No contest found for the provided ID."]);
        exit;
    }

    // Fetch contest details
    $contest = $result->fetch_assoc();

    // Send contest details as JSON response
    echo json_encode($contest);
} catch (Exception $e) {
    http_response_code(500); // Internal Server Error
    echo json_encode(["error" => $e->getMessage()]);
}
?>
