<?php
    require('../src/config.php');
    $pageTitle= 'My Order';
    $pageId = 'myOrder';
    $message= '';
   
    $order = $orderDbHandler->fetchOrdersItemsByOrderId($_GET['orderId']);
    // debug($order);
 ?>
<?php include('layout/header.php'); ?>
<div class="container emp-profile">
    <h2>My Order #<?=htmlentities($_GET['orderId']) ?></h2>

    <h3>Products</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Quantity</th>
                <th>Unit price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($order as $orderItem) : ?>
            <tr>

                <td><img class="rounded " src="<?=$orderItem['image_url']?>" style="width:50px;height:50px;"></td>
                <td><?=htmlentities($orderItem['product_title']) ?></td>
                <td><?=htmlentities($orderItem['quantity']) ?></td>
                <td><?=htmlentities($orderItem['unit_price']) ?> kr</td>

            </tr>

            <?php endforeach; ?>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><b>Total: <?=htmlentities($orderItem['total_price']) ?> kr</b></td>
            </tr>

        </tbody>
    </table>

</div>
<?php include('layout/footer.php'); ?>