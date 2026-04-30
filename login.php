<?php
require 'config.php';
$errors=[];
$_SESSION['login_attempts'] = $_SESSION['login_attempts'] ?? 0;
if ($_SESSION['login_attempts'] > 5) $errors[] = 'Too many attempts. Please wait.';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$errors) {
    if (!verifyCsrf($_POST['csrf_token'] ?? '')) $errors[] = 'Invalid CSRF token.';
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';
    $stmt = $pdo->prepare('SELECT id, password_hash, role FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['pending_user_id'] = $user['id'];
        $_SESSION['pending_role'] = $user['role'];
        $_SESSION['twofa_code'] = str_pad((string)random_int(0,999999), 6, '0', STR_PAD_LEFT);
        $_SESSION['login_attempts'] = 0;
        // Demo only: send this via secure email/SMS provider in production.
        error_log('Demo 2FA code: '.$_SESSION['twofa_code']);
        header('Location: verify-2fa.php'); exit;
    }
    $_SESSION['login_attempts']++;
    $errors[]='Invalid credentials';
}
?><form method='post'><input type='hidden' name='csrf_token' value='<?= htmlspecialchars(csrfToken()) ?>'><input name='email' type='email' required><input type='password' name='password' required><button>Login</button><?php foreach($errors as $e) echo '<p>'.htmlspecialchars($e).'</p>'; ?></form>
