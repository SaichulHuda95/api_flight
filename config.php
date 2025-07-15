<?php
date_default_timezone_set('Asia/Jakarta');

$host = "localhost"; // Ganti dengan host database
$dbname = "tes_api"; // Ganti dengan nama database
$username = "root"; // Ganti dengan username database
$password = "root"; // Ganti dengan password database

try {
    // Buat koneksi ke database dengan PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Mode error Exception
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Hasil fetch dalam bentuk array asosiatif
        PDO::ATTR_EMULATE_PREPARES   => false, // Mencegah SQL Injection
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4" // Gunakan UTF-8
    ]);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
