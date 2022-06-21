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
  
    $userDbHandler->addUser($username, $first_name, $last_name, $email,
     $password, $phone, $street, $postal_code, $city, $country);
        
        $userId = $pdo->lastInsertId();
        
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

 
    echo "UserId";
    debug($userId);
    echo "OrderId";
    debug($orderId);

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
