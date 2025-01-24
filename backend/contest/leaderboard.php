<?php
require_once '../dbconnection.php'; // Include your database connection file

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if contestId is provided
    if (!isset($_GET['contestId']) || empty($_GET['contestId'])) {
        echo json_encode(["error" => "Contest ID is required."]);
        exit();
    }

    $contestId = $_GET['contestId'];

    // SQL query to get leaderboard data
    $query = "
        SELECT 
            u.user_id,
            u.profilePicture,
            u.name AS user_name,
            u.email AS user_email,
            COUNT(ups.problem_id) AS problems_solved,
            SUM(ups.solved) AS total_solved_points
        FROM 
            users u
        INNER JOIN 
            user_problem_submissions ups
        ON 
            u.user_id = ups.user_id
        WHERE 
            ups.contest_id = ?
        GROUP BY 
            u.user_id
        ORDER BY 
            total_solved_points DESC, problems_solved DESC, u.name ASC;
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $contestId);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $leaderboard = [];

        while ($row = $result->fetch_assoc()) {
            $leaderboard[] = [
                "user_id" => $row['user_id'],
                "user_name" => $row['user_name'],
                "profile" => $row['profilePicture'],
                "user_email" => $row['user_email'],
                "total_attempted" => $row['problems_solved'],
                "total_solved_points" => $row['total_solved_points']
            ];
        }

        echo json_encode(["leaderboard" => $leaderboard]);
    } else {
        echo json_encode(["error" => "Failed to fetch leaderboard."]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid request method. Use GET."]);
}

$conn->close();
?>
