<?php

require '../mysql_connect.php';
global $mysqli;

$id = null;
$name = '';
$price = '0';
$description = '';
$producer = '';
$delivery = [];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $mysqli->query("SELECT * from products where id = $id");
    if ($result) {
        $object = $result->fetch_assoc();
        $name = $object['name'];
        $price = $object['price'];
        $description = $object['description'];
        $producer = $object['producer'];
        $delivery = json_decode($object['delivered_by'], true);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $id ? 'Edit' : 'Create' ?> product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/global.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="example.js"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
    <a class="navbar-brand" href="/example">⬅️Back</em></a>
</nav>
<div class="container">
    <form action="<?php echo $id ?'edit_product.php?id=' . $id : 'create_product.php' ?>" method="post" class="form-group mt-3">
        <h1>
            <?php echo $id ? 'Edit' : 'Create' ?> product
        </h1>
        <div class="row">
            <div class="col-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label for="name-input" class="input-group-text" id="name-addon">Name</label>
                    </div>
                    <input type="text" class="form-control" id="name-input" name="name" <?php echo "value=\"$name\""?> aria-describedby="name-addon">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label for="price-input" class="input-group-text" id="price-addon">Price</label>
                    </div>
                    <input type="text" class="form-control" id="price-input" name="price" <?php echo "value=\"$price\""?> aria-describedby="price-addon">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label for="producer-input" class="input-group-text" id="producer-addon">Producer</label>
                    </div>
                    <input type="text" class="form-control" id="producer-input" name="producer" <?php echo "value=\"$producer\""?> aria-describedby="producer-addon">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label for="description-input" class="input-group-text" id="description-addon">Description</label>
                    </div>
                    <textarea class="form-control" id="description-input" aria-label="Description" name="description" aria-describedby="description-addon"><?php echo $description ?></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <h2 id="delivery-button" class="cursor-pointer">Delivery info <button class="btn btn-light" type="button">+</button></h2>
            </div>
        </div>

        <div class="row" id="submit-row">
            <div class="col-6">
                <button class="btn btn-success" type="button" id="submit-button">
                    Submit
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    $('#delivery-button').on('click', function () {
        insertInDomDeliveryItem();
    });
</script>
<script src="create-functions.js"></script>
<?php
if (!empty($delivery)) {
    echo "

<script>
";
    foreach ($delivery as $item) {
        $name = $item['name'];
        $icon = $item['icon'];
        $city = $item['city'];

        echo "insertInDomDeliveryItem({
            name: '$name',
            icon: '$icon',
            city: '$city',
            });";
    }
    echo "</script>";
}
?>

</body>
</html>
