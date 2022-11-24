<?php
if (file_exists( './vendor/autoload.php')) {
    require_once( './vendor/autoload.php');
}
$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

$servername = $_ENV['DB_SERVER'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_NAME'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
return $conn;