<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "admin");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
