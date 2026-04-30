<?php
require 'config.php';
if (empty($_SESSION['user_id'])) { http_response_code(403); exit('Login required'); }
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !verifyCsrf($_POST['csrf_token'] ?? '')) { http_response_code(400); exit('Invalid request'); }
$stmt = $pdo->prepare('INSERT INTO course_progress (user_id, course_id, module_id, lesson_id, last_position) VALUES (?, ?, ?, ?, ?)');
$stmt->execute([
    $_SESSION['user_id'],
    filter_var($_POST['course_id'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
    filter_var($_POST['module_id'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
    filter_var($_POST['lesson_id'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
    filter_var($_POST['last_position'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS)
]);
header('Location: course-dashboard.php');
