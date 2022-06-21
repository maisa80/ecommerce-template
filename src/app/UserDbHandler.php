<?php

class UserDbHandler
{
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Fetch all users and returns the value
    public function fetchAllUsers()
    {
       
        $sql = "SELECT * FROM users;";
        $stmt = $this->pdo->query($sql);
        
        return $stmt->fetchAll();
    }
 
    public function deleteUser()
    {
        $sql = "
            DELETE FROM users 
            WHERE id = :id;
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $_POST['userId']);
        $stmt->execute();
    }
    
    public function fetchUserByEmail($email)
    {
        $sql = "
            SELECT * FROM users
            WHERE email = :email
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function addUser(
        $username,
        $first_name,
        $last_name,
        $email,
        $password,
        $phone,
        $street,
        $postal_code,
        $city,
        $country
    ) {
        $sql = "
            INSERT INTO users (username, first_name, last_name, email, password, phone, street, postal_code, city, country)
            VALUES (:username,:first_name, :last_name, :email, :password, :phone, :street, :postal_code, :city, :country);
        ";

        $encryptedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
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

    public function updateUser(
        $id,
        $username,
        $first_name,
        $last_name,
        $email,
        $phone,
        $street,
        $postal_code,
        $city,
        $country
    ) {
        $sql = "
            UPDATE users
            SET username=:username, first_name = :first_name, last_name= :last_name, email = :email, 
            phone = :phone, street = :street, postal_code= :postal_code, city = :city,
            country = :country  
            WHERE id = :id
        ";

       
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':postal_code', $postal_code);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':country', $country);
        $stmt->execute();
    }
    public function changeUserPassword(
        $id,
        $password
    ) {
        $sql = "
            UPDATE users
            SET password=:password
            WHERE id = :id
        ";

        $encryptedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':password', $encryptedPassword);
        $stmt->execute();
    }
    public function changeUserImage(
        $id,
        $img_url
    ) {
        $sql = "
            UPDATE users
            SET img_url=:img_url
            WHERE id = :id
        ";

    
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':img_url', $img_url);
        $stmt->execute();
    }


    public function fetchUserById($id) {
        $sql = "
            SELECT * FROM users
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }
}
