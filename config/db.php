<?php

require_once 'config.php';
// Database Connection Parameters
$host = DB_HOST;
$dbname = DB_NAME;
$username = DB_USER;
$password = DB_PASS;
// PDO Connection
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO to throw exceptions on error
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Set PDO to return associative arrays by default
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // Set character set to UTF-8
    $db->exec("SET NAMES utf8");
} catch (PDOException $e) {
    // If connection fails, display error message
    die("Database connection failed: " . $e->getMessage());
};
