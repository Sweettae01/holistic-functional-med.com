<?php
require 'config.php';
if (empty($_SESSION['user_id'])) { header('Location: login.php'); exit; }
$stmt=$pdo->prepare('SELECT * FROM course_progress WHERE user_id=? ORDER BY updated_at DESC LIMIT 1');
$stmt->execute([$_SESSION['user_id']]);
$progress=$stmt->fetch();
?><h1>Course Dashboard</h1><p>Last saved lesson: <?= htmlspecialchars($progress['lesson_id'] ?? 'None yet') ?></p><form method='post' action='course-progress.php'><input type='hidden' name='csrf_token' value='<?= htmlspecialchars(csrfToken()) ?>'><input name='course_id' placeholder='course_id'><input name='module_id' placeholder='module_id'><input name='lesson_id' placeholder='lesson_id'><input name='last_position' placeholder='time or position'><button>Save Progress</button></form>
