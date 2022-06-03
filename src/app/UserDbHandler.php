<?php

class UserDbHandler 
{
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Fetch all users and returns the value
    public function fetchAllUsers() {
        $sql = "SELECT * FROM users;";
        $stmt = $this->pdo->query($sql);
        
        return $stmt->fetchAll();
    }

    public function deleteUser () {
        $sql = "
            DELETE FROM users 
            WHERE id = :id;
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $_POST['userId']);
        $stmt->execute();
    }

    
    public function fetchUserByEmail($email) {
        $sql = "
            SELECT id, first_name, last_name, password FROM users
            WHERE email = :email
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function addUser($first_name, $last_name, $email, $password, $phone, 
            $street, $postal_code, $city, $country) {
        $sql = "
            INSERT INTO users (first_name, last_name, email, password, phone, street, postal_code, city, country)
            VALUES (:first_name, :last_name, :email, :password, :phone, :street, :postal_code, :city, :country);
        ";

        $encryptedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $encryptedPassword);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':postal_code', $postal_code);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':country', $country);
        $stmt->execute();
    }

    public function updateUser($id, $first_name, $last_name, $email, $password, $phone, 
    $street, $postal_code, $city, $country) {
        $sql = "
            UPDATE users
            SET first_name = :first_name, last_name= :last_name, email = :email, password = :password
            phone = :phone, street = :street, postal_code= :postal_code, city = :city, country = :country   
            WHERE id = :id
        ";

        $encryptedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $encryptedPassword);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':postal_code', $postal_code);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':country', $country);
        $stmt->execute();
    }
}