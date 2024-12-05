<?php
session_start();
include("./connect.php");

if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Fetch user information from the database
$email = $_SESSION['email'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($query);

// Fetch the latest grievance submitted by the user
$latest_grievance_query = mysqli_query($conn, "SELECT * FROM grievances WHERE email='$email' ORDER BY submission_time DESC LIMIT 1");
$latest_grievance = mysqli_fetch_assoc($latest_grievance_query);

// Fetch grievances submitted by the user in descending order by ID
$grievance_query = mysqli_query($conn, "SELECT * FROM grievances WHERE email='$email' ORDER BY id DESC");

// Check for query errors
if (!$grievance_query) {
    die("Query failed: " . mysqli_error($conn));
}

$name = $user['name'] ?? ''; // Default to an empty string if name is not available
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KIIT Smart Grievance Portal</title>
    <link rel="icon" href="https://kiit.ac.in/wp-content/uploads/2022/10/KIIT-logo-HD.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="css/profile.css">
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
                        <div class="profile-icon" onclick="toggleDropdown()">
                            <?php echo htmlspecialchars(substr($name, 0, 1)); ?>
                        </div>
                        <div class="dropdown-content" id="dropdownContent">
                            <a href="./profile.php"><i class="fas fa-user"></i>Profile</a>
                            <a href="./logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

        <h1>Your Profile</h1>

        <!-- Profile Info Container -->
        <div class="profile-container">
            <div class="profile-info">
                <!-- <h2 style="margin-bottom: 15px;">User Information</h2> -->
                <div class="profile-row">
                    <label for="name">Name:</label>
                    <input type="text" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" disabled />
                </div>
                <div class="profile-row">
                    <label for="email">Email:</label>
                    <input type="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" disabled />
                </div>
                <div class="profile-row">
                    <label for="userPhone">Phone Number:</label>
                    <input type="tel" id="userPhone" value="<?php echo htmlspecialchars($user['mobile']); ?>" disabled />
                </div>
            </div>
        </div>

        <!-- Latest Grievance Tracker -->
        <div class="latest-grievance-tracker">
            <h2>Latest Grievance Tracking</h2>
            <?php if ($latest_grievance): ?>
                <div class="progress-tracker">
                    <h3>Status Tracking for Grievance ID: <?php echo htmlspecialchars($latest_grievance['id']); ?></h3>
                    <div class="tracker">
                        <div class="step <?php echo htmlspecialchars($latest_grievance['status']) === 'Pending' ? 'active' : ''; ?>" id="step1">
                            <div class="circle">1</div>
                            <p>Pending</p>
                        </div>
                        <div class="line"></div>
                        <div class="step <?php echo htmlspecialchars($latest_grievance['status']) === 'In Progress' || htmlspecialchars($latest_grievance['status']) === 'Solved' ? 'active' : ''; ?>" id="step2">
                            <div class="circle">2</div>
                            <p>In Progress</p>
                        </div>
                        <div class="line"></div>
                        <div class="step <?php echo htmlspecialchars($latest_grievance['status']) === 'Solved' ? 'active' : ''; ?>" id="step3">
                            <div class="circle">3</div>
                            <p>Solved</p>
                        </div>
                    </div>
                    <!-- Progress Bar -->
                    <div class="progress-bar">
                        <div class="progress" style="width: <?php echo htmlspecialchars($latest_grievance['status']) === 'Pending' ? '35%' : (htmlspecialchars($latest_grievance['status']) === 'In Progress' ? '75%' : '100%'); ?>;"></div>
                    </div>
                </div>
            <?php else: ?>
                <p>No grievances submitted yet.</p>
            <?php endif; ?>
        </div>

        <!-- Grievance List Container -->
        <div class="grievance-list">
            <h2>Your Submitted Grievances</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Grievance Type</th>
                        <th>Details</th>
                        <th>Status</th>
                        <th>Feedback</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($grievance = mysqli_fetch_assoc($grievance_query)) {
                        $current_status = htmlspecialchars($grievance['status']);
                        $grievance_id = htmlspecialchars($grievance['id']); // Store the grievance ID
                    ?>
                        <tr onclick="toggleTracker('<?php echo $grievance_id; ?>')"> <!-- Add onclick event -->
                            <td><?php echo $grievance_id; ?></td>
                            <td><?php echo htmlspecialchars($grievance['grievance_type']); ?></td>
                            <td><?php echo htmlspecialchars($grievance['details']); ?></td>
                            <td><?php echo htmlspecialchars($grievance['status']); ?></td>
                            <td><?php echo htmlspecialchars($grievance['feedback']); ?></td>
                        </tr>
                        <tr id="tracker-<?php echo $grievance_id; ?>" style="display:none;"> <!-- Tracker row hidden by default -->
                            <td colspan="5">
                                <div class="progress-tracker ">
                                    <h3>Status Tracking for Grievance ID: <?php echo $grievance_id; ?></h3>
                                    <div class="tracker">
                                        <div class="step <?php echo $current_status === 'Pending' ? 'active' : ''; ?>" id="step1">
                                            <div class="circle">1</div>
                                            <p>Pending</p>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step <?php echo $current_status === 'In Progress' || $current_status === 'Solved' ? 'active' : ''; ?>" id="step2">
                                            <div class="circle">2</div>
                                            <p>In Progress</p>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step <?php echo $current_status === 'Solved' ? 'active' : ''; ?>" id="step3">
                                            <div class="circle">3</div>
                                            <p>Solved</p>
                                        </div>
                                    </div>
                                    <!-- Progress Bar -->
                                    <div class="progress-bar">
                                        <div class="progress" style="width: <?php echo $current_status === 'Pending' ? '35%' : ($current_status === 'In Progress' ? '75%' : '100%'); ?>;"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="profile.js"></script>
</body>

</html>