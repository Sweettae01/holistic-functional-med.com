<?php
require 'config.php';
if (empty($_SESSION['pending_user_id'])) { header('Location: login.php'); exit; }
$error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    if (!verifyCsrf($_POST['csrf_token'] ?? '')) $error='Invalid CSRF token';
    if (($_POST['code'] ?? '') === ($_SESSION['twofa_code'] ?? '')) {
        $_SESSION['user_id'] = $_SESSION['pending_user_id'];
        $_SESSION['role'] = $_SESSION['pending_role'];
        unset($_SESSION['pending_user_id'], $_SESSION['pending_role'], $_SESSION['twofa_code']);
        header('Location: dashboard.php'); exit;
    }
    $error='Invalid code';
}
?><p>Demo: check PHP error logs for test code.</p><form method='post'><input type='hidden' name='csrf_token' value='<?= htmlspecialchars(csrfToken()) ?>'><input name='code' placeholder='6-digit code'><button>Verify</button><p><?= htmlspecialchars($error) ?></p></form>
