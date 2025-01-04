<?php
include 'dbconnection.php';

if (isset($_GET['id'])) {
    $contestId = intval($_GET['id']);

    // Start transaction to ensure atomicity
    $conn->begin_transaction();

    try {
        // Delete test cases associated with problems in this contest
        $query1 = "DELETE FROM contest_problem_samples WHERE contest_id = ?";
        $stmt1 = $conn->prepare($query1);
        $stmt1->bind_param("i", $contestId);
        $stmt1->execute();
        $stmt1->close();

        // Delete problems associated with this contest
        $query2 = "DELETE FROM contest_problem_sets WHERE contest_id = ?";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("i", $contestId);
        $stmt2->execute();
        $stmt2->close();

        // Delete the contest itself
        $query3 = "DELETE FROM contests WHERE contest_id = ?";
        $stmt3 = $conn->prepare($query3);
        $stmt3->bind_param("i", $contestId);
        $stmt3->execute();
        $stmt3->close();

        // Commit transaction
        $conn->commit();

        echo json_encode(["success" => true, "message" => "Contest and associated data deleted successfully."]);
    } catch (Exception $e) {
        // Rollback in case of failure
        $conn->rollback();
        echo json_encode(["success" => false, "message" => "Error deleting contest: " . $e->getMessage()]);
    }

} else {
    echo json_encode(["success" => false, "message" => "Invalid request."]);
}

$conn->close();
?>
