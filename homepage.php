<?php
session_start();
include("./connect.php");
$name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KIIT Smart Grievance Portal</title>
  <link rel="stylesheet" href="css/index.css" />
  <link
    rel="icon"
    href="https://kiit.ac.in/wp-content/uploads/2022/10/KIIT-logo-HD.png"
    type="image/x-icon" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-logo" href="./homepage.php">
        <img
          src="images/KIIT-University-Logo-.webp"
          style="margin-top: 10px"
          width="400"
          alt="KIIT University" />
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
  </div>
  <!-- Features Section -->
  <div class="features-section">
    <h2>Features of our Grievance Portal</h2>
    <div class="feature">
      <i class="fas fa-lock"></i>
      <h3>Secure Submission</h3>
      <p>
        Our portal ensures that your grievances are submitted securely and
        confidentially.
      </p>
    </div>
    <div class="feature">
      <i class="fas fa-clock"></i>
      <h3>Real-time Tracking</h3>
      <p>
        Track the status of your grievance in real-time and stay updated on
        the progress.
      </p>
    </div>
    <div class="feature">
      <i class="fas fa-user-secret"></i>
      <h3>Confidentiality Options</h3>
      <p>
        Choose to remain anonymous or confidential when submitting your
        grievance.
      </p>
    </div>
    <div class="feature">
      <i class="fas fa-bell"></i>
      <h3>Regular Updates</h3>
      <p>
        Receive regular updates and notifications on the status of your
        grievance.
      </p>
    </div>
  </div>

  <!-- SGRC Section -->
  <div class="sgrc-section">
    <h2>Student Grievance Redressal Committee (SGRC)</h2>
    <p>
      KIIT - Deemed to be University has established a dedicated Student
      Grievance Redressal Committee (SGRC), aimed at addressing and resolving
      students’ concerns and grievances in a constructive and genuine manner.
      This committee is integral to fostering a fair, unbiased, and positive
      academic atmosphere within the university.
    </p>
    <p>
      The SGRC operates with a commitment to confidentiality, ensuring that
      all grievances are investigated thoroughly and impartially. The process
      undertaken involves a detailed analysis of the grievances’ nature and
      patterns, allowing for effective solutions that align with the
      university’s values of fairness and student welfare.
    </p>
    <p>
      Through its diligent work, the SGRC at KIIT not only resolves individual
      grievances but also contributes to the continuous improvement of the
      educational environment, making it more conducive to learning and
      personal development.
    </p>

    <h2>Members of SGRC</h2>
    <div class="members-container">
      <ul class="sgrc-members">
        <li>Prof. Samaresh Mishra, Director, Student Affairs – Member</li>
        <li>
          Dr. Sanjib Moulick, Professor, School of Civil Engineering – Member
        </li>
        <li>
          Dr. Srinivas Pattanaik, Professor, School of Biotechnology – Member
        </li>
        <li>
          Dr. Sumita Mishra, Associate Professor, School of Management –
          Member
        </li>
        <li>
          Dr. Harish Chandra Tudu, Consultant, Pediatric Surgery – Member
        </li>
        <li>Mr. Ramgopal Raula, Student Representative – Special Invitee</li>
      </ul>
    </div>
  </div>

  <!-- Testimonials Section -->
  <h2 style="text-align: center">What our Admin and User's say</h2>
  <div class="testimonials-section">
    <div class="testimonial">
      <img src="images/farhan.png" alt="User 2" class="testimonial-image" />
      <p>
        "This Grievance Portal is designed to efficiently manage
        administrative and interpersonal issues
      <p>within the educational environment,
        aiming to create a positive and productive atmosphere."
      </p>
      <span>Farhan Abu, Admin</span>
    </div>
    <br>
    <div class="testimonial">
      <img src="images/tarun.png" alt="User 1" class="testimonial-image" />
      <p>
        "The grievance portal has been a game-changer for me. I was able to
        submit my concern and get a response within a day."
      </p>
      <span>B Tarun Kumar, Student</span>
    </div>
    <div class="testimonial">
      <img src="images/afrah.png" alt="User 3" class="testimonial-image" />
      <p>
        "The grievance portal has helped me to resolve my issues quickly and
        efficiently."
      </p>
      <span>Afrah Mirza, Staff</span>
    </div>
    <div class="testimonial">
      <img src="images/Revant.jpg" alt="User 3" class="testimonial-image" />
      <p>
        "The grievance portal has helped me to resolve my issues quickly and
        efficiently."
      </p>
      <span>Vezzu Venket Revanth, Staff</span>
    </div>
  </div>
  <footer class="footer">
    <p>© Copyright – All Rights Reserved kiit.grievance.in</p>
  </footer>
  <script src="./homepage.js"></script>
</body>

</html>