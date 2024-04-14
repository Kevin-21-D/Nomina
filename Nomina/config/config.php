<?php
// Database configuration
$db_host = 'localhost';
$db_name = 'nomina_pro';
$db_user = 'root';
$db_pass = '';

$db_host = 'localhost';
$db_name = 'nomina_pro';
$db_user = 'root';
$db_pass = '';

$db_host = 'localhost';
$db_user = 'gtzarsmp_yshyvsev';
$db_pass = ']p@5+N+0*_bB';
$db_name = 'gtzarsmp_melonayfoforro_deusapacolombia';

// Connect to the database
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

?>