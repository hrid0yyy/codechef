<?php
include 'dbconnection.php'; // Include your database connection

header('Content-Type: application/json'); // Set content type to JSON

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $contestId = intval($_GET['contestId'] ?? 0);

    if (!$contestId) {
        echo json_encode(['success' => false, 'message' => 'Invalid contest ID.']);
        exit();
    }

    try {
        $query = "SELECT problem_id, problem_title, difficulty_level, tags 
                  FROM contest_problem_sets 
                  WHERE contest_id = ?";
        $stmt = $conn->prepare($query);

        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        $stmt->bind_param("i", $contestId);

        if (!$stmt->execute()) {
            throw new Exception("Failed to execute statement: " . $stmt->error);
        }

        $result = $stmt->get_result();
        $problems = $result->fetch_all(MYSQLI_ASSOC);

        echo json_encode($problems); // Return JSON data
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    } finally {
        $stmt->close();
        $conn->close();
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
