<?php
session_start();
session_destroy();

// Redirect back to home
header("Location: ../Home/index.php");
exit();
?>