 <?php
    require('../src/config.php');
    require('../src/dbconnect.php');
    
    checkLoginSession(); //refakturerad

    try {
        $query = "
            SELECT * FROM users
            WHERE id = :id;
        ";
        
        $stmt = $dbconnect->prepare($query);
        $stmt->bindValue(':id', $_SESSION['id']);
        $stmt->execute();
        $user = $stmt->fetch();
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
     
    $msg = '';

?>

<?php include('layout/header.php'); ?>

<table class="table table-borderless">
    <thead>
        <tr>
            <th style="width: 15%">Article</th>
            <th style="width: 50%">Description</th>
            <th style="width: 10%"></th>
            <th style="width: 15%">Quantity</th>
            <th style="width: 15%">Price</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($_SESSION['items'] as $articleId => $articleItem) {?>
            <tr>
                <td><img src="img/<?=$articleItem['img_url']?>" style="width:50px;height:auto;"></td>
                <td><?=$articleItem['description']?></td>
                <td>
                    <form action="delete-cart-item.php" method="POST">
                        <input type="hidden" name="articleId" value="<?=$articleId?>" >
                        <button type="submit" name="deleteBtn" id="deleteButton" class="btn delete-pun-btn">
                            <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </button>
                    </form>
                </td>
                <td>
                    <form class="update-cart-form" action="update-cart-item.php" method="POST">
                        <input type="hidden" name="articleId" value="<?=$articleId?>">
                        <input type="number" class="form-control" name="quantity" value="<?=$articleItem['quantity']?>" min="0">
                    </form>
                </td>
                <td><?=$articleItem['price']?> SEK</td>
            </tr>
        <?php } ?>
        

        <tr class="border-top">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><b>Total: <?=$articleTotalSum?> SEK</b></td>
        </tr>
    </tbody>
</table>

<form action="create-order.php" method="POST" class="mx-5">
    <input type="hidden" name="totalPrice" value="<?=$articleTotalSum?>">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputFirstName">First name</label>
                <input type="text" class="form-control" name="firstName" id="inputFirstName" <?= !empty($user) ? 'readonly' : '' ?> value="<?= isset($user['first_name']) ? htmlentities($user['first_name']) : ''?>">
            </div>
            <div class="form-group col-md-6">
                <label for="inputLastName">Last name</label>
                <input type="text" class="form-control" name="lastName" id="inputLastName"<?= !empty($user) ? 'readonly' : '' ?> value="<?= isset($user['last_name']) ? htmlentities($user['last_name']) : ''?>">
            </div>
        </div>
         <div class="form-group">
            <label for="inputUsername">Username</label>
            <input type="text" class="form-control" id="inputUsername" name="username" <?= !empty($user) ? 'readonly' : '' ?> value="<?= isset($user['username']) ? htmlentities($user['username']) : ''?>">
        </div> 
         <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" class="form-control" id="inputPassword" name="password" <?= !empty($user) ? 'readonly' : '' ?> value="<?= isset($user['password']) ? htmlentities($user['password']) : ''?>"> 
        </div>
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="text" class="form-control" id="inputEmail" name="email" <?= !empty($user) ? 'readonly' : '' ?> value="<?= isset($user['email']) ? htmlentities($user['email']) : ''?>">
        </div>
        <div class="form-group">
            <label for="inputPhone">Phone</label>
            <input type="text" class="form-control" id="inputPhone" name="phone" <?= !empty($user) ? 'readonly' : '' ?> value="<?= isset($user['phone']) ? htmlentities($user['phone']) : ''?>">
        </div>
        <div class="form-group">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" id="inputAddress" name="street" <?= !empty($user) ? 'readonly' : '' ?> value="<?= isset($user['street']) ? htmlentities($user['street']) : ''?>">
        </div>
        <div class="form-group col-md-2">
                <label for="inputZipcode">Zip code</label>
                <input type="text" class="form-control" name="postalCode" id="inputZipcode"<?= !empty($user) ? 'readonly' : '' ?> value="<?= isset($user['postal_code']) ? htmlentities($user['postal_code']) : ''?>">
        </div>
        <div class="form-group">
            <label for="inputCity">City</label>
            <input type="text" class="form-control" name="city" id="inputCity" <?= !empty($user) ? 'readonly' : '' ?> value="<?= isset($user['city']) ? htmlentities($user['city']) : ''?>">
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">               
                <label for="inputCountry">Country</label>
            </div>
        </div>
        
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                    Check if you agree terms
                </label>
            </div>
        </div>
    <input type="submit" class="btn btn-dark text-light" name="createOrderBtn" value="Order now">
</form>

<?php include('layout/footer.php'); ?>