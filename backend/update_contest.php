<?php
include 'dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contestId = intval($_POST['id'] ?? 0);
    $contestName = $_POST['contestName'] ?? '';
    $description = $_POST['description'] ?? '';
    $bannerUrl = $_POST['bannerUrl'] ?? '';
    $registrationStart = $_POST['registrationStart'] ?? '';
    $registrationEnd = $_POST['registrationEnd'] ?? '';
    $startTime = $_POST['startTime'] ?? '';
    $endTime = $_POST['endTime'] ?? '';
    $contestants = intval($_POST['contestantsNumber'] ?? 0);

    if (!$contestId || !$contestName || !$description) {
        echo json_encode(["success" => false, "message" => "Invalid input data."]);
        exit();
    }

    try {
        $query = "UPDATE contests 
                  SET contest_name = ?, description = ?, banner = ?, 
                      registration_start_time = ?, registration_end_time = ?, 
                      start_time = ?, end_time = ?, contestants = ? 
                  WHERE contest_id = ?";
        $stmt = $conn->prepare($query);

        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param(
            "ssssssssi",
            $contestName,
            $description,
            $bannerUrl,
            $registrationStart,
            $registrationEnd,
            $startTime,
            $endTime,
            $contestants,
            $contestId
        );

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Contest updated successfully."]);
        } else {
            throw new Exception("Execution failed: " . $stmt->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}

$conn->close();
?>
