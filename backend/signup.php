<?php
session_start();
include 'dbconnection.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user inputs
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $user_type = $conn->real_escape_string($_POST['user_type']);

    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkEmailQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists, show an alert and redirect back to signup
        echo "<script>
                alert('An account with this email already exists!');
                window.location.href = '../signup.php';
              </script>";
        exit();
    } else {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert the new user into the database
        $insertQuery = "INSERT INTO users (username, email, password, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sss", $username, $email, $hashedPassword);

        if ($stmt->execute()) {
            // Signup successful, redirect to the dashboard
            $_SESSION['user'] = $email; // Store user info in session
            header("Location: ../profile-setup.php");
            exit();
        } else {
            // Error occurred during insertion
            echo "<script>
                    alert('An error occurred. Please try again.');
                    window.location.href = '../signup.php';
                  </script>";
            exit();
        }
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Invalid request method
    header("Location: ../signup.php");
    exit();
}
?>
