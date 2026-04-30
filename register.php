<?php
require 'config.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrf($_POST['csrf_token'] ?? '')) $errors[] = 'Invalid CSRF token.';
    $name = trim($_POST['name'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    if (!$email || strlen($password) < 8) $errors[] = 'Use valid email and 8+ char password.';
    if (!$errors) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash, phone, role) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$name, $email, $hash, $phone, 'customer']);
        header('Location: login.php'); exit;
    }
}
?><form method='post'><input type='hidden' name='csrf_token' value='<?= htmlspecialchars(csrfToken()) ?>'><input name='name' placeholder='Name' required><input name='email' type='email' required><input name='phone' placeholder='Phone'><input name='password' type='password' required><button>Register</button><?php foreach($errors as $e) echo '<p>'.htmlspecialchars($e).'</p>'; ?></form>
