<?php
    if(!isset($_SESSION['cartItems'])){
        $_SESSION['cartItems'] = [];
    }

    $cartItemCount = count($_SESSION['cartItems']);
    $cartTotalSum = 0;

    foreach($_SESSION['cartItems'] as $cartId => $cartItem){
    $cartTotalSum += $cartItem['price'] *  $cartItem['quantity'];
        // $cartItemCount +=$cartItem['quantity'];
    }
?>

<div class="container text-end">
    <a href="products.php" data-toggle="dropdown" role="button" aria-expanded="false">
        <button type="button" class="btn dropdown-toggle cartBtn" data-toggle="dropdown-toggle">
            <span><span class="badge bg-dark"><?=$cartItemCount?></span>
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> View Cart</span>
        </button>
    </a>

    <!-- Dropdown Menu -->
    <div class="dropdown-menu">
        <div class="shopping-cart">
            <div class="shopping-cart-header">
                <i class="fa fa-shopping-cart cart-icon"></i><span class="badge"><?=$cartItemCount?></span>
                <span class="badge"> total: <?=$cartTotalSum?> kr</span>
            </div>

            <div class="d-flex flex-column">
                <div class="col ">
                    <?php foreach($_SESSION['cartItems'] as $cartId => $cartItem):?>
                    <div class="row cart-detail">
                        <div class="col">
                            <img class="rounded mx-auto d-block" src="<?=$cartItem['image_url']?>"
                                style="width:50px;height:50px;">
                        </div>
                        <div class="col-4">
                            <?=$cartItem['title']?>
                        </div>
                        <div class="col">
                            <span class="text-warning"><?=$cartItem['price']?> kr</span>
                        </div>
                        <div class="col">
                            <span class="count">total: <?=$cartItem['quantity']?></span>
                        </div>
                    </div>

                    <?php endforeach; ?>
                    <div class="manage">
                        <form action="checkout.php" method="POST">
                            <a href="checkout.php" class="button">Checkout</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>