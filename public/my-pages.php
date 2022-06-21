<?php
    require '../src/config.php';
    $pageTitle = 'My pages';
    $pageId = 'my pages';

    checkLoginSession();
    // debug($_POST);
    // debug($_FILES['uploadedFile']);

    if (!isset($_GET['userId']) || !is_numeric($_GET['userId'])) {
        redirect('my-pages.php?invalidUser');
    }
    $imgUrl = "";
    $error = "";
    $messages = "";
    if (isset($_POST['uploadBtn'])) {
        if (is_uploaded_file($_FILES['uploadedFile']['tmp_name'])) {
            // Get the file name and size
            $fileName = $_FILES['uploadedFile']['name'];
            $fileType = $_FILES['uploadedFile']['type'];
            $fileTempPath = $_FILES['uploadedFile']['tmp_name'];
            $path = "img/";
            // Check if the file is an image
            $newFilePath = $path . $fileName;

            /** File type error handling **/
            $allowedFileTypes = [
                'image/png',
                'image/jpeg',
                'image/gif',
            ];

            $isFileTypeAllowed = array_search($fileType, $allowedFileTypes, true);
            if ($isFileTypeAllowed === false) {
                $error .= "The file type is invalid. Allowed types are jpeg, png, gif. <br>";
            }

            /** File size error handling **/
            if ($_FILES['uploadedFile']['size'] > 1000000) { // Allows only files under 1 mbyte
                $error .= 'Exceeded filesize limit.<br>';
            }

            if (empty($error)) {
                $isTheFileUploaded = move_uploaded_file($fileTempPath, $newFilePath);

                if ($isTheFileUploaded) {
                    // Success the file is uploaded
                    $imgUrl = $newFilePath;
                } else {
                    // Could not upload the file
                    $error = "Could not upload the file";
                }
            }
        }
    if (empty($error)) {
        // INSERT INTO/ UPDATE
        $userDbHandler->changeUserImage(
            $_GET['userId'],
            $newFilePath
        );
        $message = '
            <div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
              <i class="bi-check-circle-fill"></i>
              <strong class="mx-2">Success!</strong> Your image was successfully updated.
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>';
    } else {
        $message = $error;
    }
}

    $first_name = '';
    $last_name = '';
    $phone = '';
    $street = '';
    $postal_code = '';
    $city = '';
    $country = '';
    $username = '';
    $email = '';
    $error = '';
    $msg = '';

    if (isset($_POST['updateUserBtn'])) {
    $username = trim($_POST['username']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);
    $phone = trim($_POST['phone']);
    $street = trim($_POST['street']);
    $postal_code = trim($_POST['postal_code']);
    $city = trim($_POST['city']);
    $country = trim($_POST['country']);

    if (empty($username)) {
        $error .= "<li>The username name is mandatory</li><br>";
    }

    if (empty($first_name)) {
        $error .= "<li>The first name is mandatory</li><br>";
    }

    if (empty($last_name)) {
        $error .= "<li>The last name is mandatory</li><br>";
    }

    if (empty($email)) {
        $error .= "<li>The email address is mandatory</li><br>";
    }

    if (empty($phone)) {
        $error .= "<li>The phone is mandatory</li><br>";
    }

    if (empty($street)) {
        $error .= "<li>The street is mandatory</li><br>";
    }

    if (empty($postal_code)) {
        $error .= "<li>The postal code is mandatory</li><br>";
    }

    if (empty($city)) {
        $error .= "<li>The city is mandatory</li><br>";
    }

    if (empty($country)) {
        $error .= "<li>The country is mandatory</li><br>";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error .= "<li>Invalid e-mail address</li><br>";
    }

    if ($error) {
        $msg .= "<div class='alert alert-danger alert-dismissible d-flex align-items-center fade show'>
            <i class='bi-check-circle-fill'></i><ul>{$error}</ul>
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
    }

    if (empty($error)) {
        $userData = [
            'username' => $username,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'street' => $street,
            'postal_code' => $postal_code,
            'city' => $city,
            'country' => $country,
        ];

        $result = ($userData);
        if ($error) {
            $msg = '
                <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
                <i class="bi-check-circle-fill"></i>
                Failed to update the user. Please try again.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                ';
        } else {
            try {
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
                      <strong class="mx-2">Success!</strong> User profile was successfully updated.
                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                  ';
            } catch (\PDOException$e) {
                if ((int) $e->getCode() === 23000) {
                    $msg = "<div class='alert alert-danger alert-dismissible d-flex align-items-center fade show'>
                        <i class='bi-check-circle-fill'></i>This email is already registerd. Please enter another email!
                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
                } else {
                    throw new \PDOException($e->getMessage(), (int) $e->getCode());
                }
            }
        }
    }
}
    if (isset($_POST['updateUserPasswordBtn'])) {
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);
    if (empty($password)) {
        $error .= ' <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
                <i class="bi-check-circle-fill"></i>
                The password is mandatory
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>';
    }

    if (empty($confirmPassword)) {
        $error .= '<div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
            <i class="bi-check-circle-fill"></i>
                The confirmed password is mandatory
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>';
    }

    if (!empty($password) && strlen($password) < 6) {
        $error .= '
            <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
            <i class="bi-check-circle-fill"></i>
                The password cant be less than 6 characters
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>';
    }

    if ($password !== $confirmPassword) {
        $error .= '
            <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
                <i class="bi-check-circle-fill"></i>
                Confirmed password incorrect!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            ';
    } else {
        $userDbHandler->changeUserPassword($_GET['userId'], $password);
    }

    if ($error) {
        $msg .= "<div class='error_msg'>{$error}</div><div class='alert alert-danger' role='alert'>Failed to update the password. Please try again.</div>";
    }

    if (empty($error)) {
        $userData = [
            'password' => $password,
            'confirmPassword' => $confirmPassword,
        ];

        $result = ($userData);

        if ($result) {
            $userDbHandler->changeUserPassword(
                $_GET['userId'],
                $password,
            );
            $msg = '
                <div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
                  <i class="bi-check-circle-fill"></i>
                  <strong class="mx-2">Success!</strong> Your password was successfully updated.
                  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>';
        } else {
            $msg = '<div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
                <i class="bi-check-circle-fill"></i>
                Failed to update the password. Please try again.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>';
        }
    }
}
    if (isset($_POST['updateUserImageBtn'])) {
    $img_url = trim($_POST['img_url']);

    if ($error) {
        $msg .= "<div class='error_msg'>{$error}</div><div class='alert alert-danger' role='alert'>Failed to update the image. Please try again.</div>";
    }

    if (empty($error)) {
        $userData = [
            'img_url' => $img_url,

        ];
        $result = ($userData);

        if ($result) {
            $userDbHandler->changeUserImage(
                $_GET['userId'],
                $img_url,
            );
            $msg = '
                <div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
                  <i class="bi-check-circle-fill"></i>
                  <strong class="mx-2">Success!</strong> Your password was successfully updated.
                  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
              ';
        } else {
            $msg = '<div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
                <i class="bi-check-circle-fill"></i>
                Failed to update the password. Please try again.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>';
        }
    }
}

    if (isset($_POST['deleteUserBtn'])) {
    $userDbHandler->deleteUser();
    session_destroy();
    redirect('login.php');
}

/** Fetch user by Id  **/
$userById = $userDbHandler->fetchUserById($_GET['userId']);

 /** Fetch orders by user Id  **/
 $orders = $orderDbHandler->fetchOrdersByUserId($_GET['userId']);
 
  
/** Fetch orders by user Id  **/

$items = $orderDbHandler->fetchOrdersByOrderId($_GET['userId']);
 debug($items);
?>

<?php include 'layout/header.php';?>
<?=$msg?>
<?=$message?>
<div class="container emp-profile">
    <div class="row">
        <div class="col-md-4">
            <div class="profile-img">
                <?php if ($userById['img_url'] == "") {?>
                <img class="myImg" src="img/default-user.png" alt="<?php echo $userById['username']; ?>">
                <?php } else {?>
                <img class="myImg" src="<?php echo $userById['img_url'] ?>" alt="<?php echo $userById['username']; ?>">
                <?php }?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="profile-head">
                <h5>
                    <?=htmlentities(ucfirst($userById['first_name']))?>
                    <?=htmlentities(ucfirst($userById['last_name']))?>
                </h5>
                <p class='logInBtn'>Regsitered <?=htmlentities($userById['create_date'])?></p>
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Username</label>
                            </div>
                            <div class="col-md-6">
                                <p><?=htmlentities($userById['username'])?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                            </div>
                            <div class="col-md-6">
                                <p><?=htmlentities($userById['email'])?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Phone</label>
                            </div>
                            <div class="col-md-6">
                                <p><?=htmlentities($userById['phone'])?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Postal Code</label>
                            </div>
                            <div class="col-md-6">
                                <p><?=htmlentities($userById['postal_code'])?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Street</label>
                            </div>
                            <div class="col-md-6">
                                <p><?=htmlentities($userById['street'])?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>City</label>
                            </div>
                            <div class="col-md-6">
                                <p><?=htmlentities($userById['city'])?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Country</label>
                            </div>
                            <div class="col-md-6">
                                <p><?=htmlentities($userById['country'])?></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn logInBtn" data-toggle="modal" data-target="#updateUserModal"
                data-id="<?=htmlentities($userById['id'])?>" data-username="<?=htmlentities($userById['username'])?>"
                data-first_name="<?=htmlentities($userById['first_name'])?>"
                data-last_name="<?=htmlentities($userById['last_name'])?>"
                data-email="<?=htmlentities($userById['email'])?>" data-phone="<?=htmlentities($userById['phone'])?>"
                data-postal_code="<?=htmlentities($userById['postal_code'])?>"
                data-street="<?=htmlentities($userById['street'])?>" data-city="<?=htmlentities($userById['city'])?>"
                data-country="<?=htmlentities($userById['country'])?>">
                <i class="fas fa-user-edit"></i> Edit Profile
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="profile-work">
                <button type="button" class="btn logInBtn" data-toggle="modal" data-target="#updateUserPasswordModal"
                    data-id="<?=htmlentities($userById['id'])?>"
                    data-password="<?=htmlentities($userById['password'])?>"
                    data-confirmPassword="<?=htmlentities($userById['confirmPassword'])?>">
                    Change password
                </button>
                <button type="button" class="btn logInBtn" data-toggle="modal" data-target="#updateUserImageModal"
                    data-id="<?=htmlentities($userById['id'])?>" data-img_url="<?=htmlentities($userById['img_url'])?>">
                    Change image
                </button>


                <input type="hidden" name="userId" value="<?=$userById['id']?>">
                <button type="button" class="btn logInBtn" data-toggle="modal" data-target="#deleteUserAccountModal"
                    data-username="<?=htmlentities($userById['username'])?>" data-id="<?=htmlentities($_POST['id'])?>">
                    Delete my account
                </button>
            </div>
        </div>

    </div>
    <div id="accordion">

        <div class="card">
            <div class="card-header">
                <a class="btn logInBtn" data-bs-toggle="collapse" href="#collapseOne">
                    <input type="hidden" name="userId" value="<?=$userById['id']?>">

                    My orders

                </a>
            </div>
            <div id="collapseOne" class="collapse" data-bs-parent="#accordion">
                <div class="card-body">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Total Price</th>
                                <th>Order date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orders as $order) : ?>
                            <tr>
                                <div class="card">
                                    <div class="card-header">
                                        <div id="card-header">
                                            <td><a class="collapsed btn" data-bs-toggle="collapse" 
                                                    href="#collapseTwo">#<?=htmlentities($order['id']) ?> 
                                                    <input type="hidden" name="userId" value="<?=$userById['id']?>"></a>
                                                <?php foreach($items as $item) : ?>
                                                <div id="collapseTwo" class="collapse" data-bs-parent="#card-header">
                                                
                                                    <div class="card-body">
                                                        product_title <?=htmlentities($item['product_title']) ?>
                                                    </div>
                                                </div>

                                        </div>
                                        <?php endforeach; ?>
                                        </td>
                                    </div>
                                    <td><?=htmlentities($order['total_price']) ?> kr</td>
                                    <td><?=htmlentities($order['create_date']) ?></td>


                                </div>



                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>



<!-- Update User Profile Modal -->
<div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update user Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="required">Username</label>
                        <input type="text" class="form-control" name="username">
                        <label class="required">First Name</label>
                        <input type="text" class="form-control" name="first_name">
                        <label class="required">Last Name</label>
                        <input type="text" class="form-control" name="last_name">
                        <label class="required">Email</label>
                        <input type="text" class="form-control" name="email">
                        <label class="required">Phone</label>
                        <input type="text" class="form-control" name="phone">
                        <label class="required">Street</label>
                        <input type="text" class="form-control" name="street">
                        <label class="required">Postal code</label>
                        <input type="text" class="form-control" name="postal_code">
                        <label class="required">City</label>
                        <input type="text" class="form-control" name="city">
                        <label class="required">Country</label>
                        <input type="text" class="form-control" name="country">
                        <input type="hidden" name="id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" name="updateUserBtn" value="Update" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Update User Password Modal -->
<div class="modal fade" id="updateUserPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update user Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="required">Password</label>
                        <input type="password" class="form-control" name="password">
                        <label class="required">Confirm Password</label>
                        <input type="password" class="form-control" name="confirmPassword">
                        <input type="hidden" name="id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" name="updateUserPasswordBtn" value="Update" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Update User Image Modal -->
<div class="modal fade" id="updateUserImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update user Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="file" name="uploadedFile"><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" name="uploadBtn" value="Change image" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete User account Modal -->
<div class="modal fade" id="deleteUserAccountModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserLabel">Delete User Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <p>Are you sure you want to delete your account <?=htmlentities($userById['username'])?>??</p>
                    <input type="hidden" name="userId" value="<?=$userById['id']?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="" method="POST" class="float-end">
                        <input type="submit" name="deleteUserBtn" value="Delete" class="btn btn-danger">
                    </form>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'layout/footer.php';?>