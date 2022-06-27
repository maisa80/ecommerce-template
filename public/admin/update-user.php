<?php
    require('../../src/config.php');
    $pageTitle = "Update user";
    $pageId    = "update-users"; 
    // Some simple checks to ensure that we are sending a valid userID, to work with.
    // Should really go further and check if the user exists in DB, before allowing to update 
    if (!isset($_GET['userId']) || !is_numeric($_GET['userId'])) {
        redirect('users.php?invalidUser');
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
            $error .= "<li>The fusername is mandatory</li>";
        }
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
            $msg = "<div class='alert alert-danger alert-dismissible d-flex align-items-center fade show'>
            <i class='bi-check-circle-fill'></i><ul>{$error}</ul>
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
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
                      <strong class="mx-2">Success!</strong> The user was successfully updated.
                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                  ';
                } catch (\PDOException $e) {
                    if ((int) $e->getCode() === 23000) {
                        $msg = "
                        '<div class='alert alert-danger alert-dismissible d-flex align-items-center fade show'>
                        <i class='bi-check-circle-fill'></i>
                        <strong class='mx-2'></strong> This email is already registerd. Please choose another email address!
                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                      </div>
                        ";
                    } else {
                        throw new \PDOException($e->getMessage(), (int) $e->getCode());
                    }
                }
            } else {
                $msg = '<div class="alert alert-danger" role="alert">Failed to update the user. Please try again.</div>';
            }
        }
    }
    /**
     * Fetch user by Id
     */
    $userById = $userDbHandler->fetchUserById($_GET['userId']);
    
?>

<?php include('layout/header.php'); ?>
<div id="content">
    <h4>Update user</h4>
    <?=$msg?>


    <table class="table">
        <form method="POST" action="#">
            <tr>
                <td>
                    <label for="input1">Username:</label><br>
                    <input type="text" class="text form-control" name="username"
                        value="<?=htmlentities($userById['username']) ?>">
                </td>
                <td>
                    <label for="input2">E-mail address:</label><br>
                    <input type="text" class="text form-control" name="email"
                        value="<?=htmlentities($userById['email']) ?>">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="input5">First name:</label><br>
                    <input type="text" class="text form-control" name="first_name"
                        value="<?=htmlentities($userById['first_name']) ?>">
                </td>
                <td>
                    <label for="input6">Last name:</label><br>
                    <input type="text" class="text form-control" name="last_name"
                        value="<?=htmlentities($userById['last_name']) ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="input7">Phone:</label><br>
                    <input type="text" class="text form-control" name="phone"
                        value="<?=htmlentities($userById['phone']) ?>">
                </td>
                <td>
                    <label for="input8">Street:</label><br>
                    <input type="text" class="text form-control" name="street"
                        value="<?=htmlentities($userById['street']) ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="input9">City</label><br>
                    <input type="text" class="text form-control" name="city"
                        value="<?=htmlentities($userById['city']) ?>">
                </td>

                <td>
                    <label for="input7">Postal code</label><br>
                    <input type="text" class="text form-control" name="postal_code"
                        value="<?=htmlentities($userById['postal_code']) ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="country">Country</label><br>
                    <input type="text" class="text form-control" name="country"
                        value="<?=htmlentities($userById['country']) ?>">
                    <!-- <select id="country" name="country" class="form-control">   
                        <option value="sweden">Sweden</option>                        
                        <option value="denmark">Denmark</option>
                        <option value="finland">Finland</option>
                        <option value="norway">Norway</option>                            
                    </select> -->
                </td>
            </tr>

            <tr>
                <td id="user">
                    <input type="submit" name="updateUserBtn" value="Update"
                        class="btn btn-dark text-light mt-4 d-block">
                </td>
            <tr>
        </form>
    </table>

    <a href="users.php"><i class="fas fa-angle-left"></i> Back</a>

</div>
<?php include('layout/footer.php'); ?>