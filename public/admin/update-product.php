<?php
require('../../src/dbconnect.php');
require('../../src/config.php');

$title       = '';
$description = '';
$price       = '';
$error       = '';
$msg         = '';

if (isset($_POST['updateProductBtn'])) {
  $title       = trim($_POST['title']);
  $description = trim($_POST['description']);
  $price       = trim($_POST['price']);

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
    $query = "
                UPDATE products
                SET title = :title, description = :description, price = :price
                WHERE id = :id;
            ";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':title', $title);
    $stmt->bindValue(':description', $description);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':id', $_POST['id']);
    $products = $stmt->execute();
  } catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
  }
  if ($products) {
    $msg = '<div class="success">Your product is now updated.</div>';
  }
}

$products = $productDbHandler->fetchAllProducts();


$data = [

  'products' => $products,

];
echo json_encode($data);
