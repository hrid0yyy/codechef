<?php
include '../dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['problemId'])) {
    $problemId = intval($_GET['problemId']);

    $query = "SELECT * FROM problem_sets WHERE problem_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $problemId);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    echo json_encode($result);
    $stmt->close();
}

$conn->close();
?>
