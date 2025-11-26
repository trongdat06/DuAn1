<?php
require_once 'BaseModel.php';

class ProductModel extends BaseModel {
    
    public function getAllProducts($limit = null, $offset = 0) {
        $sql = "SELECT p.*, c.category_name, s.supplier_name 
                FROM Products p 
                LEFT JOIN Categories c ON p.category_id = c.category_id 
                LEFT JOIN Suppliers s ON p.supplier_id = s.supplier_id 
                ORDER BY p.created_at DESC";
        
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
    
    public function getProductById($id) {
        $sql = "SELECT p.*, c.category_name, s.supplier_name 
                FROM Products p 
                LEFT JOIN Categories c ON p.category_id = c.category_id 
                LEFT JOIN Suppliers s ON p.supplier_id = s.supplier_id 
                WHERE p.product_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function getProductVariants($productId) {
        $sql = "SELECT * FROM Product_Variants WHERE product_id = :product_id AND stock_quantity > 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getVariantById($variantId) {
        $sql = "SELECT pv.*, p.product_name, p.brand, p.description 
                FROM Product_Variants pv 
                JOIN Products p ON pv.product_id = p.product_id 
                WHERE pv.variant_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $variantId);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function searchProducts($keyword) {
        $sql = "SELECT DISTINCT p.*, c.category_name 
                FROM Products p 
                LEFT JOIN Categories c ON p.category_id = c.category_id 
                WHERE p.product_name LIKE :keyword 
                   OR p.brand LIKE :keyword 
                   OR p.description LIKE :keyword
                ORDER BY p.product_name";
        $stmt = $this->conn->prepare($sql);
        $keyword = "%$keyword%";
        $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getProductsByCategory($categoryId) {
        $sql = "SELECT p.*, c.category_name 
                FROM Products p 
                LEFT JOIN Categories c ON p.category_id = c.category_id 
                WHERE p.category_id = :category_id 
                ORDER BY p.product_name";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':category_id', $categoryId);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getAllCategories() {
        $sql = "SELECT * FROM Categories ORDER BY category_name";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getFeaturedProducts($limit = 8) {
        $sql = "SELECT p.*, pv.variant_id, pv.price, pv.color, pv.storage, 
                       MIN(pv.price) as min_price,
                       c.category_name
                FROM Products p 
                INNER JOIN Product_Variants pv ON p.product_id = pv.product_id 
                LEFT JOIN Categories c ON p.category_id = c.category_id 
                WHERE pv.stock_quantity > 0
                GROUP BY p.product_id 
                ORDER BY p.created_at DESC 
                LIMIT :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getBestSellingProducts($limit = 8) {
        $sql = "SELECT p.*, pv.variant_id, pv.price, pv.color, pv.storage,
                       MIN(pv.price) as min_price,
                       COUNT(od.order_detail_id) as total_sold,
                       c.category_name
                FROM Products p 
                INNER JOIN Product_Variants pv ON p.product_id = pv.product_id 
                LEFT JOIN Order_Details od ON pv.variant_id = od.variant_id
                LEFT JOIN Categories c ON p.category_id = c.category_id 
                WHERE pv.stock_quantity >= 0
                GROUP BY p.product_id 
                ORDER BY total_sold DESC, p.created_at DESC 
                LIMIT :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    // Admin functions
    public function createProduct($data) {
        $sql = "INSERT INTO Products (product_name, brand, description, category_id, supplier_id) 
                VALUES (:product_name, :brand, :description, :category_id, :supplier_id)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }
    
    public function updateProduct($id, $data) {
        $sql = "UPDATE Products SET 
                product_name = :product_name,
                brand = :brand,
                description = :description,
                category_id = :category_id,
                supplier_id = :supplier_id
                WHERE product_id = :id";
        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }
    
    public function deleteProduct($id) {
        $sql = "DELETE FROM Products WHERE product_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
    public function createVariant($data) {
        $sql = "INSERT INTO Product_Variants 
                (product_id, variant_name, color, storage, price, stock_quantity, warranty_months) 
                VALUES (:product_id, :variant_name, :color, :storage, :price, :stock_quantity, :warranty_months)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }
    
    public function updateVariant($id, $data) {
        $sql = "UPDATE Product_Variants SET 
                variant_name = :variant_name,
                color = :color,
                storage = :storage,
                price = :price,
                stock_quantity = :stock_quantity,
                warranty_months = :warranty_months
                WHERE variant_id = :id";
        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }
    
    public function deleteVariant($id) {
        $sql = "DELETE FROM Product_Variants WHERE variant_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>

