<?php
session_start();
require '../dbconnection.php'; // Include your database connection file

// Validate required parameters
if (!isset($_GET['contest_id']) || !isset($_GET['problem_id'])) {
    http_response_code(400); // Bad Request
    echo json_encode(["error" => "Both contest_id and problem_id are required."]);
    exit;
}

// Validate if user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); // Unauthorized
    echo json_encode(["error" => "User not logged in."]);
    exit;
}

$contest_id = intval($_GET['contest_id']);
$problem_id = intval($_GET['problem_id']);
$user_id = intval($_SESSION['user_id']);

try {
    // Fetch problem details from contest_problem_sets
    $problemQuery = "SELECT * FROM contest_problem_sets WHERE contest_id = ? AND problem_id = ?";
    $problemStmt = $conn->prepare($problemQuery);
    $problemStmt->bind_param("ii", $contest_id, $problem_id);
    $problemStmt->execute();
    $problemResult = $problemStmt->get_result();
    $problemDetails = $problemResult->fetch_assoc();

    if (!$problemDetails) {
        http_response_code(404); // Not Found
        echo json_encode(["error" => "Problem not found in the specified contest."]);
        exit;
    }

    // Fetch contest details from contests
    $contestQuery = "SELECT * FROM contests WHERE contest_id = ?";
    $contestStmt = $conn->prepare($contestQuery);
    $contestStmt->bind_param("i", $contest_id);
    $contestStmt->execute();
    $contestResult = $contestStmt->get_result();
    $contestDetails = $contestResult->fetch_assoc();

    if (!$contestDetails) {
        http_response_code(404); // Not Found
        echo json_encode(["error" => "Contest not found."]);
        exit;
    }

    // Count the number of people who solved the problem
    $solvedQuery = "SELECT COUNT(*) AS solved_count FROM user_problem_submissions WHERE problem_id = ? AND contest_id = ? AND solved = 1";
    $solvedStmt = $conn->prepare($solvedQuery);
    $solvedStmt->bind_param("ii", $problem_id, $contest_id);
    $solvedStmt->execute();
    $solvedResult = $solvedStmt->get_result();
    $solvedCount = $solvedResult->fetch_assoc()['solved_count'];

    // Check if the user solved the problem and their submission count
    $userQuery = "SELECT solved, COUNT(*) AS submission_count FROM user_problem_submissions WHERE user_id = ? AND problem_id = ? AND contest_id = ? ";
    $userStmt = $conn->prepare($userQuery);
    $userStmt->bind_param("iii", $user_id, $problem_id, $contest_id);
    $userStmt->execute();
    $userResult = $userStmt->get_result();

    $userSolved = 0; // Default: not solved
    $userSubmissionCount = 0; // Default: no submissions

    if ($userRow = $userResult->fetch_assoc()) {
        $userSolved = intval($userRow['solved']);
        $userSubmissionCount = intval($userRow['submission_count']);
    }

    // Prepare the final response
    $response = [
        "problem_details" => $problemDetails,
        "contest_details" => $contestDetails,
        "solved_count" => $solvedCount,
        "user_solved" => $userSolved,
        "user_submission_count" => $userSubmissionCount
    ];

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} catch (Exception $e) {
    // Handle exceptions and return an error response
    http_response_code(500); // Internal Server Error
    echo json_encode(["error" => "An error occurred while fetching data.", "details" => $e->getMessage()]);
}
?>
