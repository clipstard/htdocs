<?php
session_start();
$username = 'root';
$password = '';
$hostname = 'localhost';
$reservedNames = ['information_schema', 'mysql', 'test', 'performance_schema', 'phpmyadmin'];

$mysqli = mysqli_connect($hostname, $username, $password);
$db = $mysqli->query('SHOW DATABASES;');
$dbs = array_unique(array_diff(array_values($db->fetch_array()), $reservedNames));

if (!empty($dbs)) {
    $mysqli->select_db($dbs[0]);
    $_SESSION['selected_db'] = $dbs[0];
}
