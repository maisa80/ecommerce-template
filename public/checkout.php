<?php
    require('../src/config.php');
    $pageTitle= 'Checkout';
    $pageId = 'checkout';
    $msg='';
   if(isset($_SESSION['errorMessages'])){
        $msg=$_SESSION['errorMessages'];
        unset($_SESSION['errorMessages']);
   }
   
   
        
   
    // checkLoginSession(); //refakturerad

    try {
        $user = $userDbHandler->fetchUserById($_SESSION['id']);

    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
     
  

?>

<?php include('layout/header.php'); ?>
<div class="container">
    <h2>Checkout</h2>
    <div class="d-flex justify-content-center ">
        <?=$msg?>
</div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th style="width: 5%">Image</th>
                <th style="width: 15%">Title</th>
                <th style="width: 10%"></th>
                <th style="width: 5%">Quantity</th>
                <th class="text-center" style="width: 15%">Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($_SESSION['cartItems'] as $cartId => $cartItem):?>
            <tr>
                <td><img src="<?=$cartItem['image_url']?>" style="width:60px;height:auto;"></td>
                <td><?=$cartItem['title']?></td>
                <td>
                    <form action="delete-cart-item.php" method="POST">
                        <input type="hidden" name="cartId" value="<?=$cartId?>">
                        <button type="submit" class="btn">
                            <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                <path fill-rule="evenodd"
                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                            </svg>
                        </button>
                    </form>
                </td>
                <td>
                    <form class="update-cart-form" action="update-cart-item.php" method="POST">
                        <input type="hidden" name="cartId" value="<?=$cartId?>">
                        <input type="number" class="form-control" id="quantity" name="quantity"
                            value="<?=$cartItem['quantity']?>" min="0">
                    </form>
                </td>
                <td class="text-center"><b><?=$cartItem['price']?> kr</b></td>
            </tr>
            <?php endforeach; ?>


            <tr class="border-top">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-center"><b>Total: <?=$cartTotalSum?> SEK</b></td>
            </tr>
        </tbody>
    </table>
    <br>
    <h3>Billing Address</h3>
    <div class="container">
        
        <form action="create-order.php" method="POST">
            <input type="hidden" name="cartTotalSum" value="<?=$cartTotalSum?>">
    
            <div class="row">
                <div class="col-4">
                    <label for="inputFirstName">First name</label>
                    <input type="text" class="form-control" name="first_name" id="inputFirstName"
                        value="<?= htmlentities($user['first_name']) ?>">
                </div>
                <div class="col-4">
                    <label for="inputLastName">Last name</label>
                    <input type="text" class="form-control" name="last_name" id="inputLastName"
                        value="<?= htmlentities($user['last_name'])?>">
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <label for="inputUsername">Username</label>
                    <input type="text" class="form-control" id="inputUsername" name="username"
                        value="<?= htmlentities($user['username']) ?>">
                </div>
                <div class="col-4">
                    <label for="inputPassword">Password</label>
                    <input type="password" class="form-control" id="inputPassword" name="password"
                        value="<?= htmlentities($user['password'])?>">
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <label for="inputEmail">Email</label>
                    <input type="text" class="form-control" id="inputEmail" name="email"
                        value="<?= htmlentities($user['email']) ?>">
                </div>
                <div class="col-4">
                    <label for="inputPhone">Phone</label>
                    <input type="text" class="form-control" id="inputPhone" name="phone"
                        value="<?= htmlentities($user['phone'])?>">
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <label for="inputAddress">Address</label>
                    <input type="text" class="form-control" id="inputAddress" name="street"
                        value="<?= htmlentities($user['street']) ?>">
                </div>
                <div class="col-4">
                    <label for="inputZipcode">Zip code</label>
                    <input type="text" class="form-control" name="postal_code" id="inputZipcode"
                        value="<?= htmlentities($user['postal_code']) ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" name="city" id="inputCity"
                    value="<?= htmlentities($user['city'])?>">
            </div>
            <div class="col-4">
                <label for="inputCountry">Country</label>
                <input type="text" class="form-control" name="country" id="inputCountry"
                    value="<?= htmlentities($user['country'])?>">
                    </div>
            </div>
            <!-- <div class="form-group col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Check if you agree terms
                        </label>
                    </div>
                </div> -->
            <div class=" col-4">
                <input type="submit" class="btn btn-dark text-light" name="createOrderBtn" value="Order now">
            </div>
    </div>


    </form>
</div>
</div>
<?php include('layout/footer.php'); ?>