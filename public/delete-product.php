<?php

require '../src/dbconnect.php';
require '../src/config.php';

if (isset($_POST['deleteProductBtn'])) {
    $id = $_POST['id'];
    $productDbHandler->deleteProduct($id);
}

$products = $productDbHandler->fetchAllProducts();

$data = [

  'products' => $products,

];

echo json_encode($data);
