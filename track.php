<?php
declare(strict_types=1);
require 'config.php';

$input = json_decode(file_get_contents('php://input'), true) ?? [];
$page = filter_var($input['page_visited'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$time = filter_var($input['timestamp'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$ref = filter_var($input['referral_source'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$device = filter_var($input['device_type'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$browser = filter_var($input['browser'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$stmt = $pdo->prepare('INSERT INTO site_traffic (page_visited, visited_at, referral_source, device_type, browser) VALUES (?, ?, ?, ?, ?)');
$stmt->execute([$page, $time, $ref, $device, $browser]);

// Future analytics placeholder: integrate Google Analytics / Matomo if consented.
echo json_encode(['status' => 'ok']);
