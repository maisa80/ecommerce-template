<?php
    require('../../src/config.php');
    $pageTitle= 'Create User';
    $pageId = 'create';
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

    if (isset($_POST['createUserBtn'])) {
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
            $error .= "<li>The username is mandatory</li>";
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
                'password'      => $password,
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
                    $userDbHandler->addUser($username, $first_name, $last_name, $email, $password, $phone, 
                $street, $postal_code, $city, $country);
                $msg =  '<div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
                <i class="bi-check-circle-fill"></i>
                <strong class="mx-2">Success!</strong> The user was successfully created.
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
                $msg = '<div class="alert alert-danger" role="alert">Failed to create a user. Please try again.</div>';
            }
        }
    }

?>

<?php include('layout/header.php'); ?>
<div id="content">

    <?=$msg?>


    <table class="table">
        <form method="POST" action="#">
            <tr>
                <td>
                    <input type="text" placeholder="First name" class="text form-control" name="first_name"
                        value="<?=htmlentities($first_name)?>">
                </td>
                <td>

                    <input type="text" placeholder="Last name" class="text form-control" name="last_name"
                        value="<?=htmlentities($last_name)?>">
                </td>
            </tr>
            <tr>
                <td>

                    <input type="text" class="text form-control" placeholder="Username" name="username"
                        value="<?=htmlentities($username)?>">
                </td>
                <td>

                    <input type="text" class="text form-control" placeholder="email" name="email"
                        value="<?=htmlentities($email)?>">
                </td>

            </tr>
            <tr>
                <td>

                    <input type="password" placeholder="Password" class="text form-control" name="password">
                </td>

                <td>

                    <input type="text" placeholder="Phone" class="text form-control" name="phone"
                        value="<?=htmlentities($phone)?>">
                </td>
            </tr>

            <tr>

                <td>

                    <input type="text" placeholder="Street" class="text form-control" name="street"
                        value="<?=htmlentities($street)?>">
                </td>
                <td>

                    <input type="text" placeholder="Postal code" class="text form-control" name="postal_code"
                        value="<?=htmlentities($postal_code)?>">
                </td>
            </tr>
            <tr>
                <td>

                    <input type="text" placeholder="City" class="text form-control" name="city"
                        value="<?=htmlentities($city)?>">
                </td>
                <td>

                    <input type="text" placeholder="Country" class="text form-control" name="country"
                        value="<?=htmlentities($country)?>">
                    <!-- <select id="country" name="country" class="form-control">   
                        <option value="sweden">Sweden</option>                        
                        <option value="denmark">Denmark</option>
                        <option value="finland">Finland</option>
                        <option value="norway">Norway</option>                            
                    </select> -->
                </td>

            </tr>

            <br>
            <tr>
                <td>
                    <input type="submit" name="createUserBtn" value="Create" class="btn btn-warning">
                </td>
            <tr>
    </table>
    </form>
    <a href="users.php"><i class="fas fa-angle-left"></i> Back</a>
</div>


<?php include('layout/footer.php'); ?>