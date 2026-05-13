<?php
declare(strict_types=1);

const SITE_NAME = 'CV Naya Informatika';
const SITE_TAGLINE = 'Solusi Digital, Infrastruktur, dan Konsultasi IT';

/*
 * Ganti nilai ini saat masuk produksi. Key harus 32 karakter untuk AES-256.
 * Simpan di environment variable bila nanti aplikasi dipasang di hosting.
 */
const URL_SECRET_KEY = 'naya-informatika-demo-key-2026!!';
const URL_SECRET_IV = 'naya-demo-iv2026';

const DB_HOST = '127.0.0.1';
const DB_NAME = 'db_naya_informatika';
const DB_USER = 'root';
const DB_PASS = '';
const DB_CHARSET = 'utf8mb4';

const ROUTES = [
    'home' => 'Beranda',
    'about' => 'Tentang',
    'services' => 'Layanan',
    'contact' => 'Kontak',
];
