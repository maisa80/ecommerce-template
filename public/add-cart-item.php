<?php
require('../src/config.php');
$pageTitle = 'Cart';
$pageId = 'cart';
debug($_POST);

echo"<pre>";
print_r($_POST);
echo"<pre>";

if (!empty($_POST['stock'])) {
    $articleId = (int) $_POST['articleId'];
    $stock = (int) $_POST['stock'];

    try {
        $sql = "
                SELECT * FROM products
                WHERE id = :id;
                ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $articleId);
        $stmt->execute();
        $article = $stmt->fetch();
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }

    if ($article) {
        $article = array_merge($article, ['stock' => $stock]);
        echo "<pre>";
        print_r($article);
        echo "<pre>";

        $articleItem = [$articleId => $article];
    }

    if (empty($_SESSION['items'])) {
        $_SESSION['items'] = $articleItem;
    } else {
        if (isset($_SESSION['items'][$articleId])) {
            $_SESSION['items'][$articleId]['stock'] += $stock;
        } else {
            $_SESSION['items'] += $articleItem;
        }
    }
}

header('Location: products.php');
// header('Location:'. $_SERVER['HTTP_REFERER']);

exit;
