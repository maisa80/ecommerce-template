<?php
require '../../src/config.php';

$title = '';
$description = '';
$price = '';
$error = '';
$msg = '';

if (isset($_POST['updateProductBtn'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);

    if (empty($title)) {
        $error .= "<div>Title is mandatory</div>";
    }

    if (empty($description)) {
        $error .= "<div>Description is mandatory</div>";
    }

    if (empty($price)) {
        $error .= "<div>Price is mandatory</div>";
    }

    if ($error) {
        $msg = "<div class='errors'>{$error}</div>";
    }

    try {
        $sql = "
    UPDATE products
    SET title = :title, description = :description, price = :price
    WHERE id = :id;
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':id', $_POST['id']);
        $products = $stmt->execute();
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
    if ($products) {
        $msg = '<div class="success">Your product is now updated.</div>';
    }
}

$products = $productDbHandler-> fetchAllProducts();


$data = [

  'products' =>  $products,  // pass all products to the view
  'pageTitle' => 'Manage Products',
  'pageId' => 'manage-products',

];
echo json_encode($data);
