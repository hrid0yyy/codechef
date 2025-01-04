<?php
include '../dbconnection.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $problemId = intval($_GET['problemId'] ?? 0);

    if (!$problemId) {
        echo json_encode(['success' => false, 'message' => 'Invalid problem ID.']);
        exit();
    }

    try {
        $query = "SELECT sample_input, sample_output FROM problem_samples WHERE problem_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $problemId);
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
