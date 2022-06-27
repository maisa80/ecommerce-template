<?php
    require('../src/config.php');
    // ini_set('display_errors', 1);
    // debug($_POST);
    // debug($_SESSION);

    

if (isset($_POST['createOrderBtn']) && !empty($_SESSION['cartItems'])) {
    $username = trim($_POST['username']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $phone = trim($_POST['phone']);
    $street = trim($_POST['street']);
    $postal_code = trim($_POST['postal_code']);
    $city = trim($_POST['city']);
    $country = trim($_POST['country']);
    $cartTotalSum = $_POST['cartTotalSum'];


    /*Fetch user if exist*/
    $user = $userDbHandler->fetchUserByEmail($email);
    $userId = isset($user['id']) ? $user['id'] : null;

    /*Create user if does not exist*/
    if(empty($user)){
        if (empty($first_name)) {
            $error .= "<li>The first name is mandatory</li><br>";
        }
    
        if (empty($last_name)) {
            $error .= "<li>The last name is mandatory</li><br>";
        }
        if (empty($username)) {
            $error .= "<li>The user name is mandatory</li><br>";
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
    
    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= "<li>Unvalid e-mail address</li><br>";
        }
    
        if ($error) {
            $msg = "<div class='alert alert-danger alert-dismissible d-flex align-items-center fade show'>
            <i class='bi-check-circle-fill'></i><ul>{$error}</ul>
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button></div><br>";
            $msg .= '<br><div class="alert alert-danger" role="alert">Please try again.</div>';
           
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
                
            } else {
                try {
                    $userDbHandler->addUser($username, $first_name, $last_name, $email,
                    $password, $phone, $street, $postal_code, $city, $country);
                       
                       $userId = $pdo->lastInsertId();
                                        /*Create order*/
                        $fullName =  $first_name . " ". $last_name;
                        
                        $orderDbHandler->addOrder(
                            $userId,
                            $cartTotalSum,
                            $fullName,
                            $street,
                            $postal_code,
                            $city,
                            $country
                        );
                        $orderId = $pdo->lastInsertId();
  
                        // echo "UserId";
                        // debug($userId);
                        // echo "OrderId";
                        // debug($orderId);
     
                        /*Create order items*/
     
                        foreach ($_SESSION['cartItems'] as $item) {
                            $orderDbHandler->addOrder_items(
                                $orderId,
                                $item['id'],
                                $item['title'],
                                $item['quantity'],
                                $item['price']
                            );
            }
            header('location: order-confirmation.php');
            exit;
 
                } catch (\PDOException $e) {
                   
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
        $_SESSION['errorMessages'] = $msg;
        debug($_SESSION['errorMessages']);
        header('location: checkout.php');
        exit;
        
    }
   
   
   
  /*Create order*/
  $fullName =  $first_name . " ". $last_name;
    
  $orderDbHandler->addOrder(
      $userId,
      $cartTotalSum,
      $fullName,
      $street,
      $postal_code,
      $city,
      $country
  );
  $orderId = $pdo->lastInsertId();

  // echo "UserId";
  // debug($userId);
  // echo "OrderId";
  // debug($orderId);
  
  /*Create order items*/
  
  foreach ($_SESSION['cartItems'] as $item) {
      $orderDbHandler->addOrder_items(
          $orderId,
          $item['id'],
          $item['title'],
          $item['quantity'],
          $item['price']
      );
  }
  header('location: order-confirmation.php');
  exit;


}

header('location: checkout.php');
exit;


