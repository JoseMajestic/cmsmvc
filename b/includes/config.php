<?php
// configuración básica para Laragon / MariaDB
const DB_HOST = '127.0.0.1';
const DB_PORT = 3306;
const DB_NAME = 'users';
const DB_USER = 'root';
const DB_PASS = '';

try {
    // conectar coa base de datos usando PDO
    $dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4', DB_HOST, DB_PORT, DB_NAME);
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die('Erro ao conectar coa base de datos: ' . $e->getMessage());
}
