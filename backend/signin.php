<?php
session_start();
include 'dbconnection.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user inputs
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // First, check if the credentials match a Super Admin
    $superAdminQuery = "SELECT * FROM super_admins WHERE email = ?";
    $stmt = $conn->prepare($superAdminQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $superAdminResult = $stmt->get_result();

    if ($superAdminResult->num_rows > 0) {
        $superAdmin = $superAdminResult->fetch_assoc();

        // Verify the password
        if (password_verify($password, $superAdmin['password_hash'])) {
            // Super Admin credentials match
            $_SESSION['user'] = $superAdmin['email'];
            $_SESSION['role'] = 'super_admin';
            header("Location: ../super-admin-dashboard.php");
            exit();
        }
    }

    // If not Super Admin, check if the credentials match an Admin
    $adminQuery = "SELECT * FROM admin WHERE username = ? and verified = 1";
    $stmt = $conn->prepare($adminQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $adminResult = $stmt->get_result();

    if ($adminResult->num_rows > 0) {
        $admin = $adminResult->fetch_assoc();

        // Check password (ensure admin passwords are hashed)
        if (password_verify($password, $admin['password'])) {
            // Admin credentials match
            $_SESSION['user'] = $email;
            $_SESSION['role'] = 'admin';
            header("Location: ../admin-dashboard.php");
            exit();
        }
    }

    // If not Super Admin or Admin, check if the user exists in the users table
    $userQuery = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($userQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $userResult = $stmt->get_result();

    if ($userResult->num_rows > 0) {
        $user = $userResult->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Valid user credentials
            $_SESSION['user'] = $user['email'];
            $_SESSION['role'] = 'user';
            header("Location: ../dashboard.php");
            exit();
        } else {
            // Incorrect password
            echo "<script>
                    alert('Incorrect password. Please try again.');
                    window.location.href = '../login.php';
                  </script>";
            exit();
        }
    } else {
        // User does not exist
        echo "<script>
                alert('No account found with this email.');
                window.location.href = '../login.php';
              </script>";
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Invalid request method
    header("Location: ../login.php");
    exit();
}
?>
