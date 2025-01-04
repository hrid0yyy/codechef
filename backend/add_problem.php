<?php
include 'dbconnection.php'; // Include database connection

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    // Collect and sanitize inputs
    $contestId = intval($_POST['contestId'] ?? 0);
    $problemTitle = trim($_POST['problemTitle'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $difficulty = trim($_POST['difficulty'] ?? '');
    $problemTags = trim($_POST['problemTags'] ?? '');
    $inputFormat = trim($_POST['inputFormat'] ?? '');
    $outputFormat = trim($_POST['outputFormat'] ?? '');

    // Check required fields
    if (!$contestId || !$problemTitle || !$description || !$difficulty) {
        throw new Exception('Missing required fields.');
    }

    // Insert data into the database
    $query = "INSERT INTO contest_problem_sets (contest_id, problem_title, description, difficulty_level, tags, input_format, output_format)
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issssss", $contestId, $problemTitle, $description, $difficulty, $problemTags, $inputFormat, $outputFormat);
    if (!$stmt->execute()) {
        throw new Exception('Database error: ' . $stmt->error);
    }

    echo json_encode(['success' => true, 'message' => 'Problem added successfully.']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
} finally {
    $stmt->close();
    $conn->close();
}
?>
