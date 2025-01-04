<?php
require '../dbconnection.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$difficulty = isset($_GET['difficulty']) ? $_GET['difficulty'] : 'all';
$tag = isset($_GET['tag']) ? $_GET['tag'] : 'all';

// Base Query
$query = "SELECT * FROM problem_sets WHERE 1";

// Apply search filter
if (!empty($search)) {
    $query .= " AND problem_title LIKE ?";
}

// Apply difficulty filter
if ($difficulty !== 'all') {
    $query .= " AND difficulty_level = ?";
}

// Apply tag filter
if ($tag !== 'all') {
    $query .= " AND FIND_IN_SET(?, tags)";
}

// Add limit and offset
$query .= " ORDER BY created_at DESC LIMIT ? OFFSET ?";

$stmt = $conn->prepare($query);

// Binding Parameters
if (!empty($search) && $difficulty !== 'all' && $tag !== 'all') {
    $search_param = "%$search%";
    $stmt->bind_param("sssii", $search_param, $difficulty, $tag, $limit, $offset);
} elseif (!empty($search) && $difficulty !== 'all') {
    $search_param = "%$search%";
    $stmt->bind_param("ssii", $search_param, $difficulty, $limit, $offset);
} elseif (!empty($search) && $tag !== 'all') {
    $search_param = "%$search%";
    $stmt->bind_param("ssi", $search_param, $tag, $limit, $offset);
} elseif ($difficulty !== 'all' && $tag !== 'all') {
    $stmt->bind_param("ssii", $difficulty, $tag, $limit, $offset);
} elseif (!empty($search)) {
    $search_param = "%$search%";
    $stmt->bind_param("sii", $search_param, $limit, $offset);
} elseif ($difficulty !== 'all') {
    $stmt->bind_param("sii", $difficulty, $limit, $offset);
} elseif ($tag !== 'all') {
    $stmt->bind_param("sii", $tag, $limit, $offset);
} else {
    $stmt->bind_param("ii", $limit, $offset);
}

$stmt->execute();
$result = $stmt->get_result();
$problems = [];

while ($row = $result->fetch_assoc()) {
    $problems[] = $row;
}

// Get total count for pagination
$countQuery = "SELECT COUNT(*) as total FROM problem_sets WHERE 1";

// Apply same filters for count
if (!empty($search)) {
    $countQuery .= " AND problem_title LIKE ?";
}
if ($difficulty !== 'all') {
    $countQuery .= " AND difficulty_level = ?";
}
if ($tag !== 'all') {
    $countQuery .= " AND FIND_IN_SET(?, tags)";
}

$countStmt = $conn->prepare($countQuery);

// Binding Parameters for Count Query
if (!empty($search) && $difficulty !== 'all' && $tag !== 'all') {
    $countStmt->bind_param("sss", $search_param, $difficulty, $tag);
} elseif (!empty($search) && $difficulty !== 'all') {
    $countStmt->bind_param("ss", $search_param, $difficulty);
} elseif (!empty($search) && $tag !== 'all') {
    $countStmt->bind_param("ss", $search_param, $tag);
} elseif ($difficulty !== 'all' && $tag !== 'all') {
    $countStmt->bind_param("ss", $difficulty, $tag);
} elseif (!empty($search)) {
    $countStmt->bind_param("s", $search_param);
} elseif ($difficulty !== 'all') {
    $countStmt->bind_param("s", $difficulty);
} elseif ($tag !== 'all') {
    $countStmt->bind_param("s", $tag);
}

$countStmt->execute();
$countResult = $countStmt->get_result();
$totalCount = $countResult->fetch_assoc()['total'];

$response = [
    "problems" => $problems,
    "total" => $totalCount,
    "limit" => $limit
];

echo json_encode($response);
?>
