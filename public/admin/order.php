<?php
    require('../../src/config.php');
    $pageTitle= 'Manage Order';
    $pageId = 'manageOrder';
    $message= '';
    $orderById = $orderDbHandler->fetchOrdersByOrderIdJoinUsers($_GET['orderId']);
    $order = $orderDbHandler->fetchOrdersItemsByOrderId($_GET['orderId']);
    // debug($order);
 ?>
<?php include('layout/header.php'); ?>
<div id="content">
    <h2>Manage Order #<?=htmlentities($_GET['orderId']) ?></h2>
    <h3>Customer</h3>
    <ul class="list-group">
        <li class="list-group-item">Name: <?=htmlentities($orderById['billing_full_name']) ?></li>
        <li class="list-group-item">Email: <?=htmlentities($orderById['email']) ?></li>
        <li class="list-group-item">Phone: <?=htmlentities($orderById['phone']) ?></li>
        <li class="list-group-item">Zip code: <?=htmlentities($orderById['billing_postal_code']) ?></li>
        <li class="list-group-item">Street: <?=htmlentities($orderById['billing_street']) ?></li>
        <li class="list-group-item">City: <?=htmlentities($orderById['billing_city']) ?></li>
        <li class="list-group-item">Country: <?=htmlentities($orderById['billing_country']) ?></li>
    </ul>
    <br>
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