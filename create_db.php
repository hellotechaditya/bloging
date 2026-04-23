<?php
try {
    $pdo = new PDO('mysql:host=localhost', 'root', '');
    $pdo->exec('CREATE DATABASE IF NOT EXISTS bloging');
    echo "Database 'bloging' checked/created successfully.\n";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
    exit(1);
}
