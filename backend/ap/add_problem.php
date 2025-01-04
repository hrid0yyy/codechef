<?php
include '../dbconnection.php'; // Adjust path if necessary

header("Content-Type: application/json"); // Ensure JSON response

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
    exit();
}

// Retrieve form data
$problemTitle = trim($_POST["problemTitle"] ?? "");
$description = trim($_POST["description"] ?? "");
$difficulty = trim($_POST["difficulty"] ?? "");
$tags = trim($_POST["tags"] ?? "");
$inputFormat = trim($_POST["inputFormat"] ?? "");
$outputFormat = trim($_POST["outputFormat"] ?? "");

if (!$problemTitle || !$description || !$difficulty || !$tags || !$inputFormat || !$outputFormat) {
    echo json_encode(["success" => false, "message" => "All fields are required."]);
    exit();
}

try {
    // Insert into database
    $query = "INSERT INTO problem_sets (problem_title, description, difficulty_level, tags, input_format, output_format) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $problemTitle, $description, $difficulty, $tags, $inputFormat, $outputFormat);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Problem added successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Database error: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Exception: " . $e->getMessage()]);
}
?>
