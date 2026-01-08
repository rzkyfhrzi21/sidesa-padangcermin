<?php
session_start();
require_once 'env.php';

// Deteksi lingkungan: Localhost atau Hosting
$host = $_SERVER['HTTP_HOST'];

if ($host === 'localhost' || strpos($host, '127.0.0.1') !== false) {
    // Konfigurasi untuk Localhost
    $host       = 'localhost';
    $username   = 'root';
    $password   = '';
    $database   = 'sidesa_padangcermin';
} else {
    // Konfigurasi untuk Hosting
    $host       = 'sql100.byethost9.com';
    $username   = 'b9_40858794';
    $password   = 'padangcermin';
    $database   = 'b9_40858794_padangcermin';
    // $host       = 'localhost';
    // $username   = 'aru1gb4i_sidesa_padangcermin';
    // $password   = '4nZy3xl0mePu';
    // $database   = 'aru1gb4i_sidesa_padangcermin';
}

// Membuat koneksi ke database
$koneksi = mysqli_connect(
    $host,
    $username,
    $password,
    $database
);

// Memeriksa koneksi
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Menetapkan zona waktu
date_default_timezone_set('Asia/Jakarta');

// Mendapatkan waktu saat ini
$pukul = date('H:i A');
