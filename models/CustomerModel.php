<?php
require_once 'BaseModel.php';

class CustomerModel extends BaseModel {
    
    public function createCustomer($data) {
        $sql = "INSERT INTO Customers (full_name, phone_number, email, address, gender, date_of_birth) 
                VALUES (:full_name, :phone_number, :email, :address, :gender, :date_of_birth)";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute($data)) {
            return $this->conn->lastInsertId();
        }
        return false;
    }
    
    public function getCustomerById($id) {
        $sql = "SELECT * FROM Customers WHERE customer_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function getCustomerByEmail($email) {
        $sql = "SELECT * FROM Customers WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function getAllCustomers($limit = null, $offset = 0) {
        $sql = "SELECT * FROM Customers ORDER BY created_at DESC";
        if ($limit) {
            $sql .= " LIMIT :limit OFFSET :offset";
        }
        $stmt = $this->conn->prepare($sql);
        if ($limit) {
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function updateCustomer($id, $data) {
        $sql = "UPDATE Customers SET 
                full_name = :full_name,
                phone_number = :phone_number,
                email = :email,
                address = :address,
                gender = :gender,
                date_of_birth = :date_of_birth
                WHERE customer_id = :id";
        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }
    
    public function deleteCustomer($id) {
        $sql = "DELETE FROM Customers WHERE customer_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>

