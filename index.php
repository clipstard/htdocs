<?php

require 'mysql_connect.php';
global $mysqli, $username, $password, $reservedNames;

$str = 'Databases created: ';

if (!$mysqli) {
    echo "Cannot connect to mysql with username \"$username\" and password \"$password\"";
    return;
}

$db = $mysqli->query('SHOW DATABASES;');
$dbs = array_unique(array_diff(array_values($db->fetch_array(MYSQLI_NUM)), $reservedNames));
$databasesStr = implode(', ', $dbs);

if ($databasesStr === '') {
    $str .= '<span style="color: darkred">&lt;empty&gt;</span>';
    $query = $mysqli->query('CREATE DATABASE profiles');
    $mysqli->select_db('profiles');
} else {
    $str .= '<strong>' . $databasesStr . '</strong>';
    $mysqli->select_db($dbs[array_key_first($dbs)]);
}

echo '<br><br><br><br>';
echo $str;
echo '<br/>';
echo 'Currently selected: <strong>' . (!empty($dbs) ? $dbs[array_key_first($dbs)] : '') . '</strong>';
echo '<br/><br/><br/>';
echo '<a href="/example" target="_self">Example</a><br>';
echo '<a href="/homework" target="_self">Homework</a><br>';
echo '<a href="/phpmyadmin" target="_self">PhpMyAdmin</a><br>';
mysqli_close($mysqli);
