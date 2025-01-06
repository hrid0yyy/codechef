<?php
header('Content-Type: application/json');
include 'dbconnection.php'; // Ensure this path is correct

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['name'], $data['email'], $data['password'])) {
    echo json_encode(['error' => 'All fields are required.']);
    exit;
}

$name = trim($data['name']);
$email = trim($data['email']);
$password = password_hash($data['password'], PASSWORD_BCRYPT);

// Check if admin already exists
$stmt = $conn->prepare("SELECT verified FROM admin WHERE username = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$existingAdmin = $result->fetch_assoc();

if ($existingAdmin) {
    if ($existingAdmin['verified'] == 1) {
        echo json_encode(['error' => 'An account already exists.']);
    } else {
        echo json_encode(['error' => 'There is already a request pending.']);
    }
    exit;
}

// Insert new admin request
$stmt = $conn->prepare("INSERT INTO admin (name, username, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
    echo json_encode(['success' => 'Your request has been submitted. Please wait for approval.']);
} else {
    echo json_encode(['error' => 'Failed to submit request.']);
}

// Close connection
$stmt->close();
$conn->close();
?>
