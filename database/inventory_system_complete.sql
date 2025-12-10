-- Database schema và dữ liệu mẫu cho hệ thống quản lý bán điện thoại
-- Gộp từ phone_schema.sql và sample_data.sql
-- Date: 2024-11-17

CREATE DATABASE IF NOT EXISTS inventory_system;
USE inventory_system;

-- ============================================
-- PHẦN 1: TẠO CẤU TRÚC BẢNG
-- ============================================

-- 1. Managers
CREATE TABLE Managers (
  manager_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  full_name VARCHAR(100),
  phone_number VARCHAR(15),
  email VARCHAR(100),
  role VARCHAR(50),
  status VARCHAR(50),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE Manager_Logs (
  log_id INT AUTO_INCREMENT PRIMARY KEY,
  manager_id INT NOT NULL,
  action_type VARCHAR(50),
  description TEXT,
  action_time DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (manager_id) REFERENCES Managers(manager_id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 2. Employees & Roles
CREATE TABLE Employees (
  employee_id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(100),
  position VARCHAR(50),
  phone_number VARCHAR(15),
  email VARCHAR(100),
  address VARCHAR(255),
  hire_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  salary DECIMAL(12,2),
  manager_id INT,
  FOREIGN KEY (manager_id) REFERENCES Managers(manager_id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE Roles (
  role_id INT AUTO_INCREMENT PRIMARY KEY,
  role_name VARCHAR(50) UNIQUE,
  description TEXT
) ENGINE=InnoDB;

CREATE TABLE Employee_Roles (
  employee_id INT NOT NULL,
  role_id INT NOT NULL,
  assigned_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (employee_id, role_id),
  FOREIGN KEY (employee_id) REFERENCES Employees(employee_id) ON DELETE CASCADE,
  FOREIGN KEY (role_id) REFERENCES Roles(role_id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 3. Categories, Suppliers, Products, Product_Variants
CREATE TABLE Categories (
  category_id INT AUTO_INCREMENT PRIMARY KEY,
  category_name VARCHAR(100),
  description TEXT
) ENGINE=InnoDB;

CREATE TABLE Suppliers (
  supplier_id INT AUTO_INCREMENT PRIMARY KEY,
  supplier_name VARCHAR(100),
  phone_number VARCHAR(15),
  email VARCHAR(100),
  address VARCHAR(255),
  description TEXT
) ENGINE=InnoDB;

CREATE TABLE Products (
  product_id INT AUTO_INCREMENT PRIMARY KEY,
  product_name VARCHAR(100) NOT NULL,
  brand VARCHAR(50),
  description TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  category_id INT,
  supplier_id INT,
  FOREIGN KEY (category_id) REFERENCES Categories(category_id) ON DELETE SET NULL,
  FOREIGN KEY (supplier_id) REFERENCES Suppliers(supplier_id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE Product_Variants (
  variant_id INT AUTO_INCREMENT PRIMARY KEY,
  product_id INT NOT NULL,
  variant_name VARCHAR(100),
  color VARCHAR(50),
  storage VARCHAR(50),
  price DECIMAL(12,2),
  stock_quantity INT DEFAULT 0,
  warranty_months INT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (product_id) REFERENCES Products(product_id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 4. Warehouses, Inventory Receipts, Receipt Details, Stock Logs
CREATE TABLE Warehouses (
  warehouse_id INT AUTO_INCREMENT PRIMARY KEY,
  warehouse_name VARCHAR(100),
  location VARCHAR(255),
  manager_id INT,
  FOREIGN KEY (manager_id) REFERENCES Employees(employee_id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE Inventory_Receipts (
  receipt_id INT AUTO_INCREMENT PRIMARY KEY,
  supplier_id INT,
  employee_id INT,
  receipt_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  total_value DECIMAL(12,2),
  FOREIGN KEY (supplier_id) REFERENCES Suppliers(supplier_id) ON DELETE SET NULL,
  FOREIGN KEY (employee_id) REFERENCES Employees(employee_id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE Receipt_Details (
  receipt_detail_id INT AUTO_INCREMENT PRIMARY KEY,
  receipt_id INT NOT NULL,
  variant_id INT NOT NULL,
  quantity INT,
  unit_cost DECIMAL(12,2),
  total_cost DECIMAL(12,2),
  FOREIGN KEY (receipt_id) REFERENCES Inventory_Receipts(receipt_id) ON DELETE CASCADE,
  FOREIGN KEY (variant_id) REFERENCES Product_Variants(variant_id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE Stock_Logs (
  log_id INT AUTO_INCREMENT PRIMARY KEY,
  variant_id INT NOT NULL,
  warehouse_id INT,
  change_type VARCHAR(50),
  quantity INT,
  log_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  reference_id INT,
  FOREIGN KEY (variant_id) REFERENCES Product_Variants(variant_id) ON DELETE CASCADE,
  FOREIGN KEY (warehouse_id) REFERENCES Warehouses(warehouse_id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- 5. Customers & Orders
CREATE TABLE Customers (
  customer_id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(100),
  phone_number VARCHAR(15),
  email VARCHAR(100),
  address VARCHAR(255),
  gender VARCHAR(10),
  date_of_birth DATE,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE Order_Status (
  order_status_id INT AUTO_INCREMENT PRIMARY KEY,
  status_name VARCHAR(50),
  description TEXT
) ENGINE=InnoDB;

CREATE TABLE Orders (
  order_id INT AUTO_INCREMENT PRIMARY KEY,
  customer_id INT,
  employee_id INT,
  order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  total_amount DECIMAL(12,2),
  order_status_id INT,
  payment_method VARCHAR(50),
  note TEXT,
  FOREIGN KEY (customer_id) REFERENCES Customers(customer_id) ON DELETE SET NULL,
  FOREIGN KEY (employee_id) REFERENCES Employees(employee_id) ON DELETE SET NULL,
  FOREIGN KEY (order_status_id) REFERENCES Order_Status(order_status_id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE Order_Details (
  order_detail_id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  variant_id INT NOT NULL,
  quantity INT,
  unit_price DECIMAL(12,2),
  discount DECIMAL(5,2),
  subtotal DECIMAL(12,2),
  FOREIGN KEY (order_id) REFERENCES Orders(order_id) ON DELETE CASCADE,
  FOREIGN KEY (variant_id) REFERENCES Product_Variants(variant_id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE Warranty_Cards (
  warranty_id INT AUTO_INCREMENT PRIMARY KEY,
  order_detail_id INT,
  start_date DATE,
  end_date DATE,
  status VARCHAR(50),
  note TEXT,
  FOREIGN KEY (order_detail_id) REFERENCES Order_Details(order_detail_id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- 6. Payments
CREATE TABLE Payment_Status (
  payment_status_id INT AUTO_INCREMENT PRIMARY KEY,
  status_name VARCHAR(50),
  description TEXT
) ENGINE=InnoDB;

CREATE TABLE Payments (
  payment_id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT,
  payment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  amount DECIMAL(12,2),
  payment_method VARCHAR(50),
  payment_status_id INT,
  transaction_code VARCHAR(50),
  note TEXT,
  FOREIGN KEY (order_id) REFERENCES Orders(order_id) ON DELETE CASCADE,
  FOREIGN KEY (payment_status_id) REFERENCES Payment_Status(payment_status_id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- 7. Promotions & Feedback
CREATE TABLE Promotions (
  promotion_id INT AUTO_INCREMENT PRIMARY KEY,
  promotion_name VARCHAR(100),
  discount_percent DECIMAL(5,2),
  start_date DATE,
  end_date DATE,
  description TEXT
) ENGINE=InnoDB;

CREATE TABLE Promotion_Details (
  promotion_detail_id INT AUTO_INCREMENT PRIMARY KEY,
  promotion_id INT,
  variant_id INT,
  note TEXT,
  FOREIGN KEY (promotion_id) REFERENCES Promotions(promotion_id) ON DELETE CASCADE,
  FOREIGN KEY (variant_id) REFERENCES Product_Variants(variant_id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE Customer_Feedback (
  feedback_id INT AUTO_INCREMENT PRIMARY KEY,
  customer_id INT,
  variant_id INT,
  rating INT,
  comment TEXT,
  feedback_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (customer_id) REFERENCES Customers(customer_id) ON DELETE SET NULL,
  FOREIGN KEY (variant_id) REFERENCES Product_Variants(variant_id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- 8. Product Logs
CREATE TABLE Product_Logs (
  log_id INT AUTO_INCREMENT PRIMARY KEY,
  variant_id INT,
  employee_id INT,
  action_type VARCHAR(20),
  old_data TEXT,
  new_data TEXT,
  action_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  note TEXT,
  FOREIGN KEY (variant_id) REFERENCES Product_Variants(variant_id) ON DELETE SET NULL,
  FOREIGN KEY (employee_id) REFERENCES Employees(employee_id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ============================================
-- PHẦN 2: THÊM DỮ LIỆU MẪU (Mỗi bảng ít nhất 10 records)
-- ============================================

-- 1. Managers (10 records)
INSERT INTO Managers (username, password, full_name, phone_number, email, role, status) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Nguyễn Văn Admin', '0901234567', 'admin@phone.com', 'admin', 'active'),
('manager1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Trần Thị Quản Lý', '0901234568', 'manager1@phone.com', 'manager', 'active'),
('manager2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lê Văn Quản Lý', '0901234569', 'manager2@phone.com', 'manager', 'active'),
('manager3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Phạm Thị Quản Lý', '0901234570', 'manager3@phone.com', 'manager', 'active'),
('manager4', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Hoàng Văn Quản Lý', '0901234571', 'manager4@phone.com', 'manager', 'active'),
('supervisor1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vũ Thị Giám Sát', '0901234572', 'supervisor1@phone.com', 'supervisor', 'active'),
('supervisor2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Đỗ Văn Giám Sát', '0901234573', 'supervisor2@phone.com', 'supervisor', 'active'),
('director', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Bùi Văn Giám Đốc', '0901234574', 'director@phone.com', 'director', 'active'),
('deputy1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ngô Thị Phó', '0901234575', 'deputy1@phone.com', 'deputy', 'active'),
('deputy2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Đinh Văn Phó', '0901234576', 'deputy2@phone.com', 'deputy', 'active');

-- 2. Employees (10 records)
INSERT INTO Employees (full_name, position, phone_number, email, address, salary, manager_id) VALUES
('Lê Văn Nhân Viên', 'Nhân viên bán hàng', '0902234569', 'nhanvien1@phone.com', '123 Đường ABC, TP.HCM', 8000000, 1),
('Phạm Thị Bán Hàng', 'Nhân viên bán hàng', '0902234570', 'nhanvien2@phone.com', '456 Đường XYZ, TP.HCM', 8000000, 1),
('Hoàng Văn Kho', 'Nhân viên kho', '0902234571', 'kho@phone.com', '789 Đường DEF, TP.HCM', 7000000, 1),
('Trần Văn Bán Hàng', 'Nhân viên bán hàng', '0902234572', 'nhanvien3@phone.com', '321 Đường GHI, TP.HCM', 8500000, 2),
('Nguyễn Thị Tư Vấn', 'Nhân viên tư vấn', '0902234573', 'tuvan1@phone.com', '654 Đường JKL, TP.HCM', 7500000, 2),
('Lý Văn Kế Toán', 'Kế toán', '0902234574', 'ketoan@phone.com', '987 Đường MNO, TP.HCM', 9000000, 3),
('Võ Thị Nhập Kho', 'Nhân viên nhập kho', '0902234575', 'nhapkho@phone.com', '147 Đường PQR, TP.HCM', 7200000, 3),
('Đặng Văn Giao Hàng', 'Nhân viên giao hàng', '0902234576', 'giaohang@phone.com', '258 Đường STU, TP.HCM', 6800000, 4),
('Bùi Thị Chăm Sóc', 'Nhân viên chăm sóc khách hàng', '0902234577', 'cskh@phone.com', '369 Đường VWX, TP.HCM', 7300000, 4),
('Phan Văn Bảo Vệ', 'Bảo vệ', '0902234578', 'baove@phone.com', '741 Đường YZ, TP.HCM', 6500000, 5);

-- 3. Roles (10 records)
INSERT INTO Roles (role_name, description) VALUES
('Quản lý sản phẩm', 'Quản lý thông tin sản phẩm'),
('Quản lý đơn hàng', 'Xử lý và quản lý đơn hàng'),
('Quản lý kho', 'Quản lý tồn kho'),
('Bán hàng', 'Bán hàng cho khách hàng'),
('Tư vấn khách hàng', 'Tư vấn sản phẩm cho khách hàng'),
('Nhập kho', 'Nhập hàng vào kho'),
('Xuất kho', 'Xuất hàng từ kho'),
('Kế toán', 'Quản lý tài chính, thanh toán'),
('Giao hàng', 'Giao hàng cho khách hàng'),
('Chăm sóc khách hàng', 'Hỗ trợ và chăm sóc khách hàng');

-- 4. Employee_Roles (10 records)
INSERT INTO Employee_Roles (employee_id, role_id, assigned_at) VALUES
(1, 4, '2024-01-01 08:00:00'),
(2, 4, '2024-01-01 08:00:00'),
(3, 6, '2024-01-01 08:00:00'),
(4, 4, '2024-02-01 08:00:00'),
(5, 5, '2024-02-01 08:00:00'),
(6, 8, '2024-02-01 08:00:00'),
(7, 6, '2024-03-01 08:00:00'),
(8, 9, '2024-03-01 08:00:00'),
(9, 10, '2024-03-01 08:00:00'),
(1, 5, '2024-04-01 08:00:00');

-- 5. Categories (10 records)
INSERT INTO Categories (category_name, description) VALUES
('Điện thoại thông minh', 'Smartphone các hãng'),
('Phụ kiện', 'Ốp lưng, tai nghe, sạc, cáp...'),
('Đồng hồ thông minh', 'Smartwatch'),
('Tablet', 'Máy tính bảng'),
('Laptop', 'Máy tính xách tay'),
('Tai nghe', 'Tai nghe có dây và không dây'),
('Sạc và cáp', 'Củ sạc, cáp sạc các loại'),
('Pin dự phòng', 'Pin sạc dự phòng'),
('Ốp lưng', 'Ốp lưng điện thoại các loại'),
('Camera và phụ kiện', 'Camera, ống kính và phụ kiện');

-- 6. Suppliers (10 records)
INSERT INTO Suppliers (supplier_name, phone_number, email, address, description) VALUES
('Công ty Điện thoại ABC', '0901111111', 'abc@supplier.com', '123 Đường Nhà Cung Cấp, Hà Nội', 'Nhà cung cấp chính'),
('Công ty Phụ kiện XYZ', '0902222222', 'xyz@supplier.com', '456 Đường Phụ Kiện, TP.HCM', 'Chuyên phụ kiện'),
('Công ty Apple Việt Nam', '0903333333', 'apple@supplier.com', '789 Đường Apple, TP.HCM', 'Nhà phân phối Apple chính thức'),
('Công ty Samsung Việt Nam', '0904444444', 'samsung@supplier.com', '321 Đường Samsung, TP.HCM', 'Nhà phân phối Samsung chính thức'),
('Công ty Xiaomi Việt Nam', '0905555555', 'xiaomi@supplier.com', '654 Đường Xiaomi, Hà Nội', 'Nhà phân phối Xiaomi'),
('Công ty OPPO Việt Nam', '0906666666', 'oppo@supplier.com', '987 Đường OPPO, TP.HCM', 'Nhà phân phối OPPO'),
('Công ty Vivo Việt Nam', '0907777777', 'vivo@supplier.com', '147 Đường Vivo, TP.HCM', 'Nhà phân phối Vivo'),
('Công ty Realme Việt Nam', '0908888888', 'realme@supplier.com', '258 Đường Realme, Hà Nội', 'Nhà phân phối Realme'),
('Công ty OnePlus Việt Nam', '0909999999', 'oneplus@supplier.com', '369 Đường OnePlus, TP.HCM', 'Nhà phân phối OnePlus'),
('Công ty Phụ kiện Điện tử', '0901010101', 'phukien@supplier.com', '741 Đường Phụ Kiện, TP.HCM', 'Chuyên các phụ kiện điện tử');

-- 7. Products (10+ records)
INSERT INTO Products (product_name, brand, description, category_id, supplier_id) VALUES
('iPhone 15 Pro Max', 'Apple', 'iPhone 15 Pro Max 256GB, màn hình 6.7 inch, chip A17 Pro', 1, 3),
('iPhone 15', 'Apple', 'iPhone 15 128GB, màn hình 6.1 inch, chip A16 Bionic', 1, 3),
('Samsung Galaxy S24 Ultra', 'Samsung', 'Galaxy S24 Ultra 256GB, màn hình 6.8 inch, chip Snapdragon 8 Gen 3', 1, 4),
('Samsung Galaxy S24', 'Samsung', 'Galaxy S24 128GB, màn hình 6.2 inch, chip Snapdragon 8 Gen 3', 1, 4),
('Xiaomi 14 Pro', 'Xiaomi', 'Xiaomi 14 Pro 256GB, màn hình 6.73 inch, chip Snapdragon 8 Gen 3', 1, 5),
('OPPO Find X7 Ultra', 'OPPO', 'OPPO Find X7 Ultra 512GB, màn hình 6.82 inch, chip Snapdragon 8 Gen 3', 1, 6),
('iPad Pro 12.9 inch', 'Apple', 'iPad Pro 12.9 inch M2, 256GB, Wi-Fi', 4, 3),
('Samsung Galaxy Tab S9', 'Samsung', 'Galaxy Tab S9 256GB, màn hình 11 inch', 4, 4),
('Apple Watch Series 9', 'Apple', 'Apple Watch Series 9 GPS 45mm', 3, 3),
('Ốp lưng iPhone 15', 'Generic', 'Ốp lưng trong suốt cho iPhone 15', 9, 2),
('Tai nghe AirPods Pro 2', 'Apple', 'Tai nghe không dây AirPods Pro 2', 6, 3),
('Sạc nhanh 20W', 'Generic', 'Củ sạc nhanh 20W USB-C', 7, 2),
('iPhone 14 Pro', 'Apple', 'iPhone 14 Pro 128GB, màn hình 6.1 inch, chip A16 Bionic', 1, 3),
('Samsung Galaxy Z Fold 5', 'Samsung', 'Galaxy Z Fold 5 256GB, màn hình gập', 1, 4),
('Xiaomi 13 Ultra', 'Xiaomi', 'Xiaomi 13 Ultra 256GB, camera Leica', 1, 5);

-- 8. Product_Variants (10+ records)
INSERT INTO Product_Variants (product_id, variant_name, color, storage, price, stock_quantity, warranty_months) VALUES
-- iPhone 15 Pro Max
(1, 'iPhone 15 Pro Max 256GB Titanium Xanh', 'Titanium Xanh', '256GB', 32990000, 15, 12),
(1, 'iPhone 15 Pro Max 256GB Titanium Trắng', 'Titanium Trắng', '256GB', 32990000, 12, 12),
(1, 'iPhone 15 Pro Max 512GB Titanium Xanh', 'Titanium Xanh', '512GB', 37990000, 8, 12),
-- iPhone 15
(2, 'iPhone 15 128GB Xanh', 'Xanh', '128GB', 21990000, 20, 12),
(2, 'iPhone 15 128GB Hồng', 'Hồng', '128GB', 21990000, 18, 12),
(2, 'iPhone 15 256GB Xanh', 'Xanh', '256GB', 24990000, 15, 12),
-- Samsung Galaxy S24 Ultra
(3, 'Samsung S24 Ultra 256GB Đen', 'Đen', '256GB', 26990000, 10, 12),
(3, 'Samsung S24 Ultra 256GB Tím', 'Tím', '256GB', 26990000, 8, 12),
(3, 'Samsung S24 Ultra 512GB Đen', 'Đen', '512GB', 29990000, 5, 12),
-- Samsung Galaxy S24
(4, 'Samsung S24 128GB Đen', 'Đen', '128GB', 19990000, 15, 12),
(4, 'Samsung S24 128GB Tím', 'Tím', '128GB', 19990000, 12, 12),
-- Xiaomi 14 Pro
(5, 'Xiaomi 14 Pro 256GB Đen', 'Đen', '256GB', 18990000, 10, 12),
(5, 'Xiaomi 14 Pro 256GB Xanh', 'Xanh', '256GB', 18990000, 8, 12),
-- OPPO Find X7 Ultra
(6, 'OPPO Find X7 Ultra 512GB Đen', 'Đen', '512GB', 22990000, 6, 12),
(6, 'OPPO Find X7 Ultra 512GB Xanh', 'Xanh', '512GB', 22990000, 5, 12),
-- iPad Pro
(7, 'iPad Pro 12.9 256GB Xám', 'Xám', '256GB', 29990000, 8, 12),
(7, 'iPad Pro 12.9 256GB Bạc', 'Bạc', '256GB', 29990000, 7, 12),
-- Galaxy Tab S9
(8, 'Galaxy Tab S9 256GB Đen', 'Đen', '256GB', 19990000, 6, 12),
-- Apple Watch
(9, 'Apple Watch Series 9 45mm GPS Đen', 'Đen', '45mm', 10990000, 10, 12),
(9, 'Apple Watch Series 9 45mm GPS Bạc', 'Bạc', '45mm', 10990000, 8, 12),
-- Phụ kiện
(10, 'Ốp lưng iPhone 15 Trong suốt', 'Trong suốt', '', 150000, 50, 3),
(11, 'AirPods Pro 2', 'Trắng', '', 5990000, 20, 12),
(12, 'Sạc nhanh 20W USB-C', 'Trắng', '', 200000, 30, 6),
-- iPhone 14 Pro
(13, 'iPhone 14 Pro 128GB Tím', 'Tím', '128GB', 24990000, 10, 12),
(13, 'iPhone 14 Pro 256GB Tím', 'Tím', '256GB', 27990000, 8, 12),
-- Samsung Z Fold 5
(14, 'Samsung Z Fold 5 256GB Đen', 'Đen', '256GB', 44990000, 4, 12),
(14, 'Samsung Z Fold 5 512GB Đen', 'Đen', '512GB', 48990000, 3, 12),
-- Xiaomi 13 Ultra
(15, 'Xiaomi 13 Ultra 256GB Đen', 'Đen', '256GB', 20990000, 7, 12),
(15, 'Xiaomi 13 Ultra 512GB Đen', 'Đen', '512GB', 23990000, 5, 12);

-- 9. Warehouses (10 records)
INSERT INTO Warehouses (warehouse_name, location, manager_id) VALUES
('Kho chính TP.HCM', '123 Đường Kho, Quận 1, TP.HCM', 3),
('Kho phụ Hà Nội', '456 Đường Kho, Quận Cầu Giấy, Hà Nội', 3),
('Kho phụ Đà Nẵng', '789 Đường Kho, Quận Hải Châu, Đà Nẵng', 4),
('Kho phụ Cần Thơ', '321 Đường Kho, Quận Ninh Kiều, Cần Thơ', 5),
('Kho phụ Hải Phòng', '654 Đường Kho, Quận Hồng Bàng, Hải Phòng', 6),
('Kho phụ Nha Trang', '987 Đường Kho, TP. Nha Trang, Khánh Hòa', 7),
('Kho phụ Vũng Tàu', '147 Đường Kho, TP. Vũng Tàu, Bà Rịa - Vũng Tàu', 8),
('Kho phụ Huế', '258 Đường Kho, TP. Huế, Thừa Thiên Huế', 9),
('Kho phụ Quy Nhon', '369 Đường Kho, TP. Quy Nhơn, Bình Định', 10),
('Kho phụ Biên Hòa', '741 Đường Kho, TP. Biên Hòa, Đồng Nai', 3);

-- 10. Order_Status (10 records)
INSERT INTO Order_Status (status_name, description) VALUES
('Chờ xác nhận', 'Đơn hàng mới, chờ xác nhận'),
('Đã xác nhận', 'Đơn hàng đã được xác nhận'),
('Đang chuẩn bị', 'Đang chuẩn bị hàng'),
('Đang giao hàng', 'Đơn hàng đang được giao'),
('Đã giao hàng', 'Đã giao hàng thành công'),
('Đã hủy', 'Đơn hàng đã bị hủy'),
('Hoàn trả', 'Khách hàng đã hoàn trả'),
('Đang xử lý', 'Đơn hàng đang được xử lý'),
('Tạm hoãn', 'Đơn hàng tạm hoãn'),
('Chờ thanh toán', 'Đơn hàng chờ thanh toán');

-- 11. Payment_Status (10 records)
INSERT INTO Payment_Status (status_name, description) VALUES
('Chưa thanh toán', 'Chưa thanh toán'),
('Đã thanh toán', 'Đã thanh toán thành công'),
('Thanh toán một phần', 'Đã thanh toán một phần'),
('Hoàn tiền', 'Đã hoàn tiền'),
('Thanh toán thất bại', 'Thanh toán không thành công'),
('Chờ xác nhận thanh toán', 'Chờ xác nhận từ ngân hàng'),
('Đã hủy', 'Giao dịch đã bị hủy'),
('Đang xử lý', 'Giao dịch đang được xử lý'),
('Hoàn tiền một phần', 'Đã hoàn một phần tiền'),
('Chờ hoàn tiền', 'Đang chờ hoàn tiền');

-- 12. Customers (10 records)
INSERT INTO Customers (full_name, phone_number, email, address, gender, date_of_birth) VALUES
('Nguyễn Văn Khách', '0909999999', 'khach1@email.com', '123 Đường Khách, TP.HCM', 'Nam', '1990-01-15'),
('Trần Thị Mua', '0908888888', 'khach2@email.com', '456 Đường Mua, TP.HCM', 'Nữ', '1995-05-20'),
('Lê Văn Điện Thoại', '0907777777', 'khach3@email.com', '789 Đường Điện, Hà Nội', 'Nam', '1988-11-10'),
('Phạm Thị Smartphone', '0906666666', 'khach4@email.com', '321 Đường Smart, Đà Nẵng', 'Nữ', '1992-03-25'),
('Hoàng Văn Mua Hàng', '0905555555', 'khach5@email.com', '654 Đường Mua, Hải Phòng', 'Nam', '1985-07-12'),
('Vũ Thị Khách Hàng', '0904444444', 'khach6@email.com', '987 Đường Khách, Cần Thơ', 'Nữ', '1993-09-30'),
('Đỗ Văn Tiêu Dùng', '0903333333', 'khach7@email.com', '147 Đường Tiêu, Nha Trang', 'Nam', '1991-12-05'),
('Bùi Thị Mua Sắm', '0902222222', 'khach8@email.com', '258 Đường Mua, Vũng Tàu', 'Nữ', '1989-04-18'),
('Ngô Văn Khách VIP', '0901111111', 'khach9@email.com', '369 Đường VIP, Huế', 'Nam', '1987-06-22'),
('Đinh Thị Khách Hàng', '0900000000', 'khach10@email.com', '741 Đường Khách, Quy Nhon', 'Nữ', '1994-08-14');

-- 13. Promotions (10 records)
INSERT INTO Promotions (promotion_name, discount_percent, start_date, end_date, description) VALUES
('Khuyến mãi tháng 11', 10.00, '2024-11-01', '2024-11-30', 'Giảm 10% cho tất cả sản phẩm'),
('Black Friday', 20.00, '2024-11-25', '2024-11-30', 'Giảm 20% trong tuần Black Friday'),
('Khuyến mãi iPhone', 5.00, '2024-11-01', '2024-12-31', 'Giảm 5% cho tất cả iPhone'),
('Khuyến mãi Samsung', 8.00, '2024-11-01', '2024-12-31', 'Giảm 8% cho sản phẩm Samsung'),
('Khuyến mãi cuối năm', 15.00, '2024-12-01', '2024-12-31', 'Giảm 15% cho tất cả sản phẩm'),
('Khuyến mãi Tết', 12.00, '2025-01-01', '2025-01-31', 'Giảm 12% nhân dịp Tết'),
('Khuyến mãi phụ kiện', 25.00, '2024-11-01', '2024-12-31', 'Giảm 25% cho tất cả phụ kiện'),
('Khuyến mãi khai trương', 30.00, '2024-11-01', '2024-11-07', 'Giảm 30% khai trương cửa hàng mới'),
('Khuyến mãi sinh nhật', 18.00, '2024-11-15', '2024-11-17', 'Giảm 18% nhân dịp sinh nhật'),
('Khuyến mãi combo', 10.00, '2024-11-01', '2024-12-31', 'Giảm 10% khi mua combo sản phẩm');

-- 14. Orders (10 records)
INSERT INTO Orders (customer_id, employee_id, total_amount, order_status_id, payment_method, note) VALUES
(1, 1, 21990000, 5, 'Tiền mặt', 'Khách hàng mua trực tiếp tại cửa hàng'),
(2, 2, 32990000, 4, 'Chuyển khoản', 'Đơn hàng online'),
(3, 1, 18990000, 3, 'Thẻ tín dụng', 'Đơn hàng online'),
(4, 3, 26990000, 5, 'Tiền mặt', 'Khách hàng mua trực tiếp'),
(5, 4, 19990000, 4, 'Chuyển khoản', 'Đơn hàng online'),
(6, 5, 24990000, 3, 'Thẻ tín dụng', 'Đơn hàng online'),
(7, 1, 5990000, 5, 'Tiền mặt', 'Khách hàng mua trực tiếp'),
(8, 2, 44990000, 2, 'Chuyển khoản', 'Đơn hàng online'),
(9, 3, 20990000, 4, 'Thẻ tín dụng', 'Đơn hàng online'),
(10, 4, 37990000, 5, 'Tiền mặt', 'Khách hàng mua trực tiếp');

-- 15. Order_Details (10 records)
INSERT INTO Order_Details (order_id, variant_id, quantity, unit_price, discount, subtotal) VALUES
(1, 4, 1, 21990000, 0, 21990000),
(2, 1, 1, 32990000, 0, 32990000),
(3, 11, 1, 18990000, 0, 18990000),
(4, 7, 1, 26990000, 0, 26990000),
(5, 10, 1, 19990000, 0, 19990000),
(6, 24, 1, 24990000, 0, 24990000),
(7, 20, 1, 5990000, 0, 5990000),
(8, 26, 1, 44990000, 0, 44990000),
(9, 28, 1, 20990000, 0, 20990000),
(10, 3, 1, 37990000, 0, 37990000);

-- 16. Payments (10 records)
INSERT INTO Payments (order_id, amount, payment_method, payment_status_id, transaction_code, note) VALUES
(1, 21990000, 'Tiền mặt', 2, 'CASH001', 'Thanh toán tại cửa hàng'),
(2, 32990000, 'Chuyển khoản', 2, 'TRANS001', 'Chuyển khoản ngân hàng'),
(3, 18990000, 'Thẻ tín dụng', 2, 'CARD001', 'Thanh toán bằng thẻ'),
(4, 26990000, 'Tiền mặt', 2, 'CASH002', 'Thanh toán tại cửa hàng'),
(5, 19990000, 'Chuyển khoản', 2, 'TRANS002', 'Chuyển khoản ngân hàng'),
(6, 24990000, 'Thẻ tín dụng', 2, 'CARD002', 'Thanh toán bằng thẻ'),
(7, 5990000, 'Tiền mặt', 2, 'CASH003', 'Thanh toán tại cửa hàng'),
(8, 44990000, 'Chuyển khoản', 6, 'TRANS003', 'Chờ xác nhận từ ngân hàng'),
(9, 20990000, 'Thẻ tín dụng', 2, 'CARD003', 'Thanh toán bằng thẻ'),
(10, 37990000, 'Tiền mặt', 2, 'CASH004', 'Thanh toán tại cửa hàng');

-- 17. Warranty_Cards (10 records)
INSERT INTO Warranty_Cards (order_detail_id, start_date, end_date, status, note) VALUES
(1, '2024-11-01', '2025-11-01', 'Còn hiệu lực', 'Bảo hành chính hãng'),
(2, '2024-11-05', '2025-11-05', 'Còn hiệu lực', 'Bảo hành chính hãng'),
(3, '2024-11-10', '2025-11-10', 'Còn hiệu lực', 'Bảo hành chính hãng'),
(4, '2024-11-12', '2025-11-12', 'Còn hiệu lực', 'Bảo hành chính hãng'),
(5, '2024-11-15', '2025-11-15', 'Còn hiệu lực', 'Bảo hành chính hãng'),
(6, '2024-11-18', '2025-11-18', 'Còn hiệu lực', 'Bảo hành chính hãng'),
(7, '2024-11-20', '2025-11-20', 'Còn hiệu lực', 'Bảo hành chính hãng'),
(8, '2024-11-22', '2025-11-22', 'Còn hiệu lực', 'Bảo hành chính hãng'),
(9, '2024-11-25', '2025-11-25', 'Còn hiệu lực', 'Bảo hành chính hãng'),
(10, '2024-11-28', '2025-11-28', 'Còn hiệu lực', 'Bảo hành chính hãng');

-- 18. Promotion_Details (10 records)
INSERT INTO Promotion_Details (promotion_id, variant_id, note) VALUES
(1, 1, 'Áp dụng cho iPhone 15 Pro Max'),
(1, 2, 'Áp dụng cho iPhone 15 Pro Max'),
(1, 4, 'Áp dụng cho iPhone 15'),
(3, 1, 'Khuyến mãi iPhone'),
(3, 2, 'Khuyến mãi iPhone'),
(3, 4, 'Khuyến mãi iPhone'),
(3, 5, 'Khuyến mãi iPhone'),
(4, 7, 'Khuyến mãi Samsung'),
(4, 8, 'Khuyến mãi Samsung'),
(7, 22, 'Khuyến mãi phụ kiện');

-- 19. Customer_Feedback (10 records)
INSERT INTO Customer_Feedback (customer_id, variant_id, rating, comment, feedback_date) VALUES
(1, 4, 5, 'Sản phẩm rất tốt, giao hàng nhanh', '2024-11-02 10:00:00'),
(2, 1, 5, 'iPhone đẹp, chất lượng tốt', '2024-11-06 14:30:00'),
(3, 11, 4, 'Sản phẩm ổn, giá hợp lý', '2024-11-11 09:15:00'),
(4, 7, 5, 'Samsung S24 Ultra tuyệt vời, camera đẹp', '2024-11-13 16:45:00'),
(5, 10, 4, 'Điện thoại đẹp, pin tốt', '2024-11-16 11:20:00'),
(6, 24, 5, 'iPhone 14 Pro chất lượng cao', '2024-11-19 13:30:00'),
(7, 20, 5, 'AirPods Pro 2 âm thanh tuyệt vời', '2024-11-21 15:00:00'),
(8, 26, 5, 'Samsung Z Fold 5 ấn tượng', '2024-11-23 10:45:00'),
(9, 28, 4, 'Xiaomi 13 Ultra camera đẹp', '2024-11-26 14:15:00'),
(10, 3, 5, 'iPhone 15 Pro Max hoàn hảo', '2024-11-29 16:30:00');

-- 20. Manager_Logs (10 records)
INSERT INTO Manager_Logs (manager_id, action_type, description, action_time) VALUES
(1, 'LOGIN', 'Đăng nhập hệ thống', '2024-11-01 08:00:00'),
(1, 'CREATE_PRODUCT', 'Tạo sản phẩm mới iPhone 15 Pro Max', '2024-11-01 09:00:00'),
(2, 'LOGIN', 'Đăng nhập hệ thống', '2024-11-01 08:15:00'),
(2, 'UPDATE_ORDER', 'Cập nhật đơn hàng #2', '2024-11-01 10:00:00'),
(3, 'LOGIN', 'Đăng nhập hệ thống', '2024-11-02 08:00:00'),
(3, 'CREATE_EMPLOYEE', 'Tạo nhân viên mới', '2024-11-02 09:30:00'),
(4, 'LOGIN', 'Đăng nhập hệ thống', '2024-11-02 08:30:00'),
(4, 'UPDATE_PRODUCT', 'Cập nhật sản phẩm Samsung S24', '2024-11-02 11:00:00'),
(5, 'LOGIN', 'Đăng nhập hệ thống', '2024-11-03 08:00:00'),
(5, 'CREATE_PROMOTION', 'Tạo khuyến mãi mới', '2024-11-03 09:00:00');

-- 21. Inventory_Receipts (10 records)
INSERT INTO Inventory_Receipts (supplier_id, employee_id, receipt_date, total_value) VALUES
(3, 3, '2024-10-01 09:00:00', 1000000000),
(4, 3, '2024-10-05 09:00:00', 800000000),
(5, 7, '2024-10-10 09:00:00', 600000000),
(3, 7, '2024-10-15 09:00:00', 500000000),
(4, 3, '2024-10-20 09:00:00', 700000000),
(6, 7, '2024-10-25 09:00:00', 400000000),
(2, 7, '2024-11-01 09:00:00', 200000000),
(3, 3, '2024-11-05 09:00:00', 900000000),
(4, 7, '2024-11-10 09:00:00', 750000000),
(5, 3, '2024-11-15 09:00:00', 550000000);

-- 22. Receipt_Details (10 records)
INSERT INTO Receipt_Details (receipt_id, variant_id, quantity, unit_cost, total_cost) VALUES
(1, 1, 10, 30000000, 300000000),
(1, 2, 8, 30000000, 240000000),
(2, 7, 15, 24000000, 360000000),
(2, 8, 12, 24000000, 288000000),
(3, 11, 20, 17000000, 340000000),
(4, 4, 25, 20000000, 500000000),
(5, 10, 18, 18000000, 324000000),
(6, 14, 10, 20000000, 200000000),
(7, 22, 50, 150000, 7500000),
(8, 3, 5, 35000000, 175000000);

-- 23. Stock_Logs (10 records)
INSERT INTO Stock_Logs (variant_id, warehouse_id, change_type, quantity, log_date, reference_id) VALUES
(1, 1, 'NHAP_KHO', 10, '2024-10-01 10:00:00', 1),
(2, 1, 'NHAP_KHO', 8, '2024-10-01 10:00:00', 1),
(7, 1, 'NHAP_KHO', 15, '2024-10-05 10:00:00', 2),
(8, 1, 'NHAP_KHO', 12, '2024-10-05 10:00:00', 2),
(11, 2, 'NHAP_KHO', 20, '2024-10-10 10:00:00', 3),
(4, 1, 'NHAP_KHO', 25, '2024-10-15 10:00:00', 4),
(1, 1, 'XUAT_KHO', -1, '2024-11-02 14:00:00', 2),
(7, 1, 'XUAT_KHO', -1, '2024-11-13 15:00:00', 4),
(10, 1, 'NHAP_KHO', 18, '2024-10-20 10:00:00', 5),
(14, 1, 'NHAP_KHO', 10, '2024-10-25 10:00:00', 6);

-- 24. Product_Logs (10 records)
INSERT INTO Product_Logs (variant_id, employee_id, action_type, old_data, new_data, action_date, note) VALUES
(1, 1, 'UPDATE_PRICE', '32000000', '32990000', '2024-11-01 09:00:00', 'Cập nhật giá bán'),
(2, 1, 'UPDATE_STOCK', '10', '12', '2024-11-01 09:30:00', 'Nhập thêm hàng'),
(7, 2, 'UPDATE_PRICE', '26500000', '26990000', '2024-11-02 10:00:00', 'Cập nhật giá bán'),
(4, 2, 'UPDATE_STOCK', '18', '20', '2024-11-02 10:30:00', 'Nhập thêm hàng'),
(11, 3, 'CREATE', NULL, 'Xiaomi 14 Pro 256GB', '2024-11-03 11:00:00', 'Tạo variant mới'),
(10, 3, 'UPDATE_STOCK', '12', '15', '2024-11-03 11:30:00', 'Nhập thêm hàng'),
(3, 4, 'UPDATE_PRICE', '37500000', '37990000', '2024-11-04 12:00:00', 'Cập nhật giá bán'),
(24, 4, 'CREATE', NULL, 'iPhone 14 Pro 128GB', '2024-11-04 12:30:00', 'Tạo variant mới'),
(26, 5, 'CREATE', NULL, 'Samsung Z Fold 5 256GB', '2024-11-05 13:00:00', 'Tạo variant mới'),
(28, 5, 'UPDATE_STOCK', '5', '7', '2024-11-05 13:30:00', 'Nhập thêm hàng');



-- ============================================
-- PHẦN 3: CÁC BẢNG BỔ SUNG
-- ============================================

-- 25. BẢNG CONTACTS (Liên hệ)
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_created_at` (`created_at`),
  KEY `idx_is_read` (`is_read`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 26. BẢNG PRODUCT_REVIEWS (Đánh giá sản phẩm)
CREATE TABLE IF NOT EXISTS `Product_Reviews` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `rating` int(1) NOT NULL DEFAULT 5,
  `comment` text,
  `status` varchar(20) DEFAULT 'pending',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`review_id`),
  KEY `idx_product_id` (`product_id`),
  KEY `idx_customer_id` (`customer_id`),
  KEY `idx_status` (`status`),
  CONSTRAINT `fk_review_product` FOREIGN KEY (`product_id`) REFERENCES `Products` (`product_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_review_customer` FOREIGN KEY (`customer_id`) REFERENCES `Customers` (`customer_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 27. BẢNG COUPONS (Mã giảm giá)
CREATE TABLE IF NOT EXISTS coupons (
    coupon_id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(50) NOT NULL UNIQUE,
    description VARCHAR(255),
    discount_type ENUM('percentage', 'fixed') NOT NULL DEFAULT 'percentage',
    discount_value DECIMAL(15, 2) NOT NULL,
    min_order_amount DECIMAL(15, 2) DEFAULT 0,
    max_discount_amount DECIMAL(15, 2) DEFAULT NULL,
    usage_limit INT DEFAULT NULL,
    used_count INT DEFAULT 0,
    start_date DATETIME DEFAULT NULL,
    end_date DATETIME DEFAULT NULL,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS coupon_usage (
    usage_id INT AUTO_INCREMENT PRIMARY KEY,
    coupon_id INT NOT NULL,
    customer_id INT NOT NULL,
    order_id INT NOT NULL,
    discount_amount DECIMAL(15, 2) NOT NULL,
    used_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (coupon_id) REFERENCES coupons(coupon_id) ON DELETE CASCADE,
    FOREIGN KEY (customer_id) REFERENCES Customers(customer_id) ON DELETE CASCADE,
    FOREIGN KEY (order_id) REFERENCES Orders(order_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Thêm cột coupon vào bảng orders (bỏ qua nếu đã tồn tại)
-- Chạy từng lệnh riêng, bỏ qua lỗi nếu cột đã tồn tại
ALTER TABLE Orders ADD COLUMN coupon_id INT DEFAULT NULL;
ALTER TABLE Orders ADD COLUMN discount_amount DECIMAL(15, 2) DEFAULT 0;

-- Mã giảm giá mẫu
INSERT INTO coupons (code, description, discount_type, discount_value, min_order_amount, max_discount_amount, usage_limit, start_date, end_date) VALUES
('WELCOME10', 'Giảm 10% cho khách hàng mới', 'percentage', 10, 500000, 200000, 100, NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY)),
('SALE50K', 'Giảm 50.000đ cho đơn từ 1 triệu', 'fixed', 50000, 1000000, NULL, 50, NOW(), DATE_ADD(NOW(), INTERVAL 15 DAY)),
('FREESHIP', 'Giảm 30.000đ phí ship', 'fixed', 30000, 300000, NULL, NULL, NOW(), DATE_ADD(NOW(), INTERVAL 60 DAY)),
('VIP20', 'Giảm 20% cho khách VIP', 'percentage', 20, 2000000, 500000, 20, NOW(), DATE_ADD(NOW(), INTERVAL 90 DAY));

-- 28. BẢNG POSTS (Bài viết)
CREATE TABLE IF NOT EXISTS post_categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS posts (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    excerpt TEXT,
    content LONGTEXT,
    thumbnail VARCHAR(255),
    category_id INT,
    author_id INT,
    view_count INT DEFAULT 0,
    status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    is_featured TINYINT(1) DEFAULT 0,
    published_at DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES post_categories(category_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Danh mục bài viết mẫu
INSERT INTO post_categories (name, slug, description) VALUES
('Tin tức', 'tin-tuc', 'Tin tức mới nhất về công nghệ'),
('Đánh giá', 'danh-gia', 'Đánh giá sản phẩm chi tiết'),
('Hướng dẫn', 'huong-dan', 'Hướng dẫn sử dụng sản phẩm'),
('Khuyến mãi', 'khuyen-mai', 'Thông tin khuyến mãi, ưu đãi');

-- Bài viết mẫu
INSERT INTO posts (title, slug, excerpt, content, category_id, status, is_featured, published_at) VALUES
('Chào mừng đến với cửa hàng', 'chao-mung-den-voi-cua-hang', 
 'Chào mừng bạn đến với cửa hàng điện thoại hàng đầu Việt Nam.',
 '<p>Chào mừng bạn đến với cửa hàng của chúng tôi!</p><p>Chúng tôi cung cấp các sản phẩm điện thoại chính hãng với giá tốt nhất thị trường.</p>',
 1, 'published', 1, NOW()),
('Hướng dẫn mua hàng online', 'huong-dan-mua-hang-online',
 'Hướng dẫn chi tiết cách mua hàng trực tuyến tại website.',
 '<p>Bước 1: Chọn sản phẩm bạn muốn mua</p><p>Bước 2: Thêm vào giỏ hàng</p><p>Bước 3: Tiến hành thanh toán</p><p>Bước 4: Chờ nhận hàng</p>',
 3, 'published', 0, NOW());
