<?php

class OrdeDbHandler
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

   
  
}
