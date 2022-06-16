<?php
require('../src/config.php');

$articleItemCount = count($_SESSION['items']);

$articleTotalSum = 0;

foreach ($_SESSION['items'] as $articleId => $articleItem) {
    $articleTotalSum += $articleItem['price'] * $articleItem['stock'];
}

if (empty($_SESSION['items'])) {
    header('Location: index.php');
    exit;
}

$articleItem = $_SESSION['items'];


?>

<?php include('layout/header.php'); ?>

<br>
<h1>Thank you for the purchase</h1>
<p>Your order is complete. </p>
<br>

<table class="table table-borderless">
    <thead>
        <tr>
            <th style="width: 15%">Article</th>
            <th style="width: 50%">Description</th>
            <th style="width: 15%">Stock</th>
            <th style="width: 15%">Price</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($_SESSION['items'] as $articleId => $articleItem) { ?>
            <tr>
                <td><img src="img/<?= $articleItem['image_url'] ?>" style="width:50px;height:auto;"></td>
                <td><?= htmlentities($articleItem['description']) ?></td>
                <td><?= htmlentities($articleItem['stock']) ?></td>
                <td><?= htmlentities($articleItem['price']) ?> kr</td>
            </tr>
        <?php } ?>

        <tr class="border-top">
            <td></td>
            <td></td>
            <td></td>
            <td><b>Total: <?= $articleTotalSum ?> kr</b></td>
        </tr>
    </tbody>
</table>

<div class="d-flex justify-content-center">
    <form action="products.php">
        <input type="submit" name="" value="Back" class="btn btn-dark text-light">
    </form>
</div>

<?php
unset($_SESSION['items']);
?>