<?php
require '../dbconnection.php'; // Include your database connection file

// Check if contest_id is provided
if (!isset($_GET['contest_id']) || empty($_GET['contest_id'])) {
    http_response_code(400); // Bad request
    echo json_encode(["error" => "Contest ID is required."]);
    exit;
}

$contest_id = intval($_GET['contest_id']); // Sanitize the input

try {
    // Query to fetch problem sets for the given contest_id
    $query = "SELECT * FROM contest_problem_sets WHERE contest_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $contest_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch all rows
    $problem_sets = $result->fetch_all(MYSQLI_ASSOC);

    // Return data as JSON
    header('Content-Type: application/json');
    echo json_encode($problem_sets);
} catch (Exception $e) {
    // Handle errors
    http_response_code(500); // Internal server error
    echo json_encode(["error" => "An error occurred while fetching the problem sets.", "details" => $e->getMessage()]);
}
?>
