<?php
    require('../src/config.php');
    $pageTitle= 'Cart';
    $pageId = 'cart';
    // debug($_POST);
    


    if(!empty($_POST['quantity'])) {
        $productId = (int) $_POST['productId'];
        $quantity = (int) $_POST['quantity'];
       
        try{
            $sql = "
                SELECT * FROM products
                WHERE id = :id;
                ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $productId);
            $stmt->execute();
            $product = $stmt->fetch();
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
        
        if ($product) {
            $product = array_merge($product, ['quantity' => $quantity]);
             echo"<pre>";
             print_r($product);
             echo"<pre>";
        
            $cartItem = [$productId => $product];

             // debug($cartItem);
        }

        if (empty($_SESSION['cartItems'])) {
            $_SESSION['cartItems'] = $cartItem;
        } else {
            if (isset($_SESSION['cartItems'][$productId])) {
                $_SESSION['cartItems'][$productId]['quantity'] += $quantity;
            } else {
                $_SESSION['cartItems'] += $cartItem;
            }
            // debug($_SESSION['cartItems']);
           
        }
    }
    header('Location:'. $_SERVER['HTTP_REFERER']);
    // header('Location: products.php');
    exit;
?>