<?php
    require('../src/config.php');
    $pageTitle= 'My pages';
    $pageId = 'my pages';
    checkLoginSession();
    // debug($_POST);
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

        if (empty($username)) {
            $error .= "<div class='alert alert-danger' role='alert'>The username is mandatory</div>";
        }

        if (empty($first_name)) {
            $error .= "<div class='alert alert-danger' role='alert'>The first name is mandatory</div>";
        }

        if (empty($last_name)) {
            $error .= "<div class='alert alert-danger' role='alert'>The last name is mandatory</div>";
        }

        if (empty($email)) {
            $error .= "<div class='alert alert-danger' role='alert'>The e-mail address is mandatory</div>";
        }

        

        if (empty($phone)) {
            $error .= "<div class='alert alert-danger' role='alert'>The phone is mandatory</div>";
        }

        if (empty($street)) {
            $error .= "<div class='alert alert-danger' role='alert'>The street is mandatory</div>";
        }

        if (empty($postal_code)) {
            $error .= "<div class='alert alert-danger' role='alert'>The postal code is mandatory</div>";
        }

        if (empty($city)) {
            $error .= "<div class='alert alert-danger' role='alert'>The city is mandatory</div>";
        }

        if (empty($country)) {
            $error .= "<div class='alert alert-danger' role='alert'>The country is mandatory</div>";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= "<div class='alert alert-danger' role='alert'>Unvalid e-mail address</div>";
        }

        if ($error) {
            $msg .= "<div class='error_msg'>{$error}</div><div class='alert alert-danger' role='alert'>Failed to update the user. Please try again.</div>";
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
                $msg .= '<div class="alert alert-danger" role="alert">Failed to update the user. Please try again.</div>';
            }
        }
    }
    // if (isset($_POST['updateUserPasswordBtn'])) {
    //     $password        = trim($_POST['password']);
    //     $confirmPassword = trim($_POST['confirmPassword']);
    //     if (empty($password)) {
    //         $error .= "<li>The password is mandatory</li>";
    //     }
    //     if (empty($confirmPassword)) {
    //         $error .= "<li>The confirmPassword is mandatory</li>";
    //     }
    //     if ($password !== $confirmPassword) {
    //         $error .= '
    //             <div class="error_msg">
    //                 Confirmed password incorrect!
    //             </div>
    //         ';
    //     } else {
    //         $userDbHandler->changeUserPassword($_GET['userId'], $password);
    //     }

    //     if ($error) {
    //         $msg = "<ul class='error_msg'>{$error}</ul>";
    //     }

    //     if (empty($error)) {
    //         $userData = [
    //             'password'           => $password,
    //             'confirmPassword'    => $confirmPassword
              
    //         ];

    //         $result = ($userData);

    //         if ($result) {
    //             $userDbHandler->changeUserPassword(
    //                 $_GET['userId'],
    //                 $password,
                    
    //             );
    //             $msg = '   
    //             <div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
    //               <i class="bi-check-circle-fill"></i>
    //               <strong class="mx-2">Success!</strong> Your password was successfully updated.
    //               <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    //             </div>
    //           ';
    //         } else {
    //             $msg = '<div class="alert alert-danger" role="alert">Failed to update the password. Please try again.</div>';
    //         }
    //     }
    // }
    /**
     * Fetch user by Id
     */
    $userById = $userDbHandler->fetchUserById($_GET['userId']);
    
?>

<?php include('layout/header.php'); ?>

<div class="container emp-profile">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog"
                        alt="" />
                    <div class="file btn btn-lg btn-primary">
                        Change Photo
                        <input type="file" name="file" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5>
                        <?=htmlentities(ucfirst($userById['first_name']))?>
                        <?=htmlentities(ucfirst($userById['last_name']))?>
                    </h5>
                    <p class='logInBtn'>Regsitered <?=htmlentities($userById['create_date'])?></p>
                </div>
            </div>
            <div class="col-md-2">
                <button class='btn logInBtn' type="button" data-bs-toggle="collapse" data-bs-target="#collapseProfile"
                    aria-expanded="false" aria-controls="collapseProfile">
                    <i class="fas fa-user-edit"></i> Edit Profile
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="profile-work">

                    <a href="">My orders</a><br />

                </div>
            </div>
            <div class="col-md-4">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                            </div>
                            <div class="col-md-6">
                                <p><?=htmlentities($userById['email']) ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Phone</label>
                            </div>
                            <div class="col-md-6">
                                <p><?=htmlentities($userById['phone']) ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Postal Code</label>
                            </div>
                            <div class="col-md-6">
                                <p><?=htmlentities($userById['postal_code']) ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Street</label>
                            </div>
                            <div class="col-md-6">
                                <p><?=htmlentities($userById['street']) ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>City</label>
                            </div>
                            <div class="col-md-6">
                                <p><?=htmlentities($userById['city']) ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Country</label>
                            </div>
                            <div class="col-md-6">
                                <p><?=htmlentities($userById['country']) ?></p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
</div>
</form>
</div>





<div class="collapse" id="collapseProfile">

    <div class="d-flex justify-content-center bg-dark text-light py-5">
        <form action="" method="POST">
            <?=$msg ?>
            <div class="col-md-12">
                <label for="input1">Username</label>
                <input class="text" type="text" name="username" value="<?=htmlentities($userById['username'])?>">
            </div>
            <div class="col-md-12">
                <label for="input3">First name</label> <br>
                <input type="text" class="text" name="first_name" value="<?=htmlentities($userById['first_name'])?>">
            </div>
            <div class="col-md-12">
                <label for="input4">Last name</label> <br>
                <input type="text" class="text" name="last_name" value="<?=htmlentities($userById['last_name'])?>">
            </div>

            <div class="col-md-12">
                <label for="input1">E-mail address</label> <br>
                <input type="text" class="text" name="email" value="<?=htmlentities($userById['email'])?>">
            </div>
            <div class="col-md-12">
                <label for="input1">Phone</label> <br>
                <input type="text" class="text" name="phone" value="<?=htmlentities($userById['phone'])?>">
            </div>
            <div class="col-md-12">
                <label for="input6">Street</label> <br>
                <input type="text" class="text" name="street" value="<?=htmlentities($userById['street'])?>">
            </div>

            <div class="col-md-12">
                <label for="input7">City</label> <br>
                <input type="text" class="text" name="city" value="<?=htmlentities($userById['city'])?>">
            </div>
            <div class="col-md-12">
                <label for="input8">Postal code</label> <br>
                <input type="text" class="text" name="postal_code" value="<?=htmlentities($userById['postal_code'])?>">
            </div>
            <div class="col-md-12">
                <label for="input9">Country</label> <br>
                <input type="text" class="text" name="country" value="<?=htmlentities($userById['country'])?>">
            </div>

            <div class="d-flex justify-content-center">

                <div class="col text-center">
                    <input type="submit" class="btn btn-secondary" name="updateUserBtn" value="Update">
                </div>



            </div>

        </form>
    </div>
</div>
<!-- <div class="collapse" id="collapsePassword">

    <div class="d-flex justify-content-center bg-dark text-light py-5">
        <form action="" method="POST">
            

            <div class="col-md-12">
                <label for="input10">Password</label>
                <input type="password" class="form-control" name="password">

            </div>
            <div class="col-md-12">
                <label for="input11">Confirm password</label>
                <input type="password" class="text" name="confirmPassword">
            </div>


            <div class="d-flex justify-content-center">

                <div class="col text-center">
                    <input type="submit" class="btn btn-secondary" name="updateUserPasswordBtn" value="Update Password">
                </div>


            </div>

        </form>
    </div>
</div> -->
<?php include('layout/footer.php'); ?>