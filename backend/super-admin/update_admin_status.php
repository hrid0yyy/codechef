<?php
include '../dbconnection.php';
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['username'], $data['action'])) {
    $username = trim($data['username']);
    
    if ($data['action'] === "approve") {
        // Approve the request by setting verified to 1
        $stmt = $conn->prepare("UPDATE admin SET verified = 1 WHERE username = ?");
        $stmt->bind_param("s", $username);
    } else {
        // Decline the request by deleting the row
        $stmt = $conn->prepare("DELETE FROM admin WHERE username = ?");
        $stmt->bind_param("s", $username);
    }

    if ($stmt->execute()) {
        echo json_encode(["message" => "Request updated successfully!"]);
    } else {
        echo json_encode(["error" => "Failed to update request."]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["error" => "Invalid request."]);
}
?>
