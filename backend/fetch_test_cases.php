<?php
include 'dbconnection.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $problemId = intval($_GET['problemId'] ?? 0);
    $contestId = intval($_GET['contestId'] ?? 0);

    if (!$problemId || !$contestId) {
        echo json_encode(['success' => false, 'message' => 'Invalid problem or contest ID.']);
        exit();
    }

    try {
        $query = "SELECT sample_input, sample_output FROM contest_problem_samples WHERE problem_id = ? AND contest_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $problemId, $contestId);
        $stmt->execute();
        $result = $stmt->get_result();

        $testCases = [];
        while ($row = $result->fetch_assoc()) {
            $testCases[] = $row;
        }

        echo json_encode($testCases);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error fetching test cases: ' . $e->getMessage()]);
    } finally {
        $stmt->close();
        $conn->close();
    }
}
?>
