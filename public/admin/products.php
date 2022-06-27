<?php
require('../../src/config.php');
$pageTitle = 'Manage Products';
$pageId = 'manage-products';


if (isset($_POST['deleteProductBtn'])) {
    $productDbHandler->deleteProduct();
     // Success message
  $message = '   
  <div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
    <i class="bi-check-circle-fill"></i>
    <strong class="mx-2">Success!</strong> The product was successfully deleted.
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
';
}

$products = $productDbHandler->fetchAllProducts();
?>

<?php include('layout/header.php'); ?>

<div id="content">

    <h2>Manage Products</h2>

    <?= $message ?>
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
                <th>image</th>
                <th>title</th>
                <th>price (kr)</th>
                <th>stock </th>

                <th class="manage">Manage</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product) : ?>
            <tr>
                <td><?= htmlentities($product['id']) ?></td>
                <td><image class="rounded" src="<?=$product['img_url']?>"
                        style="width:50px;height:auto;"></td>
                <td><?= htmlentities($product['title']) ?></td>
                <td><?= htmlentities($product['price']) ?></td>
                <td><?= htmlentities($product['stock']) ?></td>

                <td class="manage">
                    <form action="update-product.php" method="GET">
                        <input type="hidden" name="productId" value="<?= htmlentities($product['id']) ?>">
                        <button type="submit" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                    </form>

                    <form action="" method="POST">
                        <input type="hidden" name="productId" value="<?= htmlentities($product['id']) ?>">
                        <button type="submit" name="deleteProductBtn" class="btn btn-danger"><i
                                class="fas fa-trash"></i></button>
                    </form>
                </td>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php include('layout/footer.php'); ?>