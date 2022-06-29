<?php
    require('../src/config.php');
    $pageTitle= 'Sign up';
    $pageId = 'sign up';
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
            $error .= "<li>The username is mandatory</li><br>";
        }
        if (empty($first_name)) {
            $error .= "<li>The first name is mandatory</li><br>";
        }

        if (empty($last_name)) {
            $error .= "<li>The last name is mandatory</li><br>";
        }

        if (empty($email)) {
            $error .= "<li>The e-mail address is mandatory</li><br>";
        }

        if (empty($password)) {
            $error .= "<li>The password is mandatory</li><br>";
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

        if (!empty($password) && strlen($password) < 6) {
            $error .= "<li>The password cant be less than 6 characters</li><br>";
        }

        if ($confirmPassword !== $password) {
            $error .= "<li>The confirmed password doesnt match</li><br>";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= "<li>Unvalid e-mail address</li><br>";
        }

        if ($error) {
            $msg = "<div class='alert alert-danger alert-dismissible d-flex align-items-center fade show'>
            <i class='bi-check-circle-fill'></i><ul>{$error}</ul>
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
        }

        if (empty($error)) {
            $userData = [
                'username'      => $username,
                'password'      => $password,
                'email'         => $email,
                'phone'         => $phone,
                'street'        => $street,
                'postal_code'   => $postal_code,
                'city'          => $city,
                'country'       => $country,
                'first_name'    => $first_name,
                'last_name'     => $last_name,
                
            ];

            $result = ($userData);
            if ($error) {
                $msg .= '<div class="alert alert-danger" role="alert">Failed to create an account. Please try again.</div>';
            } else {
                try {
                    $userDbHandler->addUser($username,$first_name, $last_name, $email, $password, $phone, 
                $street, $postal_code, $city, $country);
                $msg = '<div class="alert alert-success" role="alert">The account was successfully created</div>';
                } catch (\PDOException $e) {
                    if ((int) $e->getCode() === 23000) {
                        $msg = "<div class='alert alert-danger alert-dismissible d-flex align-items-center fade show'>
                        <i class='bi-check-circle-fill'></i>This email is already registerd. Please choose another email address!
                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
                       
                    } else {
                        throw new \PDOException($e->getMessage(), (int) $e->getCode());
                    }
                }
                
                
            }
            
        }
    }

?>

<?php include('layout/header.php'); ?>
<div class="container">
    <div class="row">
        <?=$msg?>
    </div>
    <h2 class="text-center">Register</h2>
    <div class="d-flex justify-content-center mt-5">
        <table class="table-light card p-5 rounded border-0 shadow">
            <form method="POST" action="#">
                <tr>
                    <td>
                        <label for="input1">Username:</label>
                        <input type="text" class="text form-control" name="username"
                            value="<?=htmlentities($username)?>">
                    </td>
                    <td>
                        <label for="input2">E-mail address:</label>
                        <input type="text" class="text form-control" name="email" value="<?=htmlentities($email)?>">
                    </td>

                </tr>
                <tr>
                    <td>
                        <label for="input3">Password:</label>
                        <input type="password" class="text form-control" name="password">
                    </td>

                    <td>
                        <label for="input4">Confirm Password:</label>
                        <input type="password" class="text form-control" name="confirmPassword">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="input5">First name:</label>
                        <input type="text" class="text form-control" name="first_name"
                            value="<?=htmlentities($first_name)?>">
                    </td>
                    <td>
                        <label for="input6">Last name:</label>
                        <input type="text" class="text form-control" name="last_name"
                            value="<?=htmlentities($last_name)?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="input7">Phone:</label>
                        <input type="text" class="text form-control" name="phone" value="<?=htmlentities($phone)?>">
                    </td>
                    <td>
                        <label for="input8">Street:</label>
                        <input type="text" class="text form-control" name="street" value="<?=htmlentities($street)?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="input9">City</label>
                        <input type="text" class="text form-control" name="city" value="<?=htmlentities($city)?>">
                    </td>

                    <td>
                        <label for="input7">Postal code</label>
                        <input type="text" class="text form-control" name="postal_code"
                            value="<?=htmlentities($postal_code)?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="country">Country</label>
                        <input type="text" class="text form-control" name="country" value="<?=htmlentities($country)?>">
                    </td>
                </tr>
                <br>
                <tr>
                    <td>
                        <input type="submit" name="createUserBtn" value="Create"
                            class="btn btn-dark text-light mt-4 d-block">
                    </td>
                <tr>
        </table>
        </form>
    </div>
</div>

<?php include('layout/footer.php'); ?>