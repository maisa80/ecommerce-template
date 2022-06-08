<?php
    require('../src/config.php');
    $pageTitle= 'Cart';
    $pageId = 'cart';

    // echo"<pre>";
    // print_r($_POST);
    // echo"<pre>";
    
    if(!empty($_POST['quantity'])) {
        $articleId = (int) $_POST['articleId'];
        $quantity = (int) $_POST['quantity'];
       
        try{
            $query = "
                SELECT * FROM products
                WHERE id = :id;
                ";
            $stmt = $dbconnect->prepare($query);
            $stmt->bindValue(':id', $articleId);
            $stmt->execute();
            $article = $stmt->fetch();
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
        
        if ($article) {
            $article = array_merge($article, ['quantity' => $quantity]);
             echo"<pre>";
             print_r($article);
             echo"<pre>";
        
            $articleItem = [$articleId => $article];
        }

        if (empty($_SESSION['items'])) {
            $_SESSION['items'] = $articleItem;
        } else {
            if (isset($_SESSION['items'][$articleId])) {
                $_SESSION['items'][$articleId]['quantity'] += $quantity;
            } else {
                $_SESSION['items'] += $articleItem;
            }
        }
    }

    header('Location: products.php');
    exit;
?>