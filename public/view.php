<?php
require '../src/config.php';

if (isset($_POST['deleteBtn'])) {
    $productDbHandler->deleteProduct($_POST['id']);
}

$title = '';
$description = '';
$price = '';
$error = '';
$msg = '';
$id = $_GET["id"];

if (isset($_POST['send'])) {
    $title = trim($_POST['title']);
    $description = trim(substr(($_POST['description']), 0, 10));
    $price = trim($_POST['price']);

    if (empty($error)) {
        try {
            $sql= "
                UPDATE products
                SET title = :title, description = :description, price = :price
                WHERE id = :id
                ";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            $stmt->execute();
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
    }
}

$product = $productDbHandler->fetchProductById($id);
?>

<?php include 'layout/header.php'; ?>
<div class="container">
<div class="d-flex flex-column mt-5 ml-5" id="productPage">
    <form action="#" method="POST">
        <div class="d-flex justify-content-center">
            <div class="col-3">
                <img src="admin/<?= $product['img_url'] ?>" style="width:400px;height:auto;">
            </div>
        </div>
        <div class="d-flex flex-column">
            <div class="col">
                <h1><?= htmlentities($product['title']) ?></h1> <br>
                <p><?= htmlentities($product['description']) ?></p>
            </div>
            <div class="col">
                <h3 class="font-weight-bold"><?= htmlentities($product['price']) ?> SEK</h3>
            </div>
        </div>
    </form>
    <div class="d-flex justify-content-center">
        <form action="products.php">
            <input type="submit" class="form-control btn-dark btn text-light mx-auto" value="Back to products">
        </form>
    </div>
</div>
</div>
<?php include 'layout/footer.php'; ?>