<?php

$conn = new mysqli('localhost', 'root', '', 'grocery');

if ($conn->connect_error) {
    exit('Connection failed: '.$conn->connect_error);
}
