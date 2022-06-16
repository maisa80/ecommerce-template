<?php
    require('../src/config.php');
    $pageTitle= 'Products';
    $pageId = 'products';
    // debug($_SESSION['cartItems']);  
    $title       = '';
    $description = '';
    $price       = '';
    $image_url     = '';
    $error       = '';
    $msg         = '';

    if (isset($_POST['add'])) {
        $image_url     = trim($_POST['image_url']);
        $title       = trim($_POST['title']);
        $description = trim(($_POST['description']));
        $price       = trim($_POST['price']);

        if (empty($error)) {
            try {
                $query = "
                INSERT INTO products (title, description, price, image_url)
                VALUES (:title, :description, :price, :image_url);
                ";

                $stmt = $dbconnect->prepare($query);
                $stmt->bindValue(':image_url', $image_url);
                $stmt->bindValue(':title', $title);
                $stmt->bindValue(':description', $description);
                $stmt->bindValue(':price', $price);
                $stmt->execute();
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
            }
        }
    }

    $products = $productDbHandler -> fetchAllProducts();

   
?>

<?php include('layout/header.php'); ?>

<div class="d-flex flex-wrap justify-content-center" id="productPage">
    <?php foreach ($products as $key => $product) { ?>
    <div class="col-xs-12 col-md-4 col-lg-3 mt-5 mx-3 innerProductPage">
        <form action="#" method="GET">
            <input type="hidden" name="id" value="<?=$product['id']?>">
        </form>

        <image class="rounded mx-auto d-block" src="<?=$product['image_url']?>" style="width:300px;height:auto;">
        
            <div class="col-lg-9 mx-auto mt-4">
                <h5 class="m-0"><?=substr(htmlentities($product['title']), 0, 20)?></h5> <br>

                <?=substr(htmlentities($product['description']), 0, 30)?> <br>

                <h6 class="mb-4 align-self-end"><?=htmlentities($product['price'])?> SEK</h6>
            </div>

            <form action="view.php" method="GET" class="col-lg-9 mx-auto">
                <input type="hidden" name="id" value="<?=$product['id']?>">
                <input type="submit" class="form-control" value="Read more">
            </form>

            <form action="add-cart-item.php" method="POST" class="col-lg-9 mx-auto">
                <input type="hidden" name="productId" value="<?=$product['id']?>">
                <input type="number" name="quantity" class="form-control" value="1" min="0">
                <div>
                    <input type="submit" name="addToCart" class="form-control" id="addBtn" value="Add to cart">
                </div>
            </form>
    </div>
    <?php } ?>
</div>

<?php include('layout/footer.php'); ?>