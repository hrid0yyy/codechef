<?php
include 'dbconnection.php'; // Include your database connection file

// Pagination variables
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5; // Number of contests per page
$offset = ($page - 1) * $limit;

// Fetch unpublished contests
$query = "SELECT * FROM contests WHERE published = 0 LIMIT ? OFFSET ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

$contests = [];
while ($row = $result->fetch_assoc()) {
    $contests[] = $row;
}

// Get total number of unpublished contests for pagination
$totalQuery = "SELECT COUNT(*) AS total FROM contests WHERE published = 0";
$totalResult = $conn->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$totalContests = $totalRow['total'];

$response = [
    "contests" => $contests,
    "totalPages" => ceil($totalContests / $limit),
    "currentPage" => $page
];

echo json_encode($response);

$conn->close();
?>
