<?php

require '../mysql_connect.php';
global $mysqli;


function createProduct(array $data)
{
    global $mysqli;
    $name = str_replace(["'", '"'], ['\\\'', '\\\''], $data['name'] ?? '');
    $price = $data['price'] ?? 0;
    $description = str_replace(["'", '"'], ['\\\'', '\\\''], $data['description'] ?? '');
    $producer = str_replace(["'", '"'], ['\\\'', '\\\''], $data['producer'] ?? '');
    $delivery = json_encode($data['delivery'] ?? '');

    if (!$delivery) {
        $delivery = '';
    }

    $query = "
INSERT INTO products (name, price, description, producer, delivered_by)
    VALUES ('$name', $price, '$description', '$producer', '$delivery' );";

    $result = $mysqli->query($query);
    $_SESSION['create_result'] = !!$result;
}

createProduct($_POST);
header('Location: /example');
