<?php
require '../dbconnection.php';

// Get current time
$current_time = date('Y-m-d H:i:s');

// Get optional search query
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Prepare SQL query to fetch ongoing contests
$query = "SELECT * FROM contests WHERE start_time <= ? AND end_time >= ?";
$params = [$current_time, $current_time];

if (!empty($search)) {
    $query .= " AND contest_name LIKE ?";
    $params[] = "%$search%";
}

$query .= " ORDER BY start_time ASC";

$stmt = $conn->prepare($query);

// Dynamically bind parameters
if (!empty($search)) {
    $stmt->bind_param("sss", $params[0], $params[1], $params[2]);
} else {
    $stmt->bind_param("ss", $params[0], $params[1]);
}

$stmt->execute();
$result = $stmt->get_result();

// Fetch the results into an associative array
$contests = [];
while ($row = $result->fetch_assoc()) {
    $contests[] = $row;
}

// Return contests as JSON
header('Content-Type: application/json');
echo json_encode($contests);
?>
