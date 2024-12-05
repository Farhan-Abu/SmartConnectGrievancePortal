<?php
session_start();
include("./connect.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & signUp</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
    <script type="text/javascript" src="./login.js" defer></script>
</head>

<body>
    <!-- Main Wrapper -->
    <div class="wrapper">
        <!-- Login Form -->
        <div class="container" id="signIn">
            <h1 class="form-title">Sign In</h1>
            <p id="error-message"></p>
            <form id="form" method="post" action="./register.php">
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email-input" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password-input" placeholder="Password" required>
                </div>
                <input type="submit" class="btn" value="Sign In" name="signIn">
            </form>
            <div class="links">
                <p>Don't have account yet?</p>
                <button id="signUpButton">Sign Up</button>
            </div>
        </div>

        <!-- Register Form -->
        <div class="container" id="signup" style="display:none;">
            <h1 class="form-title">Register</h1>
            <form method="post" action="register.php">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" id="name" placeholder="Name" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-phone"></i>
                    <input type="tel" name="mobile" id="mobile" placeholder="Mobile Number" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
                <input type="submit" class="btn" value="Sign Up" name="signUp">
            </form>
        </div>
    </div>
</body>

</html>