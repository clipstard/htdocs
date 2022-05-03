<?php

    session_start();
    $mysqli = mysqli_connect('localhost', 'root', null);

    if (!!$mysqli) {
        $query = $mysqli->query('CREATE DATABASE admin');
        $_SESSION['databases'] = ['admin'];
    }

    $_SESSION['selected_db'] = 'admin';
    $mysqli->select_db('admin');