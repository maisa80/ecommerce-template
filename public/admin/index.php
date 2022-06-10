<?php
    require('../../src/config.php');
    $pageTitle = "Dashboard";
    $pageId    = "dashboard";
   
    
    $users = $userDbHandler->fetchAllUsers();
    $products = $productDbHandler->fetchAllProducts();
?>
<?php include('layout/header.php'); ?>


<main class="main">
    <div class="main-header">
        <div class="main-header__heading">
            <h2><i class="fas fa-user-cog"></i> Hello Admin</h2>
        </div>
        <!-- <div class="main-header__updates">Recent Items</div> -->
    </div>

    <div class="main-overview">
        <div class="overviewcard">
            <div class="overviewcard__icon"><i class="fas fa-users"></i></div>
            <div class="overviewcard__info">
                <h2><a href="users.php">Users </a></h2>
            </div>
            <h3>( <?=count($users); ?> )</h3>
        </div>
        <div class="overviewcard">
            <div class="overviewcard__icon"><i class="fas fa-baby"></i></div>
            <div class="overviewcard__info">
                <h2><a href="products.php">Products</a></h2>
            </div>
            <h3>( <?=count($products);?> )</h3>
        </div>
        <div class="overviewcard">
            <div class="overviewcard__icon"><i class="fas fa-cart-arrow-down"></i></div>
            <div class="overviewcard__info">
                <h2><a href="orders.php">Orders</a></h2>
            </div>
            <h3>
                <?echo "(0)" ?>
            </h3>
        </div>
        <!-- <div class="overviewcard">
        <div class="overviewcard__icon">Overview</div>
        <div class="overviewcard__info">Card</div>
      </div> -->
    </div>

    <div class="main-cards">
        <div class="card">Card</div>
        <div class="card">Card</div>
        <div class="card">Card</div>
    </div>
</main>



<?php include('layout/footer.php'); ?>