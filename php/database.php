<?php
// database Logingegevens
$db_hostname = 'localhost'; //of '127.0.0.1'
$db_username = 'root';
$db_password = '';
$db_database = 'snoepkoning';

// maak de database-verbinding
$conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
