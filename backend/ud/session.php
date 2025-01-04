<?php
session_start();
require_once __DIR__ . "/../dbconnection.php"; 

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Fetch user data only if not already stored in session
if (!isset($_SESSION['user_data'])) {
    $user_email = $_SESSION['user']; // Get email from session

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    // Store all user data in the session
    $_SESSION['user_data'] = $user;
    $_SESSION['user_id'] = $user['user_id']; // for chat
}

// Access user data from session
$userData = $_SESSION['user_data'];

// Profile Picture (default if not set)
$userProfilePicture = !empty($userData['profilePicture']) ? $userData['profilePicture'] : "assets/img/default-avatar.png";
?>

<script>
  const userId = <?php echo json_encode($userData['user_id']); ?>;
</script>
