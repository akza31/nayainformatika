<?php
declare(strict_types=1);

require_once __DIR__ . '/database.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Metode request tidak valid.',
    ]);
    exit;
}

$name = trim((string) ($_POST['name'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$service = trim((string) ($_POST['service'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));

$errors = [];

if ($name === '') {
    $errors[] = 'Nama wajib diisi.';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Email tidak valid.';
}

if ($service === '') {
    $errors[] = 'Kebutuhan wajib dipilih.';
}

if ($message === '') {
    $errors[] = 'Pesan wajib diisi.';
}

if ($errors !== []) {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => implode(' ', $errors),
    ]);
    exit;
}

try {
    $stmt = db()->prepare(
        'INSERT INTO contact_messages (name, email, service, message, ip_address, user_agent)
         VALUES (:name, :email, :service, :message, :ip_address, :user_agent)'
    );

    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'service' => $service,
        'message' => $message,
        'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
        'user_agent' => substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 255),
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Pesan berhasil disimpan ke database.',
    ]);
} catch (PDOException $exception) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Pesan belum bisa disimpan. Pastikan database MariaDB sudah dibuat dan server aktif.',
    ]);
}
