<?php

class ProductDbHandler 
{
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Fetch all products and returns the value
    public function fetchAllProducts() {
        $sql = "SELECT * FROM products;";
        $stmt = $this->pdo->query($sql);
        
        return $stmt->fetchAll();
    }

    public function deleteProduct () {
        $sql = "
            DELETE FROM products 
            WHERE id = :id;
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $_POST['productId']);
        $stmt->execute();
    }

    

    public function addProduct($title, $description, $price, $stock, $img_url) {
        $sql = "
            INSERT INTO products (title, description, price, stock, img_url)
            VALUES (:title, :description, :price, :stock, :img_url);
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':img_url', $img_url);
        $stmt->execute();
    }

    public function updateProduct($title, $description, $price, $stock, $img_url) {
        $sql = "
            UPDATE products
            SET title = :title, description= :description, price = :price, stock = :stock, img_url = :img_url  
            WHERE id = :id
        ";

       
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $_POST['productId']);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':img_url', $img_url);
        $stmt->execute();
    }


    /*------------------------------------------------------------*/
    // Används på view.php

    public function fetchProductById($id)
    {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
   
}