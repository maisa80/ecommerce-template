<?php

    require('../src/dbconnect.php');
    require('../src/config.php');

    if (isset($_POST['deleteProductBtn'])) {
        $productDbHandler->deleteProduct();
    }
    
    $products = $productDbHandler -> deleteProduct();

    $data = [

        'products' => $products, 
        'pageTitle' => 'Manage Products',
        'pageId' => 'manage-products'

        
    ];

    echo json_encode($data);
