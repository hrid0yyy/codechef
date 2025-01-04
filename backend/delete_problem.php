<?php
include 'dbconnection.php';

header("Content-Type: application/json");

// Read the incoming JSON data
$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input['problemId']) || empty($input['problemId'])) {
    echo json_encode(["success" => false, "message" => "Invalid problem ID."]);
    exit();
}

$problemId = intval($input['problemId']);

try {
    // Start transaction to ensure both deletions succeed or fail together
    $conn->begin_transaction();

    // Delete test cases associated with this problem
    $deleteTestCasesQuery = "DELETE FROM contest_problem_samples WHERE problem_id = ?";
    $stmt1 = $conn->prepare($deleteTestCasesQuery);
    $stmt1->bind_param("i", $problemId);
    $stmt1->execute();
    $stmt1->close();

    // Delete the problem from contest_problem_sets
    $deleteProblemQuery = "DELETE FROM contest_problem_sets WHERE problem_id = ?";
    $stmt2 = $conn->prepare($deleteProblemQuery);
    $stmt2->bind_param("i", $problemId);
    $stmt2->execute();
    $stmt2->close();

    // Commit transaction if both deletions were successful
    $conn->commit();

    echo json_encode(["success" => true, "message" => "Problem and associated test cases deleted successfully."]);
} catch (Exception $e) {
    $conn->rollback(); // Rollback in case of error
    echo json_encode(["success" => false, "message" => "Error deleting problem: " . $e->getMessage()]);
} finally {
    $conn->close();
}
?>
