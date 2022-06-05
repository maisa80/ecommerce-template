<?php
      require('../../src/config.php');
    $pageTitle = "Users";
    $pageId    = "users";
    // checkLoginSession();

   
?>
 <?php include('layout/header.php'); ?> 

 

  <main class="main">
    <div class="main-header">
      <div class="main-header__heading"><h2><i class="fas fa-user-cog"></i> Hello Admin</h2></div>
      <!-- <div class="main-header__updates">Recent Items</div> -->
    </div>

    <div class="main-overview">
      <div class="overviewcard">
        <div class="overviewcard__icon"><i class="fas fa-users"></i></div>
        <div class="overviewcard__info"><a href="users.php">Users</a></div>
      </div>
      <div class="overviewcard">
        <div class="overviewcard__icon"><i class="fas fa-baby"></i></div>
        <div class="overviewcard__info">Products</div>
      </div>
      <div class="overviewcard">
        <div class="overviewcard__icon"><i class="fas fa-cart-arrow-down"></i></div>
        <div class="overviewcard__info">Orders</div>
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

