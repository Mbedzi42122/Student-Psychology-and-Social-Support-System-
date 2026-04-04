<?php
include("../API/db_connect.php"); // adjust path if needed

$error = "";
$success = "";

// REGISTER
if (isset($_POST['register'])) {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $role = $_POST["role"];

    if (empty($name) || empty($email) || empty($password)) {
        $error = "All fields are required for registration!";
    } else {
        // Check if email exists
        $check = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "Email already exists!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);

            if ($stmt->execute()) {
                $success = "Registration successful!";
            } else {
                $error = "Something went wrong!";
            }
        }
    }
}

// LOGIN
if (isset($_POST['login'])) {
    $email = trim($_POST['login_email']);
    $password = $_POST['login_password'];

    if (empty($email) || empty($password)) {
        $error = "Both email and password are required for login!";
    } else {
        $stmt = $conn->prepare("SELECT user_id, password, role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id, $hashed_password, $role_db);

        if ($stmt->num_rows > 0) {
            $stmt->fetch();
            if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION['user_id'] = $user_id;
                $_SESSION['role'] = $role_db;
                $_SESSION['email'] = $email;
                $success = "Login successful! Role: $role_db";
                // Redirect or show dashboard later
            } else {
                $error = "Incorrect password!";
            }
        } else {
            $error = "No account found with this email!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SPSS</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- HEADER -->
<header class="header">
    <div class="container nav">
      <div class="logo-left">
        <img src="img/UL_logo.png" class="logo" alt="Logo">
      </div>
  
      <nav class="nav-links">
        <a href="#" class="active">Home</a>
        <a href="#about">About</a>
        <a href="#">Resources</a>
        <a href="#" id="loginBtn">Login</a>
      </nav>
    </div>
  </header>

<!-- HERO -->
<section class="hero">
    <div class="container hero-content">
      <div class="hero-text">
        <h2>YOU ARE NOT <span>ALONE</span></h2>
        <h1>SUPPORT IS ALWAYS WITHIN REACH.</h1>
        <p>
          University life can be overwhelming, and it’s okay to feel stressed, anxious, or unsure sometimes.
          This platform provides confidential tools, guidance, and support whenever you need it.
        </p>
  
        <div class="hero-buttons">
          <a href="#" class="btn primary">Get Started</a>
          <a href="#" class="btn secondary">Talk to AI</a>
        </div>
  
        <!-- DOT INDICATORS -->
        <div class="hero-dots">
          <span class="dot active"></span>
          <span class="dot"></span>
          <span class="dot"></span>
        </div>
  
      </div>
    </div>
  </section>
  

<!-- FEATURES -->
<section class="features">
    <div class="feature-grid">
  
        <div class="feature dark">
            <div class="feature-header">
              <img src="img/Bot.png" alt="Bot">
              <h3>AI Support Chat</h3>
            </div>
            <p>Talk to an intelligent assistant anytime for guidance and support.</p>
          </div>
          
          <div class="feature brown">
            <div class="feature-header">
              <img src="img/Friends.png" alt="Friends">
              <h3>Peer Support</h3>
            </div>
            <p>Connect with other students and share experiences safely.</p>
          </div>
          
          <div class="feature light">
            <div class="feature-header">
              <img src="img/Education.png" alt="Education">
              <h3>Counselling</h3>
            </div>
            <p>Request professional counselling sessions confidentially.</p>
          </div>
  
    </div>
  </section>

<!-- ABOUT -->
<section id="about" class="about">
  <div class="container about-content">
    <img src="img/UL_logo.png" alt="logo">

    <div>
      <h2>About Us</h2>
      <p>
        The Student Psychology and Social Support System (SPSS) is a platform designed to support student
        mental health and well-being. It provides accessible tools and connects students with help.
      </p>
      <a href="#" class="read-more">Read More</a>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="container footer-content">
      <div class="footer-left">
        <h3>Student Psychology and Social Support System</h3>
        <div class="social-icons">
          <a href="#"><img src="img/facebook.png" alt="Facebook"></a>
          <a href="#"><img src="img/x.png" alt="X"></a>
        </div>
      </div>
    </div>
  </footer>

 <!-- LOGIN MODAL -->
<div id="loginModal" class="modal">
    <div class="modal-content">
  
      <img src="img/UL_logo.png" class="modal-logo" alt="Logo">
  
      <h1>WELCOME</h1>
      <p class="subtitle">Sign in to your account</p>
  
      <form method="POST" action="">
    <!-- ERROR MESSAGE -->
    <?php if ($error != "" && isset($_POST['login'])): ?>
        <p style="color:red; font-size:14px;"><?php echo $error; ?></p>
    <?php endif; ?>

    <!-- SUCCESS MESSAGE -->
    <?php if ($success != "" && isset($_POST['login'])): ?>
        <p style="color:green; font-size:14px;"><?php echo $success; ?></p>
    <?php endif; ?>

    <input type="email" name="login_email" placeholder="Email" required>
    <input type="password" name="login_password" placeholder="Password" required>
    <button type="submit" name="login" class="login-btn">LOGIN</button>
</form>
  
      <p class="signup-text">
        Don't have an account? <a href="#" id="openSignup">Sign up</a>
      </p>
  
    </div>
  </div>

  <!-- REGISTER MODAL -->
<div id="signupModal" class="modal">
    <div class="modal-content">
  
      <img src="img/UL_logo.png" class="modal-logo" alt="Logo">
  
      <!-- <h1>REGISTER</h1> -->
      <p class="subtitle">Create your account</p>
  
      <form method="POST" action="">
    
    <!-- ERROR MESSAGE -->
    <?php if ($error != ""): ?>
        <p style="color:red; font-size:16px;"><?php echo $error; ?></p>
    <?php endif; ?>

    <!-- SUCCESS MESSAGE -->
    <?php if ($success != ""): ?>
        <p style="color:green; font-size:16px;"><?php echo $success; ?></p>
    <?php endif; ?>

    <input type="text" name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>

    <select name="role" required>
        <option value="student" selected>Student</option>
        <option value="counsellor">Counsellor</option>
        <option value="admin">Admin</option>
    </select>

    <button type="submit" class="login-btn">REGISTER</button>
</form>
  
      <p class="signup-text">
        Already have an account? <a href="#" id="backToLogin">Login</a>
      </p>
  
    </div>
  </div>

  <?php if ($error != "" || $success != ""): ?>
<script>
    <?php if (isset($_POST['register'])): ?>
        document.getElementById("signupModal").style.display = "block";
    <?php elseif (isset($_POST['login'])): ?>
        document.getElementById("loginModal").style.display = "block";
    <?php endif; ?>
</script>
<?php endif; ?>
  
  <!-- JS -->
  <script src="script.js"></script>
</body>
</html>