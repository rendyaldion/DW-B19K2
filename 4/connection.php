<?php
$conn = new mysqli("localhost", "root", "", "dw_b19k2");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>