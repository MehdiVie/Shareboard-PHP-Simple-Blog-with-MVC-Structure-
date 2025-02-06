<?php
// Database configuration
define('DB_HOST', 'localhost'); // Your MySQL server host
define('DB_USER', 'root'); // MySQL username
define('DB_PASS', 'rootroot'); // MySQL password
define('DB_NAME', 'shareboard'); // Your database name

// Create connection (optional for debugging)
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection (optional for debugging)
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//echo "Connected successfully"; // Remove this in production

// Close connection
$conn->close();
