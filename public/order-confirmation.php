<?php
    require('../src/config.php');
    $pageTitle= 'Order Confirmation';
    $pageId = 'orderConfirmation';
    if(empty($_SESSION['cartItems'])){
        header('Location: checkout.php');
        exit;
    }

    $cartItems = $_SESSION['cartItems'];
    $totalSum = 0;
    foreach($cartItems as $cartId =>$cartItem){
    $totalSum += $cartItem['price'] * $cartItem['quantity'];

    }
    unset($_SESSION['cartItems']);
?>
<?php include('layout/header.php'); ?>
<div class="container order-body">

    <h2>Thank you for your purchase!</h2>
    <table id="confirmationTbl" class="table table-borderless">
        <thead>
            <tr>
                <th>Product</th>
                <th>Title</th>
                <th>Quantity</th>
                <th>Unit price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($cartItems as $item):?>
            <tr>
                <td>
                <img class="rounded mx-auto " width="100" src="<?=$item['image_url']?>">
                </td>
                <td><?=$item['title']?></td>
                <td><?=$item['quantity']?></td>
                <td><?=$item['price']?> kr</td>
            </tr>
            <?php endforeach; ?>
            <tr class="border-top">
                <td></td>
                <td></td>
                <td></td>
                <td><b>Total: <?=$totalSum?> kr</b></td>
            </tr>
        </tbody>
    </table>
</div>
<?php include('layout/footer.php'); ?>