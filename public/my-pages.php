<?php
    require('../src/config.php');
    $pageTitle= 'My pages';
    $pageId = 'my pages';
    checkLoginSession();
    if (!isset($_GET['userId']) || !is_numeric($_GET['userId'])) {
        redirect('my-pages.php?invalidUser');
    }
    // debug($_POST);

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

    if (isset($_POST['updateUserBtn'])) {
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

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= "<li>Unvalid e-mail address</li>";
        }

        if ($error) {
            $msg = "<ul class='error_msg'>{$error}</ul>";
        }

        if (empty($error)) {
            $userData = [
                'username'      => $username,
                'first_name'    => $first_name,
                'last_name'     => $last_name,
                'email'         => $email,
                'phone'         => $phone,
                'street'        => $street,
                'postal_code'   => $postal_code,
                'city'          => $city,
                'country'       => $country,
              
            ];

            $result = ($userData);

            if ($result) {
                $userDbHandler->updateUser(
                    $_GET['userId'],
                    $username,
                    $first_name,
                    $last_name,
                    $email,
                    $phone,
                    $street,
                    $postal_code,
                    $city,
                    $country
                );
                $msg = '   
                <div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
                  <i class="bi-check-circle-fill"></i>
                  <strong class="mx-2">Success!</strong> The user was successfully updated.
                  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
              ';
            } else {
                $msg = '<div class="alert alert-danger" role="alert">Failed to update the user. Please try again.</div>';
            }
        }
    }
    /**
     * Fetch user by Id
     */
    $user = $userDbHandler->fetchUserById($_GET['userId']);
    
?>

<?php include('layout/header.php'); ?>

    
<h2 class="text-center">User Profile</h2>
    <div class="container emp-profile">
    
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="file"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                    <?=htmlentities(ucfirst($user['first_name']))?> <?=htmlentities(ucfirst($user['last_name']))?>
                                    </h5>
                                    
                                    <div class="col-md-6">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                       
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?=htmlentities($user['username']) ?></p>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?=htmlentities($user['email']) ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?=htmlentities($user['phone']) ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Postal Code</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?=htmlentities($user['postal_code']) ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Street</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?=htmlentities($user['street']) ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>City</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?=htmlentities($user['city']) ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Country</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?=htmlentities($user['country']) ?></p>
                                            </div>
                                        </div>
                            </div>
                          
                        </div>
                    </div>
                          
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
                    </div>
                </div>
              
                   
                </div>
            </form>           
        </div>
    <div class="d-flex justify-content-center bg-dark text-light py-5">
        <form action="" method="POST">      
        <?=$message ?> 
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="input1">Username:</label> <br>
                        <input type="text" class="text" name="username" value="<?=htmlentities($user['username'])?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input1">E-mail address:</label> <br>
                        <input type="texter" class="texter" name="email" value="<?=htmlentities($user['email'])?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="input1">Password:</label> <br>
                        <input type="password" class="text" name="password" value="<?=htmlentities($user['password'])?>"
                        >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input2">Confirm password:</label> <br>
                        <input type="password" class="text" name="confirmPassword" value="<?=htmlentities($user['password'])?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="input3">First name:</label> <br>
                        <input type="text" class="text" name="first_name" value="<?=htmlentities($user['first_name'])?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input4">Last name:</label> <br>
                    <input type="text" class="text" name="last_name" value="<?=htmlentities($user['last_name'])?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="input6">Street:</label> <br>
                    <input type="text" class="text" name="street" value="<?=htmlentities($user['street'])?>"> 
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="input7">City</label> <br>
                        <input type="text" class="text" name="city" value="<?=htmlentities($user['city'])?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input8">Postal code</label> <br>
                        <input type="text" class="text" name="postal_code" value="<?=htmlentities($user['postal_code'])?>">
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
                        <input type="text" class="text" name="phone" value="<?=htmlentities($user['phone'])?>">
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