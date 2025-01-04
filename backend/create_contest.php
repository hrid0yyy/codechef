<?php
session_start();
include 'dbconnection.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user inputs
    $contestName = $conn->real_escape_string($_POST['contestName']);
    $description = $conn->real_escape_string($_POST['description']);
    $bannerUrl = $conn->real_escape_string($_POST['bannerUrl']);
    $contestantsNumber = (int)$_POST['contestantsNumber'];
    $registrationStart = $conn->real_escape_string($_POST['registrationStart']);
    $registrationEnd = $conn->real_escape_string($_POST['registrationEnd']);
    $startTime = $conn->real_escape_string($_POST['startTime']);
    $endTime = $conn->real_escape_string($_POST['endTime']);

    // Insert the contest into the database
    $query = "INSERT INTO contests (contest_name, description, registration_start_time, registration_end_time, start_time, end_time, contestants, published, created_at, updated_at) 
              VALUES (?, ?, ?, ?, ?, ?, ?, 0, NOW(), NOW())";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssi", $contestName, $description, $registrationStart, $registrationEnd, $startTime, $endTime, $contestantsNumber);

    if ($stmt->execute()) {
        // Contest created successfully
        echo "<script>
                alert('Contest created successfully!');
                window.location.href = '../admin-contest.php';
              </script>";
    } else {
        // Error occurred
        echo "<script>
                alert('Error: Unable to create contest. Please try again.');
                window.location.href = '../admin-contest.php';
              </script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../admin-contest.php");
    exit();
}
?>
