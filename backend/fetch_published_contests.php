<?php
include 'dbconnection.php'; // Database connection

$itemsPerPage = 5; // Number of contests per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $itemsPerPage;
$search = isset($_GET['search']) ? "%" . $_GET['search'] . "%" : "%%";
$status = $_GET['status'] ?? 'all';

$currentDateTime = date('Y-m-d H:i:s');

try {
    // Count total number of contests based on filters
    $countQuery = "SELECT COUNT(*) as total FROM contests WHERE published = 1 AND contest_name LIKE ?";
    $countStmt = $conn->prepare($countQuery);

    if ($status === "upcoming") {
        $countQuery .= " AND start_time > ?";
        $countStmt = $conn->prepare($countQuery);
        $countStmt->bind_param("ss", $search, $currentDateTime);
    } elseif ($status === "ongoing") {
        $countQuery .= " AND start_time <= ? AND end_time >= ?";
        $countStmt = $conn->prepare($countQuery);
        $countStmt->bind_param("sss", $search, $currentDateTime, $currentDateTime);
    } elseif ($status === "previous") {
        $countQuery .= " AND end_time < ?";
        $countStmt = $conn->prepare($countQuery);
        $countStmt->bind_param("ss", $search, $currentDateTime);
    } else {
        $countStmt->bind_param("s", $search);
    }

    $countStmt->execute();
    $totalCount = $countStmt->get_result()->fetch_assoc()['total'];
    $totalPages = ceil($totalCount / $itemsPerPage);
    $countStmt->close();

    // Fetch filtered contests with pagination
    $query = "SELECT contest_id, contest_name, description, banner, start_time, end_time 
              FROM contests WHERE published = 1 AND contest_name LIKE ?";

    if ($status === "upcoming") {
        $query .= " AND start_time > ?";
        $stmt = $conn->prepare($query . " ORDER BY start_time ASC LIMIT ?, ?");
        $stmt->bind_param("ssii", $search, $currentDateTime, $offset, $itemsPerPage);
    } elseif ($status === "ongoing") {
        $query .= " AND start_time <= ? AND end_time >= ?";
        $stmt = $conn->prepare($query . " ORDER BY start_time ASC LIMIT ?, ?");
        $stmt->bind_param("sssii", $search, $currentDateTime, $currentDateTime, $offset, $itemsPerPage);
    } elseif ($status === "previous") {
        $query .= " AND end_time < ?";
        $stmt = $conn->prepare($query . " ORDER BY start_time DESC LIMIT ?, ?");
        $stmt->bind_param("ssii", $search, $currentDateTime, $offset, $itemsPerPage);
    } else {
        $stmt = $conn->prepare($query . " ORDER BY start_time DESC LIMIT ?, ?");
        $stmt->bind_param("sii", $search, $offset, $itemsPerPage);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $contests = [];
    while ($row = $result->fetch_assoc()) {
        $contests[] = $row;
    }

    echo json_encode([
        "contests" => $contests,
        "totalPages" => $totalPages,
        "currentPage" => $page
    ]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Error fetching contests: " . $e->getMessage()]);
} finally {
    $stmt->close();
    $conn->close();
}
?>
