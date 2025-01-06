<?php
include 'dbconnection.php';

// Set pagination
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get search query
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$whereClause = "";
$params = [];

// Apply search filter
if (!empty($search)) {
    $whereClause = "WHERE name LIKE ? OR username LIKE ?";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

// Fetch leaderboard data
$query = "SELECT user_id,email, username, name, profilePicture, total_problems_solved 
          FROM users $whereClause 
          ORDER BY total_problems_solved DESC 
          LIMIT ? OFFSET ?";
$params[] = $limit;
$params[] = $offset;

$stmt = $conn->prepare($query);
$stmt->bind_param(str_repeat("s", count($params) - 2) . "ii", ...$params);
$stmt->execute();
$result = $stmt->get_result();

// Count total rows for pagination
$totalQuery = "SELECT COUNT(*) as total FROM users $whereClause";
$totalStmt = $conn->prepare($totalQuery);
if (!empty($search)) {
    $totalStmt->bind_param("ss", $params[0], $params[1]);
}
$totalStmt->execute();
$totalResult = $totalStmt->get_result();
$totalRows = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

// Return data as JSON
$response = [
    "data" => $result->fetch_all(MYSQLI_ASSOC),
    "totalPages" => $totalPages
];
echo json_encode($response);

$conn->close();
?>
