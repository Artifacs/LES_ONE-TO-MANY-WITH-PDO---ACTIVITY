<?php
/**
 * config/dbconfig.php - PDO connection (XAMPP defaults).
 * Included by every page that needs the database ($pdo).
 */
$host = 'localhost';
$db   = 'data_consulting_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,   // throw errors as exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,         // rows as associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                    // real prepared statements
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
