<?php    
    require('../src/config.php');
    


if (isset($_POST['createOrderBtn'])) {
    $firstName 		= trim($_POST['firstName']);
    $lastName 		= trim($_POST['lastName']);
    $username 		= trim($_POST['username']);
    $email 	   		= trim($_POST['email']);
    $password 		= trim($_POST['password']);
    $phone 			= trim($_POST['phone']);
    $street 		= trim($_POST['street']);
    $city 			= trim($_POST['city']);
    $postalCode 	= trim($_POST['postalCode']);
    $country 		= trim($_POST['country']);
    $totalPrice 	= trim($_POST['totalPrice']);
    
    // Check if user already exist in our DB
    try {
        $sql= "
			SELECT * FROM users
			WHERE email = :email
		";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
    
    if ($user) {
        $userId = $user['id'];
    } else {
        try {
            $sql = "
	            INSERT INTO users (first_name, last_name, username, email, password, phone, street, postal_code, city, country)
	            VALUES (:firstName, :lastName, :username, :email, :password, :phone, :street, :postalCode, :city, :country);
	        ";
            
            $stmt = $pdo ->prepare($sql);
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':street', $street);
            $stmt->bindParam(':postalCode', $postalCode);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':country', $country);
            $stmt->execute();
            $userId = $pdo->lastInsertId();
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
    }

    // Create order
    try {
        $sql = "
			INSERT INTO orders (user_id, total_price, billing_full_name, billing_street, billing_postal_code, billing_city, billing_country)
			VALUES (:userId, :totalPrice, :fullName, :street, :postalCode, :city, :country);
		";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':totalPrice', $totalPrice);
        $stmt->bindParam(':fullName', "{$firstName} {$lastName}");
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':postalCode', $postalCode);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':country', $country);
        $stmt->execute();
        $orderId = $pdo->lastInsertId();
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }

    // Create order_items
    foreach ($_SESSION['items'] as $articleId => $articleItem) {
        try {
            $sql= "
				INSERT INTO order_items (order_id, product_id, stock, unit_price, product_title)
				VALUES (:orderId, :productId, :stock, :price, :title);
			";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':orderId', $orderId);
            $stmt->bindParam(':productId', $articleItem['id']);
            $stmt->bindParam(':stock', $articleItem['stock']);
            $stmt->bindParam(':price', $articleItem['price']);
            $stmt->bindParam(':title', $articleItem['title']);
            $stmt->execute();
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
    }
    
    header('Location: order-confirmation.php');
    exit;
}

header('Location: checkout.php');
exit;
