<?php

session_start();
$mysqli = mysqli_connect('localhost', 'root', null);

if (!!$mysqli) {
    $query = $mysqli->query('CREATE DATABASE admin');
    $_SESSION['databases'] = ['admin'];
}

$_SESSION['selected_db'] = 'admin';
$mysqli->select_db('admin');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Set up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body>
<div>
    Current databases are <?php echo implode($_SESSION['databases'], ', ') ?>
</div>
<div>
    Selected database is <strong><?php echo  $_SESSION['selected_db'] ?></strong>
</div>
<div>
    Set a password
</div>

</body>
</html>