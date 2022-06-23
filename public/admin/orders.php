<?php
    require('../../src/config.php');
    $pageTitle= 'Manage Orders';
    $pageId = 'manageOrders';
    $message= '';
    $orders = $orderDbHandler->fetchAllOrders();
 ?>

<?php include('layout/header.php'); ?>

<!-- Sidans/Dokumentets huvudsakliga innehåll -->
<div id="content">

    <h4>Manage users </h4>

    <br>
    <?=$message ?>
    <p>Total: <span>( <?=count($orders); ?> ) orders</span></p>
    <table class="table ">
        <thead>
            <tr>
                <th>Order Id</th>
                <th>Customer name</th>
                <th>Price</th>
                <th>Order date</th>
                <th class="manage">Manage status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($orders as $order) : ?>
            <tr>
                <td>
                    <form action="order.php" method="GET">
                        <input type="hidden" name="orderId" value="<?=htmlentities($order['id']) ?>">
                        <button type="submit" class="btn btn-warning">#<?=htmlentities($order['id']) ?></button>
                    </form>
                </td>
                <td><?=htmlentities($order['billing_full_name']) ?></td>
                <td><?=htmlentities($order['total_price']) ?></td>
                <td><?=htmlentities($order['create_date']) ?></td>
                <td class="manage">
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Pending</a></li>
                            <li><a class="dropdown-item" href="#">Processing</a></li>
                            <li><a class="dropdown-item" href="#">Completed</a></li>

                        </ul>
                    </div>
                </td>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php include('layout/footer.php'); ?>