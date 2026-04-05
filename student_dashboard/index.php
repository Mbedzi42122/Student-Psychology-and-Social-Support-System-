<?php
session_start();

// If not logged in → redirect to home
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Home/index.php");
    exit();
}

// If not a student → block access
if ($_SESSION['role'] != 'student') {
    echo "Access denied!";
    exit();
}

// Get user info
$user_name = $_SESSION['name'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Dashboard</title>

  <!-- FONT AWESOME ICONS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link rel="stylesheet" href="style.css" />
</head>
<body>

<div class="dashboard">

  <!-- SIDEBAR -->
  <aside class="sidebar">

    <div class="logo">
      <img src="img/UL_logo.png" alt="Logo">
    </div>

    <ul class="menu">

        <li class="menu-item active" data-page="updates">
          <i class="fas fa-bullhorn"></i>
          <span>Updates</span>
        </li>
      
        <li class="menu-item" data-page="chat">
          <i class="fas fa-robot"></i>
          <span>AI Chat</span>
        </li>
      
        <li class="menu-item" data-page="counselling">
          <i class="fas fa-user-md"></i>
          <span>Request Counselling</span>
        </li>
      
        <li class="menu-item" data-page="forum">
          <i class="fas fa-comments"></i>
          <span>Peer Forum</span>
        </li>
      
        <li class="menu-item" data-page="resources">
          <i class="fas fa-book"></i>
          <span>Resources</span>
        </li>
      
      </ul>
      
      <div class="bottom-menu">
      
        <div class="menu-item" data-page="settings">
          <i class="fas fa-cog"></i>
          <span>Settings</span>
        </div>
      
        <div class="menu-item logout" onclick="window.location.href='logout.php'">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span>
        </div>
      
      </div>

  </aside>

  <!-- RIGHT CONTENT -->
  <main class="content">

    <div class="top-bar">
        <div class="user-info">
          <i class="fas fa-user-circle"></i>
          <span>Hi, <?php echo htmlspecialchars($user_name); ?></span>
        </div>
      </div>

    <div id="content-area">
      <h1>Welcome Student</h1>
      <p>This is your dashboard. Updates will appear here.</p>
    </div>

  </main>

</div>
<script src="script.js"></script>
</body>
</html>