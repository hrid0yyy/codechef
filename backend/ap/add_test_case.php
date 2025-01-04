<?php
include '../dbconnection.php';

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($data['problemId'])) {
    $problemId = intval($data['problemId']);
    $sampleInput = $data['sampleInput'];
    $sampleOutput = $data['sampleOutput'];

    $query = "INSERT INTO problem_samples (problem_id, sample_input, sample_output) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iss", $problemId, $sampleInput, $sampleOutput);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Test case added successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to add test case."]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request."]);
}

$conn->close();
?>
