<?php
require 'dbconnection.php'; // Adjust the path if needed

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Fetch user details from the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
        $userId = $userData['user_id']; // Get user_id
        $totalSolved = $userData['total_problems_solved']; // User's total problems solved

        // Fetch problems the user has solved
        $stmtProblems = $conn->prepare("
            SELECT ps.problem_id, ps.problem_title 
            FROM user_problem_status ups
            JOIN problem_sets ps ON ups.problem_id = ps.problem_id
            WHERE ups.user_id = ? 
        ");
        $stmtProblems->bind_param("i", $userId);
        $stmtProblems->execute();
        $resultProblems = $stmtProblems->get_result();

        $solvedProblems = [];
        while ($row = $resultProblems->fetch_assoc()) {
            $solvedProblems[] = $row;
        }
        $stmtProblems->close();

        // Fetch leaderboard position based on total problems solved
        $stmtLeaderboard = $conn->prepare("
            SELECT COUNT(*) + 1 AS rank_position 
            FROM users 
            WHERE total_problems_solved > ?
        ");
        $stmtLeaderboard->bind_param("i", $totalSolved);
        $stmtLeaderboard->execute();
        $resultLeaderboard = $stmtLeaderboard->get_result();
        $leaderboardPosition = ($resultLeaderboard->num_rows > 0) ? $resultLeaderboard->fetch_assoc()['rank_position'] : "N/A";
        $stmtLeaderboard->close();

        // Append solved problems and leaderboard position to user data
        $userData['solved_problems'] = $solvedProblems;
        $userData['leaderboard_position'] = $leaderboardPosition;

        echo json_encode(["status" => "success", "data" => $userData]);
    } else {
        echo json_encode(["status" => "error", "message" => "User not found"]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}

$conn->close();
?>
