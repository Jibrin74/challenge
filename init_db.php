<?php
require_once __DIR__ . '/config/config.php';

try {
    // Connect to MySQL without database first to create it
    $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";charset=" . DB_CHARSET;
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    
    $sql = file_get_contents(__DIR__ . '/database/schema.sql');
    
    // Split SQL by semicolon, but handle comments and empty lines
    $queries = explode(';', $sql);
    
    foreach ($queries as $query) {
        $query = trim($query);
        if (empty($query)) continue;
        
        try {
            $pdo->exec($query);
        } catch (PDOException $e) {
            echo "Error executing query: " . $e->getMessage() . "\nQuery: " . substr($query, 0, 100) . "...\n\n";
        }
    }
    
    echo "Database initialization complete.\n";
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
