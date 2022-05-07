<?php

    session_start();
    $mysqli = mysqli_connect('localhost', 'root', '');
$str = 'existent databases: ';

    if (!$mysqli) {
        return;
    }
         $db = $mysqli->query('SHOW DATABASES;');
         $results = $db->fetch_array();
         $str .= implode(', ', $results);

//        $query = $mysqli->query('CREATE DATABASE admin');
//        $_SESSION['databases'] = ['admin'];

//    $_SESSION['selected_db'] = 'admin';
//    $mysqli->select_db('admin');

echo $str;
    mysqli_close($mysqli);
