<?php
    require '../src/config.php';
    $pageTitle = 'Products';
    $pageId = 'products';
    // debug($_SESSION['cartItems']);

    $products = $productDbHandler->fetchAllProducts();
?>

<?php include 'layout/header.php';?>
<div class="container">
    <div class="d-flex flex-wrap justify-content-center" id="productPage">
        <?php foreach ($products as $key => $article) {?>
        <div class="col-xs-12 col-md-4 col-lg-3 mt-5 mx-3 innerProductPage">
            <form action="#" method="GET">
                <input type="hidden" name="id" value="<?=$article['id']?>">
            </form>

            <image class="rounded mx-auto d-block" src="<?=$article['img_url']?>" style="width:300px;height:auto;">

                <div class="text-center mx-auto mt-4">
                    <h5 class="m-0"><?=substr(htmlentities($article['title']), 0, 20)?></h5> <br>

                    <?=substr(htmlentities($article['description']), 0, 30)?> <br>

                    <h6 class="mb-6 text-center"><?=htmlentities($article['price'])?> kr</h6>
                </div>

                <form action="view.php" method="GET" class="col-lg-9 mx-auto">
                    <input type="hidden" name="id" value="<?=$article['id']?>">
                    <input type="submit" class="read-more" value="Read more">
                </form>

                <form action="add-cart-item.php" method="POST" class="col-lg-9 mx-auto">
                    <input type="hidden" name="productId" value="<?=$article['id']?>">
                    <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="0">
                    <div>
                        <input type="submit" name="addToCart" class="btn shopBtn" id="addBtn" value="Add to cart">
                    </div>
                </form>
        </div>
        <?php }?>
    </div>
</div>

<?php include 'layout/footer.php';?>