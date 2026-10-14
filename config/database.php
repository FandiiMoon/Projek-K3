<?php
/**
 * K3 QUEST - Konfigurasi Database
 * Gunakan PDO untuk koneksi yang aman dan portable
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'k3_quest_db');
define('DB_USER', 'root');      // Sesuaikan dengan username MySQL kamu
define('DB_PASS', '');           // Sesuaikan dengan password MySQL kamu
define('DB_CHARSET', 'utf8mb4');

/**
 * Membuat koneksi PDO ke database.
 * Mengembalikan null jika koneksi gagal (mode demo diaktifkan).
 *
 * @return PDO|null
 */
function getDB(): ?PDO {
    static $pdo = null;

    if ($pdo !== null) {
        return $pdo;
    }

    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        // Database tidak tersedia — mode demo JavaScript aktif
        $pdo = null;
    }

    return $pdo;
}

/**
 * Apakah database tersedia?
 *
 * @return bool
 */
function isDBAvailable(): bool {
    return getDB() !== null;
}
