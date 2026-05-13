<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

function base64url_encode(string $value): string
{
    return rtrim(strtr(base64_encode($value), '+/', '-_'), '=');
}

function base64url_decode(string $value): string|false
{
    $padding = strlen($value) % 4;
    if ($padding > 0) {
        $value .= str_repeat('=', 4 - $padding);
    }

    return base64_decode(strtr($value, '-_', '+/'), true);
}

function encrypt_page(string $page): string
{
    $cipherText = openssl_encrypt(
        $page,
        'AES-256-CBC',
        URL_SECRET_KEY,
        OPENSSL_RAW_DATA,
        substr(URL_SECRET_IV, 0, 16)
    );

    if ($cipherText === false) {
        return base64url_encode($page);
    }

    return base64url_encode($cipherText);
}

function decrypt_page(string $token): ?string
{
    $cipherText = base64url_decode($token);
    if ($cipherText === false) {
        return null;
    }

    $plainText = openssl_decrypt(
        $cipherText,
        'AES-256-CBC',
        URL_SECRET_KEY,
        OPENSSL_RAW_DATA,
        substr(URL_SECRET_IV, 0, 16)
    );

    if ($plainText === false || !array_key_exists($plainText, ROUTES)) {
        return null;
    }

    return $plainText;
}

function route_url(string $page): string
{
    return 'index.php?p=' . urlencode(encrypt_page($page));
}

function current_page(): string
{
    if (!isset($_GET['p']) || $_GET['p'] === '') {
        return 'home';
    }

    return decrypt_page((string) $_GET['p']) ?? 'home';
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
