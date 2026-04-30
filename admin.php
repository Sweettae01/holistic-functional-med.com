<?php
require 'config.php';
if (empty($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') { http_response_code(403); exit('Admins only'); }
$users = $pdo->query('SELECT id,name,email,role,created_at FROM users ORDER BY id DESC LIMIT 25')->fetchAll();
$msgs = $pdo->query('SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 25')->fetchAll();
$progress = $pdo->query('SELECT * FROM course_progress ORDER BY updated_at DESC LIMIT 25')->fetchAll();
$traffic = $pdo->query('SELECT * FROM site_traffic ORDER BY visited_at DESC LIMIT 25')->fetchAll();
?><h1>Admin Dashboard</h1><p>View users, contact messages, course progress, and traffic logs.</p>
