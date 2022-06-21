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
             <span> <span class="badge bg-dark"><?=$cartItemCount?></span><i class="fa fa-shopping-cart"
                     aria-hidden="true"></i> View
                 Cart</span>

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
 <!-- <div class="container">
     <div class="shopping-cart">
         <div class="shopping-cart-header">
             <i class="fa fa-shopping-cart cart-icon"></i><span class="badge">3</span>
             <div class="shopping-cart-total">
                 <span class="lighter-text">Total:</span>
                 <span class="main-color-text">$2,229.97</span>
             </div>
         </div>
         end shopping-cart-header 

         <ul class="shopping-cart-items">
             <li class="clearfix">
                 <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/cart-item1.jpg" alt="item1" />
                 <span class="item-name">Sony DSC-RX100M III</span>
                 <span class="item-price">$849.99</span>
                 <span class="item-quantity">Quantity: 01</span>
             </li>

             <li class="clearfix">
                 <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/cart-item2.jpg" alt="item1" />
                 <span class="item-name">KS Automatic Mechanic...</span>
                 <span class="item-price">$1,249.99</span>
                 <span class="item-quantity">Quantity: 01</span>
             </li>

             <li class="clearfix">
                 <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/cart-item3.jpg" alt="item1" />
                 <span class="item-name">Kindle, 6" Glare-Free To...</span>
                 <span class="item-price">$129.99</span>
                 <span class="item-quantity">Quantity: 01</span>
             </li>
         </ul>

         <a href="#" class="button">Checkout</a>
     </div>
     end shopping-cart
 </div> end container -->