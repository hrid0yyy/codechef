<?php
session_start();
require '../dbconnection.php'; // Database connection file

// Enable Error Reporting for Debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json'); // Ensures JSON output

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in."]);
    exit;
}

$user_email = $_SESSION['user']; // Ensure session holds the correct email
$response = ["status" => "error", "message" => "Unknown error"];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $full_name = htmlspecialchars(trim($_POST['full_name'] ?? ''));
    $dob = $_POST['date_of_birth'] ?? null;
    $skills = htmlspecialchars(trim($_POST['skills'] ?? ''));
    $bio = htmlspecialchars(trim($_POST['bio'] ?? ''));
    $linkedin = htmlspecialchars(trim($_POST['linkedin'] ?? ''));
    $github = htmlspecialchars(trim($_POST['github'] ?? ''));
    $portfolio = htmlspecialchars(trim($_POST['portfolio'] ?? ''));

    // Validate required fields
    if (empty($full_name) || empty($dob)) {
        echo json_encode(["status" => "error", "message" => "Full Name and Date of Birth are required."]);
        exit;
    }

    // Profile Picture Handling
    $profile_pic = null;
    if (!empty($_FILES['profile_pic']['name'])) {
        $target_dir = "../../uploads/"; // Ensure correct path
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // Create directory if not exists
        }

        $file_name = time() . "_" . basename($_FILES["profile_pic"]["name"]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
            $profile_pic = "uploads/" . $file_name; // Store relative path
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to upload image."]);
            exit;
        }
    }

    // Update user data in the database
    $query = "UPDATE users SET name=?, date_of_birth=?, skills=?, bio=?, linkedinUrl=?, githubUrl=?, portfolioUrl=?, profilePicture=? WHERE email=?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("sssssssss", $full_name, $dob, $skills, $bio, $linkedin, $github, $portfolio, $profile_pic, $user_email);
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Profile updated successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Database update failed."]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "SQL preparation failed."]);
    }
}

exit;
?>
