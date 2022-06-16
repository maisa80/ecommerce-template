<?php
    require('../src/config.php');
    debug($_POST);
    
    if(isset($_POST['cartId']) 
    && !empty($_POST['quantity'])
    && isset($_SESSION['cartItems'][$_POST['cartId']])
    ){
        $_SESSION['cartItems'][$_POST['cartId']]['quantity'] = $_POST['quantity'];
    }
    header('Location:'. $_SERVER['HTTP_REFERER']);

    exit;
?>
