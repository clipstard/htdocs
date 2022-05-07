<?php

global $id,
$name,
$price,
$description,
$producer,
$delivery;


?>

<h1>Product details (Id#: <?php echo $id ?>)</h1>
<div class="row">
    <div class="col-3">Name</div>
    <div class="col-9"><strong><?php echo $name ?></strong></div>
</div>
<div class="row">
    <div class="col-3">Price</div>
    <div class="col-9"><em>$<?php echo $price ?></em></div>
</div>
<div class="row">
    <div class="col-3">Description</div>
    <div class="col-9"><?php echo $description ?></div>
</div>
<div class="row">
    <div class="col-3">Producer</div>
    <div class="col-9"><?php echo $producer ?></div>
</div>
<br>
<br>
<br>
<br>
<div class="row">
    <div class="col-12"><h1>Delivery services</h1></div>
        <?php
        if (empty($delivery)) {
            $delivery = [];
        }

        foreach ($delivery as $item) {
            echo <<<CARD
    <div class="col-4 mb-4">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="img/${item['icon']}.jpg" alt="Logo">
            <div class="card-body">
                <h4 class="card-title">from ${item['city']} city</h4>
                <p class="card-text">${item['name']}</p>
            </div>
        </div>
    </div>

CARD;
        }
        ?>

</div>
<hr>

