<?php
session_start();
include("./connect.php"); // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Get the user's name and email from the session
$name = $_SESSION['name']; // Assuming you stored the name in the session during login
$email = $_SESSION['email']; // Email stored in session

// Create database connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize the form data
    $rollno = htmlspecialchars(trim($_POST['rollno'])); // Optional
    $grievance_type = htmlspecialchars(trim($_POST['grievance_type']));
    $details = htmlspecialchars(trim($_POST['details']));
    $role_type = htmlspecialchars(trim($_POST['role_type'])); // Get the role type from the form

    // Prepare and bind (including submission_time)
    $stmt = $conn->prepare("INSERT INTO grievances (name, rollno, email, grievance_type, details, submission_time) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssss", $name, $rollno, $email, $grievance_type, $details);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to profile page instead of grievance page
        header("Location: profile.php");
        exit(); // Ensure no further code is executed
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
