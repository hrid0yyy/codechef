<?php
require '../dbconnection.php'; // Include your database connection file

// Validate contest_id parameter
if (!isset($_GET['contest_id'])) {
    http_response_code(400); // Bad Request
    echo json_encode(["error" => "contest_id is required."]);
    exit;
}

$contest_id = intval($_GET['contest_id']);

try {
    // Fetch contest details
    $contestQuery = "SELECT * FROM contests WHERE contest_id = ? AND end_time < NOW()";
    $contestStmt = $conn->prepare($contestQuery);
    $contestStmt->bind_param("i", $contest_id);
    $contestStmt->execute();
    $contestResult = $contestStmt->get_result();
    $contestDetails = $contestResult->fetch_assoc();

    if (!$contestDetails) {
        http_response_code(404); // Not Found
        echo json_encode(["error" => "Contest not found or it is not a past contest."]);
        exit;
    }

    // Fetch participants and the number of problems they solved
    $participantsQuery = "
        SELECT 
            u.user_id,
            u.username,
            u.email,
            COUNT(ups.problem_id) AS problems_solved
        FROM users u
        LEFT JOIN user_problem_submissions ups
            ON u.user_id = ups.user_id
            AND ups.contest_id = ?
            AND ups.solved = 1
        WHERE u.user_id IN (
            SELECT DISTINCT user_id
            FROM user_problem_submissions
            WHERE contest_id = ?
        )
        GROUP BY u.user_id, u.username, u.email
        ORDER BY problems_solved DESC, u.username ASC
    ";
    $participantsStmt = $conn->prepare($participantsQuery);
    $participantsStmt->bind_param("ii", $contest_id, $contest_id);
    $participantsStmt->execute();
    $participantsResult = $participantsStmt->get_result();
    $participants = $participantsResult->fetch_all(MYSQLI_ASSOC);

    // Return the response as JSON
    $response = [
        "contest_details" => $contestDetails,
        "participants" => $participants
    ];

    header('Content-Type: application/json');
    echo json_encode($response);

} catch (Exception $e) {
    // Handle errors
    http_response_code(500); // Internal Server Error
    echo json_encode(["error" => "An error occurred while fetching data.", "details" => $e->getMessage()]);
}
?>
