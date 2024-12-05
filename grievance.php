<?php
session_start();
include("./connect.php");

if (!isset($_SESSION['email'])) {
  header("Location: login.php");
  exit();
}

$email = $_SESSION['email'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($query);

$name = $user['name'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KIIT Smart Grievance Portal</title>
  <link rel="stylesheet" href="css/grievance.css" />
  <link rel="icon" href="https://kiit.ac.in/wp-content/uploads/2022/10/KIIT-logo-HD.png" type="image/x-icon" />
</head>

<body>
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-logo" href="./homepage.php">
        <img src="images/KIIT-University-Logo-.webp" style="margin-top: 10px" width="400" alt="KIIT University" />
      </a>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="./homepage.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./grievance.php">Grievance</a>
        </li>
        <?php if ($name): ?>
          <li class="nav-item dropdown">
            <span class="nav-link profile-name" id="dropdownMenu" onclick="toggleDropdown()">
              <?php echo htmlspecialchars($name); ?>
            </span>
            <div class="dropdown-content" id="dropdownContent">
              <a href="./profile.php">Profile</a>
              <a href="./logout.php">Logout</a>
            </div>
          </li>
        <?php endif; ?>
      </ul>
    </div>

    <div class="form-container">
      <h2>Submit Your Grievance</h2>
      <form id="grievance-form" action="submit_grievance.php" method="POST">
        <div class="input-group">
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" disabled />
        </div>
        <div class="input-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" disabled />
        </div>
        <div class="input-group">
          <label for="rollno">University id (Optional):</label>
          <input type="text" id="rollno" name="rollno" />
        </div>
        <div class="input-row">
          <div class="input-group">
            <label for="user-type">Select your role</label>
            <select id="user-type" name="user_type" required>
              <option value="" disabled selected>Select your role</option>
              <option value="student">Student</option>
              <option value="parent">Parent</option>
              <option value="faculty">Faculty</option>
              <option value="staff">Staff</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div class="input-group">
            <label for="grievance-type">Grievance Type</label>
            <select id="grievance-type" name="grievance_type" required>
              <option value="" disabled selected>Grievance Type</option>
              <option value="academic">Academic</option>
              <option value="facility">Faculty</option>
              <option value="facility">Staff</option>
              <option value="facility">Student</option>
              <option value="facility">Hostel</option>
              <option value="transaction">Transaction Issue</option>
              <option value="ragging">Ragging</option>
              <option value="other">Other</option>
            </select>
          </div>
        </div>
        <div class="input-group">
          <label for="details">Grievance Details:</label>
          <textarea
            id="details"
            name="details"
            rows="5"
            maxlength="200"
            placeholder="Describe your issue here"
            required></textarea>
          <div id="characterCount">0/200 characters</div>
        </div>
        <button type="submit">Submit</button>
      </form>
    </div>
    <script src="./grievance.js"></script>
  </div>
</body>

</html>