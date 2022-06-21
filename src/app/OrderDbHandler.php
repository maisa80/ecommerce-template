<?php

class OrderDbHandler
{
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Fetch all users and returns the value
    public function fetchAllOrders()
    {
        $sql = "SELECT * FROM orders;";
        $stmt = $this->pdo->query($sql);
        
        return $stmt->fetchAll();
    }

    // Add an order 
    public function addOrder(
        $user_id,
        $total_price,
        $billing_full_name,
        $billing_street,
        $billing_postal_code,
        $billing_city,
        $billing_country

    ) {
        $sql = "
            INSERT INTO orders (user_id, total_price, billing_full_name, billing_street, billing_postal_code, billing_city, billing_country)
            VALUES (:user_id,:total_price,:billing_full_name, :billing_street, :billing_postal_code, :billing_city, :billing_country);
        ";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindParam(':total_price', $total_price );
        $stmt->bindValue(':billing_full_name', $billing_full_name);
        $stmt->bindValue(':billing_street', $billing_street);
        $stmt->bindValue(':billing_postal_code', $billing_postal_code);
        $stmt->bindValue(':billing_city', $billing_city);
        $stmt->bindValue(':billing_country', $billing_country);
        $stmt->execute();
       
    }
    // Add order items
    public function addOrder_items(
        $order_id,
        $product_id,
        $product_title,
        $quantity,
        $unit_price

    ){

        $sql = "
        INSERT INTO order_items (order_id, product_id, product_title, quantity, unit_price)
        VALUES (:order_id,:product_id,:product_title,:quantity, :unit_price);
    ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':order_id', $order_id);
            $stmt->bindParam(':product_id', $product_id );
            $stmt->bindValue(':product_title', $product_title);
            $stmt->bindValue(':quantity', $quantity);
            $stmt->bindValue(':unit_price', $unit_price);
            $stmt->execute();
    }
   // Fetch order by user id
   public function fetchOrdersByUserId($id) {
    $sql = "
    SELECT o.user_id, u.id, o.id, o.total_price, o.create_date
     FROM users as u inner join orders as o ON u.id = o.user_id 
        WHERE u.id = :id
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return $stmt->fetchAll();
}
  // Fetch order by orders id user id
   public function fetchOrdersByOrderId($id) {
    $sql = "
    SELECT u.id, o.user_id, o.id, o.total_price, o.create_date, i.product_title, i.order_id, i.quantity, i.unit_price
    FROM users as u INNER JOIN orders as o inner JOIN order_items as i ON u.id= o.user_id AND i.order_id=o.id
     WHERE  u.id =:id AND o.id=i.order_id
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return $stmt->fetchAll();
}
}
