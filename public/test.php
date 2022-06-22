<tbody>
    <?php foreach($orders as $order) : ?>
    <tr>
        <div class="card">
            <div class="card-header">
                <div id="card-header">
                    <td><a class="collapsed btn" data-bs-toggle="collapse"
                            href="#collapseTwo">#<?=htmlentities($order['id']) ?>
                            <input type="hidden" name="orderId" value="<?=$order['id']?>"></a>

                        <div id="collapseTwo" class="collapse" data-bs-parent="#card-header">

                            <div class="card-body">
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

                                            <td>
                                                <img class="rounded " src="<?=$orderItem['image_url']?>"
                                                    style="width:50px;height:50px;">
                                            </td>
                                            <td><?=htmlentities($orderItem['product_title']) ?>
                                            </td>
                                            <td><?=htmlentities($orderItem['quantity']) ?></td>
                                            <td><?=htmlentities($orderItem['unit_price']) ?> kr
                                            </td>

                                        </tr>

                                        <?php endforeach; ?>

                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b>Total:
                                                    <?=htmlentities($orderItem['total_price']) ?>
                                                    kr</b></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                </div>


            </div>
            <td><?=htmlentities($order['total_price']) ?> kr</td>
            <td><?=htmlentities($order['create_date']) ?></td>


        </div>



    </tr>
    <?php endforeach; ?>
</tbody>