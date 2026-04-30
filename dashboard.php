<?php
require 'config.php';
if (empty($_SESSION['user_id'])) { header('Location: login.php'); exit; }
?><h1>Client Dashboard</h1><p>Welcome! <a href='course-dashboard.php'>Go to course dashboard</a> | <a href='logout.php'>Logout</a></p>
