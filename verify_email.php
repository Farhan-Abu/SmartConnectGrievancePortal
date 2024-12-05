<?php
session_start();
include './connect.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists in the database
    $query = $conn->prepare("SELECT * FROM users WHERE verification_token=?");
    $query->bind_param("s", $token);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        // Token is valid, update user status
        $user = $result->fetch_assoc();
        $updateQuery = $conn->prepare("UPDATE users SET verification_token=NULL, is_verified=1 WHERE email=?");
        $updateQuery->bind_param("s", $user['email']);

        if ($updateQuery->execute()) {
            echo "Email verified successfully!";
            // Optionally, redirect to login or homepage
            header("Location: login.php");
            exit();
        } else {
            echo "Error verifying email.";
        }
    } else {
        echo "Invalid verification token.";
    }
} else {
    echo "No token provided.";
}
