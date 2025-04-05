<?php
$host = '196.218.222.163'; // Your static IP
$user = 'guest';           // Your username
$password = 'PR)LqeT6htW9XSu3'; // Your actual password
$database = 'loans'; // Your database name
$port = 3306;              // Default MySQL port

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Create connection
    $conn = new mysqli($host, $user, $password, $database, $port);
    
    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    // Set charset for Arabic support
    if (!$conn->set_charset("utf8mb4")) {
        throw new Exception("Error setting charset: " . $conn->error);
    }
    
    // Debug message (remove in production)
    error_log("Successfully connected to database server");
    
} catch (Exception $e) {
    // Log the full error for debugging
    error_log("Database Error: " . $e->getMessage());
    
    // User-friendly message
    die("We're experiencing technical difficulties. Please try again later.");
}
?>