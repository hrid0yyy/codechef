<?php
include 'dbconnection.php';

if (isset($_GET['id'])) {
    $contestId = intval($_GET['id']);

    $query = "SELECT * FROM contests WHERE contest_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $contestId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["error" => "Contest not found"]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid request"]);
}

$conn->close();
?>
