
<?php
include 'dbconnection.php';

if (isset($_GET['id'])) {
    $contestId = intval($_GET['id']);

    $query = "UPDATE contests SET published = 1 WHERE contest_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $contestId);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Contest published successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to publish contest."]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request."]);
}

$conn->close();
?>
