<?php
    require('../src/config.php');
    checkLoginSession();
  

    $message = "";

    // if (isset($_POST['deleteBtn'])) {
    //     if (empty($title)) {
    //         try {
    //             $query = "
    //                 DELETE FROM users
    //                 WHERE id = :id;
    //             ";
    
    //             $stmt = $dbconnect->prepare($query);
    //             $stmt->bindValue(':id', $_POST['id']);
    //             $stmt->execute();
    //         } catch (\PDOException $e) {
    //             throw new \PDOException($e->getMessage(), (int) $e->getCode());
    //         }
    //     }
    // }
    
    $first_name  = '';
    $last_name   = '';
    $phone       = '';
    $street      = '';
    $postal_code = '';
    $city        = '';
    $country     = '';
    $username    = '';
    $email       = '';
    $error       = '';
    $msg         = '';
    
    if (isset($_POST['signup'])) {
        $username          = trim($_POST['username']);
        $first_name        = trim($_POST['first_name']);
        $last_name         = trim($_POST['last_name']);
        $email             = trim($_POST['email']);
        $password          = trim($_POST['password']);
        $confirmPassword   = trim($_POST['confirmPassword']);
        $phone             = trim($_POST['phone']);
        $street            = trim($_POST['street']);
        $postal_code       = trim($_POST['postal_code']);
        $city              = trim($_POST['city']);
        $country           = trim($_POST['country']);

        if (empty($first_name)) {
            $error .= "<li>The first name is mandatory</li>";
        }

        if (empty($last_name)) {
            $error .= "<li>The last name is mandatory</li>";
        }

        if (empty($email)) {
            $error .= "<li>The e-mail address is mandatory</li>";
        }

        if (empty($password)) {
            $error .= "<li>The password is mandatory</li>";
        }

        if (empty($phone)) {
            $error .= "<li>The phone is mandatory</li>";
        }

        if (empty($street)) {
            $error .= "<li>The street is mandatory</li>";
        }

        if (empty($postal_code)) {
            $error .= "<li>The postal code is mandatory</li>";
        }

        if (empty($city)) {
            $error .= "<li>The city is mandatory</li>";
        }

        if (empty($country)) {
            $error .= "<li>The country is mandatory</li>";
        }

        if (!empty($password) && strlen($password) < 6) {
            $error .= "<li>The password cant be less than 6 characters</li>";
        }

        if ($confirmPassword !== $password) {
            $error .= "<li>The confirmed password doesnt match</li>";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= "<li>Unvalid e-mail address</li>";
        }

        if ($error) {
            $msg = "<ul class='error_msg'>{$error}</ul>";
        }

        try {
            $sql = "
                UPDATE users
                SET username = :username, password = :password, email = :email, phone = :phone, street = :street, postal_code = :postal_code, city = :city, country = :country, first_name = :first_name, last_name = :last_name 
                WHERE id = :id
            ";
            $encryptedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $encryptedPassword);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':street', $street);
            $stmt->bindParam(':postal_code', $postal_code);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':country', $country);
            $stmt->execute();
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
        if ($result) {
            $msg = '<div class="alert alert-success text-center">User updated</div>';
        }
    }
    
    $users =  $userDbHandler->fetchUserByEmail($_GET['email']);    

?>

<?php include('layout/header.php'); ?>

    <h1 class="text-center">Edit info</h1>

    <div class="d-flex justify-content-center bg-dark text-light py-5">
        <form action="" method="POST">      
        <?=$message ?> 
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="input1">Username:</label> <br>
                        <input type="text" class="text" name="username" value="<?=htmlentities($users['username'])?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input1">E-mail address:</label> <br>
                        <input type="texter" class="texter" name="email" value="<?=htmlentities($users['email'])?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="input1">Password:</label> <br>
                        <input type="password" class="text" name="password" value="<?=htmlentities($users['password'])?>"
                        >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input2">Confirm password:</label> <br>
                        <input type="password" class="text" name="confirmPassword" value="<?=htmlentities($users['password'])?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="input3">First name:</label> <br>
                        <input type="text" class="text" name="first_name" value="<?=htmlentities($users['first_name'])?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input4">Last name:</label> <br>
                    <input type="text" class="text" name="last_name" value="<?=htmlentities($users['last_name'])?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="input6">Street:</label> <br>
                    <input type="text" class="text" name="street" value="<?=htmlentities($users['street'])?>"> 
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="input7">City</label> <br>
                        <input type="text" class="text" name="city" value="<?=htmlentities($users['city'])?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input8">Postal code</label> <br>
                        <input type="text" class="text" name="postal_code" value="<?=htmlentities($users['postal_code'])?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <?php
                        $countries = [];
                        ?>
                        <label for="country">Country</label>
                        <select id="country" name="country">
                            <?php foreach ($countries as $countryKey => $countryName) { ?> 
                               <?php if ($users['country'] == $countryKey) { ?>
                                    <option selected value="<?=$countryKey?>"> <?=$countryName?></option> 
                               <?php } else { ?>
                                    <option value="<?=$countryKey?>"> <?=$countryName?></option>
                             <?php   } ?>
                            <?php }  ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input5">Phone:</label> <br>
                        <input type="text" class="text" name="phone" value="<?=htmlentities($users['phone'])?>">
                    </div>
                </div>
                
                <div class="d-flex justify-content-center">

                    <div class="col text-center">
                        <input type="submit" name="signup" value="Uppdatera">
                    </div>
                    
                   
                    </div>
                </div>
            </form>
        </form>
    </div>
<?php include('layout/footer.php'); ?>