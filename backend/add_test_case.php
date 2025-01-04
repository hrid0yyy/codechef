<?php
include 'dbconnection.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);

    $problemId = intval($input['problemId'] ?? 0);
    $contestId = intval($input['contestId'] ?? 0);
    $sampleInput = trim($input['sample_input'] ?? '');
    $sampleOutput = trim($input['sample_output'] ?? '');

    if (!$problemId || !$contestId || !$sampleInput || !$sampleOutput) {
        echo json_encode(['success' => false, 'message' => 'Invalid input data.']);
        exit();
    }

    try {
        $query = "INSERT INTO contest_problem_samples (problem_id, contest_id, sample_input, sample_output) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iiss", $problemId, $contestId, $sampleInput, $sampleOutput);
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Test case added successfully.']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error adding test case: ' . $e->getMessage()]);
    } finally {
        $stmt->close();
        $conn->close();
    }
}
?>
