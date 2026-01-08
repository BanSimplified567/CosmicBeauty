<?php
// Load environment variables (basic approach)
$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USERNAME');
$db_pass = getenv('DB_PASSWORD');
$db_name = getenv('DB_DATABASE');
$db_port = getenv('DB_PORT');

// Connect to the database
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
