<?php

require '../mysql_connect.php';
global $mysqli;


function editProduct(array $data)
{
    global $mysqli;
    if (!isset($_GET['id'])) {
        $_SESSION['edit_result'] = false;
        $_SESSION['edit_message'] = 'Id is not given 👋🏻';
        return;
    }

    $id = $_GET['id'];
    $name = str_replace(["'", '"'], ['\\\'', '\\\''], $data['name'] ?? '');
    $price = $data['price'] ?? 0;
    $description = str_replace(["'", '"'], ['\\\'', '\\\''], $data['description'] ?? '');
    $producer = str_replace(["'", '"'], ['\\\'', '\\\''], $data['producer'] ?? '');
    $delivery = json_encode($data['delivery']);

    if (!$delivery) {
        $delivery = '';
    }

    $query = "
UPDATE products SET name = '$name', price = $price, description = '$description', producer = '$producer', delivered_by = '$delivery' where id = '$id';";

//    var_dump($query); die;
    $result = $mysqli->query($query);
    $_SESSION['edit_result'] = !!$result;
    $_SESSION['edit_message'] = $result ? 'Product updated successfully 👌' : "Something went wrong updating $name product 🤷";
}

editProduct($_POST);
header('Location: /example');
