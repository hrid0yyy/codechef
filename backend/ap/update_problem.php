<?php
include '../dbconnection.php';

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($data['problemId'])) {
    $problemId = intval($data['problemId']);
    $problemTitle = $data['problemTitle'];
    $description = $data['description'];
    $difficulty = $data['difficulty'];
    $tags = $data['tags'];
    $inputFormat = $data['inputFormat'];
    $outputFormat = $data['outputFormat'];

    $query = "UPDATE problem_sets 
              SET problem_title = ?, description = ?, difficulty_level = ?, tags = ?, input_format = ?, output_format = ? 
              WHERE problem_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssi", $problemTitle, $description, $difficulty, $tags, $inputFormat, $outputFormat, $problemId);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Problem updated successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update problem."]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request."]);
}

$conn->close();
?>
