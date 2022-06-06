<?php
    require('../../src/config.php');


    $products = $productDbHandler -> fetchAllProducts();

   
?>

    <?php include('layout/header.php'); ?>
    
    <div id="content">

<h2>Manage Products</h2>

<?=$message ?> 
<div id="new-product">
<form action="create-product.php" method="GET">
<button type="submit" class="btn btn-warning"><i class="fas fa-plus"></i> Add new product</button> 
</form>
</div>
<br>

<table class="table ">
    <thead>
        <tr>
            <th>Id</th>
            <th>title</th>
            <th>description</th>
            <th>price</th>
            <th>stock</th>
            <th>img_url</th>
            <th class="manage">Manage</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($products as $product) : ?>
            <tr>
                <td><?=htmlentities($product['id']) ?></td>
                <td><?=htmlentities($product['title']) ?></td>
                <td><?=htmlentities($product['description']) ?></td>
                <td><?=htmlentities($product['price'])?></td>
                <td><?=htmlentities($product['stock']) ?></td>
                <td><?=htmlentities($product['img_url']) ?></td>
                <td class="manage">
                    <form action="update-product.php" method="GET">
                        <input type="hidden" name="productId" value="<?=htmlentities($product['id']) ?>">
                        <button type="submit" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                    </form>

                    <form action="" method="POST">
                        <input type="hidden" name="productId" value="<?=htmlentities($product['id']) ?>">
                        <button type="submit" name="deleteUserBtn" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>          

</div>
    
    <?php include('layout/footer.php'); ?>