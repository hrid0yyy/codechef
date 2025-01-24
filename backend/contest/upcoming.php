<?php
// Include the database connection file
include '../dbconnection.php'; // Ensure the correct path to your DB connection file

try {
    // Query to fetch upcoming contests
    $query = "SELECT * FROM contests WHERE published = 1 AND registration_end_time > NOW() ORDER BY registration_end_time ASC";

    // Prepare the statement
    $stmt = $conn->prepare($query);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch all rows into an associative array
    $contests = [];
    while ($row = $result->fetch_assoc()) {
        $contests[] = $row;
    }

    // Output the contests as JSON
    echo json_encode($contests);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>
