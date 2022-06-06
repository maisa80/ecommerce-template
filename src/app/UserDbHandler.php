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
            SELECT id, first_name, last_name, password FROM users
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
            UPDATE users
            SET first_name = :first_name, last_name= :last_name, email = :email, 
            phone = :phone, street = :street, postal_code= :postal_code, city = :city, country = :country   
            WHERE id = :id
        ";

       
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
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

    /*------------------------------------------------------------*/
    // Används på view.php

    public function deleteProduct()
    {

        if (empty($title)) {
            try {
                $query = "
                DELETE FROM products
                WHERE id = :id;
                ";
        
                $stmt = $dbconnect->prepare($query);
                $stmt->bindValue(':id', $_POST['id']);
                $stmt->execute();
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
            }
        }
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
