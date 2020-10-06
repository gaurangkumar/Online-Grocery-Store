<?php
$conn = new mysqli("localhost", "root", "", "grocery");

if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
}
