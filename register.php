<?php
session_start(); // Start the session at the beginning
include './connect.php';

if (isset($_POST['signUp'])) {
    // Get form data
    $name = trim($_POST['name']);
    $mobile = trim($_POST['mobile']);
    $email = trim($_POST['email']);
    $password = $_POST['password']; // Get the plain password

    // Validate mobile number length and format
    if (strlen($mobile) > 15) {
        echo "Mobile number is too long!";
        exit();
    }
    if (!preg_match('/^[0-9]{10,15}$/', $mobile)) { // Example regex for mobile number
        echo "Invalid mobile number format!";
        exit();
    }

    // Check if the email already exists
    $checkEmail = $conn->prepare("SELECT * FROM users WHERE email=?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if ($result->num_rows > 0) {
        echo "Email Address Already Exists!";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // Generate a verification token
        $token = bin2hex(random_bytes(16)); // Generate a random token

        // Insert new user into the database
        $insertQuery = $conn->prepare("INSERT INTO users (name, mobile, email, password, verification_token) VALUES (?, ?, ?, ?, ?)");
        $insertQuery->bind_param("sssss", $name, $mobile, $email, $hashedPassword, $token);

        if ($insertQuery->execute()) {
            // Include the verification email sending script
            include 'send_verification_email.php'; // Make sure this file is in the same directory

            // Send verification email
            if (sendVerificationEmail($email, $token)) {
                echo "Registration successful! Please check your email ($email) to verify your account.";
            } else {
                echo "Registration successful, but failed to send verification email.";
            }
            header("Location: login.php"); // Redirect to login page after registration
            exit();
        } else {
            echo "Error: " . $insertQuery->error; // Display any SQL error
        }
    }
}

if (isset($_POST['signIn'])) {
    // Get login data
    $email = trim($_POST['email']);
    $password = $_POST['password']; // Get the plain password

    // Check for valid credentials
    $sql = $conn->prepare("SELECT * FROM users WHERE email=?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['name'] = $row['name']; // Store full name in session
            $_SESSION['usertype'] = $row['usertype']; // Store user type in session

            // Redirect based on user type
            if ($row['usertype'] === 'admin') {
                header("Location: adminhome.php");
            } else {
                header("Location: homepage.php");
            }
            exit();
        } else {
            echo "Not Found, Incorrect Email or Password";
        }
    } else {
        echo "Not Found, Incorrect Email or Password";
    }
}
