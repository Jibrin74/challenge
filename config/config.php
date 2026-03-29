<?php

// Database connection settings
$host = 'localhost'; // Usually 'localhost' in Codespaces
$username = 'your_database_user'; // e.g., 'root'
$password = 'your_database_password'; // Set your password here
$database = 'your_database_name'; // Set your database name here

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Application constants
define('APP_NAME', 'Nexora Payment Platform');
define('APP_VERSION', '1.0');

define('INTERNAL_API_URL', 'https://api.nexora.com/v1/');

define('PUBLIC_API_KEY', 'your_public_api_key'); // Replace with your API key

define('SECRET_API_KEY', 'your_secret_api_key'); // Replace with your secret API key

// Security settings
define('ENABLE_SSL', true);

define('JWT_SECRET', 'your_jwt_secret'); // Replace with your JWT secret

// Other security settings
$allowed_ips = ['your_server_ip']; // Define allowed IP addresses

?>