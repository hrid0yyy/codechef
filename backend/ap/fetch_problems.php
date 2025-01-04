<?php
include '../dbconnection.php'; // Ensure this is correctly pointing to your DB connection file

header("Content-Type: application/json");

try {
    $query = "SELECT * FROM problem_sets";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    $problems = [];
    while ($row = $result->fetch_assoc()) {
        $problems[] = $row;
    }

    echo json_encode($problems);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Error fetching problems: " . $e->getMessage()]);
}

$stmt->close();
$conn->close();
?>
