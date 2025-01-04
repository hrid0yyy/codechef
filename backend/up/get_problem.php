<?php
session_start();
require_once '../dbconnection.php'; // Ensure correct DB connection

header("Content-Type: application/json");

// Check if problem_id is provided in the request
if (!isset($_GET['problem_id'])) {
    echo json_encode(["status" => "error", "message" => "Problem ID is required"]);
    exit();
}

$problem_id = intval($_GET['problem_id']);

// Fetch problem details from the database
$query = "SELECT * FROM problem_sets WHERE problem_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $problem_id);
$stmt->execute();
$result = $stmt->get_result();
$problem = $result->fetch_assoc();
$stmt->close();

if (!$problem) {
    echo json_encode(["status" => "error", "message" => "Problem not found"]);
    exit();
}

// Fetch sample input/output for the problem
$query_samples = "SELECT sample_input, sample_output FROM problem_samples WHERE problem_id = ?";
$stmt_samples = $conn->prepare($query_samples);
$stmt_samples->bind_param("i", $problem_id);
$stmt_samples->execute();
$result_samples = $stmt_samples->get_result();
$samples = $result_samples->fetch_all(MYSQLI_ASSOC);
$stmt_samples->close();

// Get total number of users who solved this problem
$query_solved = "SELECT COUNT(DISTINCT user_id) AS total_solved FROM user_problem_status WHERE problem_id = ?";
$stmt_solved = $conn->prepare($query_solved);
$stmt_solved->bind_param("i", $problem_id);
$stmt_solved->execute();
$result_solved = $stmt_solved->get_result();
$total_solved = $result_solved->fetch_assoc()['total_solved'] ?? 0;
$stmt_solved->close();

// Send response as JSON
echo json_encode([
    "status" => "success",
    "problem" => $problem,
    "samples" => $samples,
    "total_solved" => $total_solved
]);
exit();
?>
