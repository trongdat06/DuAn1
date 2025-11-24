# Hệ Thống Bán Điện Thoại - PHP MVC

Dự án bán điện thoại và phụ kiện điện tử được xây dựng bằng PHP theo mô hình MVC.

## Tính Năng

### Cho Người Dùng:
- Xem danh sách sản phẩm
- Tìm kiếm sản phẩm
- Xem chi tiết sản phẩm
- Thêm sản phẩm vào giỏ hàng
- Quản lý giỏ hàng (thêm, sửa, xóa)
- Đặt hàng và thanh toán
- Xem danh mục sản phẩm

### Cho Admin:
- Dashboard với thống kê
- Quản lý sản phẩm (thêm, sửa, xóa)
- Quản lý biến thể sản phẩm (màu, bộ nhớ, giá, tồn kho)
- Quản lý khách hàng
- Quản lý đơn hàng và cập nhật trạng thái
- Đăng nhập/đăng xuất

## Cài Đặt

1. Import database:
   - Mở phpMyAdmin hoặc MySQL client
   - Import file `inventory_system_complete.sql`

2. Cấu hình database:
   - Mở file `config/database.php`
   - Cập nhật thông tin kết nối database nếu cần:
     ```php
     private $host = "localhost";
     private $db_name = "inventory_system";
     private $username = "root";
     private $password = "";
     ```

3. Cấu hình BASE_URL:
   - Mở file `config/config.php`
   - Cập nhật BASE_URL nếu cần:
     ```php
     define('BASE_URL', 'http://localhost/duann1/');
     ```

4. Bật mod_rewrite:
   - Đảm bảo Apache đã bật mod_rewrite
   - File `.htaccess` đã được tạo

## Sử Dụng

### Đăng Nhập Admin:
- URL: `http://localhost/duann1/auth/login`
- Username: `admin`
- Password: `password`

### Cấu Trúc Thư Mục:
```
duann1/
├── config/          # Cấu hình
├── controllers/     # Controllers
├── models/          # Models
├── views/           # Views
│   ├── admin/       # Views cho admin
│   ├── cart/        # Views giỏ hàng
│   ├── home/        # Views trang chủ
│   ├── products/    # Views sản phẩm
│   └── layouts/     # Layouts
├── public/          # CSS, JS, images
│   ├── css/
│   └── js/
├── index.php        # Entry point
└── .htaccess        # URL rewriting
```

## Công Nghệ Sử Dụng

- PHP 7.4+
- MySQL
- Bootstrap 5
- jQuery
- PDO

## Lưu Ý

- Đảm bảo PHP đã cài đặt extension PDO và PDO_MySQL
- Database phải được import trước khi sử dụng
- Session phải được bật trong PHP

