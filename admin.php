<?php
require_once('config/db.php');

// Fetch grievances in reverse order (most recent first)
$query = "SELECT * FROM grievances ORDER BY id DESC"; // Fetch all fields including role_type
$result = mysqli_query($con, $query);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
  $grievance_id = $_POST['grievance_id'];
  $status = $_POST['status'];
  $feedback = isset($_POST['feedback']) ? $_POST['feedback'] : ''; // Handle empty feedback

  $update_query = "UPDATE grievances SET status = '$status', feedback = '$feedback' WHERE id = $grievance_id";
  if (mysqli_query($con, $update_query)) {
    // Redirect to the same page to refresh the data
    header("Location: admin.php"); // Change this to the correct path if needed
    exit(); // Ensure no further code is executed after the redirect
  } else {
    echo "Error updating record: " . mysqli_error($con);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Grievance Admin Portal</title>
  <link rel="icon" href="https://kiit.ac.in/wp-content/uploads/2022/10/KIIT-logo-HD.png" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="stylesheet" href="css/admin.css" />
</head>

<body>
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-logo" href="./adminhome.php">
        <img src="images/KIIT-University-Logo-.webp" style="margin-top: 10px" width="400" alt="KIIT University" />
      </a>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="./adminhome.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./admin.php">Admin</a>
        </li>
        <li class="nav-item">
          <a href="./logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>

  <div class="grievance-container">
    <h1 style="text-align: center;">Admin Grievance Dashboard</h1>
    <table border="1">
      <thead>
        <tr>
          <th>ID</th>
          <th>Full Name</th>
          <th>University ID</th>
          <th>Email</th>
          <th>Role Type</th>
          <th>Grievance Type</th>
          <th>Details</th>
          <th>Submission Time</th>
          <th>Status</th>
          <th>Feedback</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['rollno']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['role_type']); ?></td>
            <td><?php echo htmlspecialchars($row['grievance_type']); ?></td>
            <td><?php echo htmlspecialchars($row['details']); ?></td>
            <td><?php echo $row['submission_time']; ?></td>
            <td>
              <form method="POST">
                <input type="hidden" name="grievance_id" value="<?php echo $row['id']; ?>">
                <select name="status">
                  <option value="Pending" <?php echo $row['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                  <option value="In Progress" <?php echo $row['status'] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                  <option value="Solved" <?php echo $row['status'] == 'Solved' ? 'selected' : ''; ?>>Solved</option>
                </select>
            </td>
            <td>
              <input type="text" name="feedback" placeholder="Add a message" value="<?php echo htmlspecialchars($row['feedback']); ?>">
              <button type="submit" name="update_status">Update</button>
              </form>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>