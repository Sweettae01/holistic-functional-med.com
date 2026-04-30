<?php
// cPanel MySQL configuration: keep this file outside web root in production if possible.
declare(strict_types=1);

$host = 'localhost';
$db   = 'holistic_med';
$user = 'db_user';
$pass = 'db_password';
$charset = 'utf8mb4';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass, $options);

ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_secure', '1'); // Requires HTTPS.
ini_set('session.use_strict_mode', '1');
session_start();

function csrfToken(): string {
    if (empty($_SESSION['csrf_token'])) $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf_token'];
}
function verifyCsrf(string $token): bool {
    return hash_equals($_SESSION['csrf_token'] ?? '', $token);
}
