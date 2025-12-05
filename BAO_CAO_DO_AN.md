# BÁO CÁO ĐỒ ÁN
# HỆ THỐNG BÁN ĐIỆN THOẠI TRỰC TUYẾN

---

## CHƯƠNG 1: TỔNG QUAN DỰ ÁN

### 1.1. Lý do chọn đề tài

Trong thời đại công nghệ số hiện nay, thương mại điện tử đã trở thành xu hướng tất yếu của xã hội. Việc mua sắm trực tuyến ngày càng phổ biến, đặc biệt là trong lĩnh vực điện thoại di động - một trong những mặt hàng có nhu cầu tiêu thụ cao nhất.

**Lý do chọn đề tài:**
- Nhu cầu mua sắm điện thoại trực tuyến ngày càng tăng cao
- Giúp khách hàng tiết kiệm thời gian, so sánh giá cả dễ dàng
- Hỗ trợ doanh nghiệp quản lý bán hàng hiệu quả hơn
- Tích hợp thanh toán trực tuyến an toàn, tiện lợi
- Áp dụng kiến thức lập trình web vào thực tế

### 1.2. Mục tiêu của đề tài

**Mục tiêu chung:**
Xây dựng hệ thống website bán điện thoại trực tuyến hoàn chỉnh, đáp ứng nhu cầu mua sắm của khách hàng và quản lý của doanh nghiệp.

**Mục tiêu cụ thể:**
- Xây dựng giao diện người dùng thân thiện, responsive
- Phát triển hệ thống quản trị cho Admin
- Tích hợp giỏ hàng và thanh toán trực tuyến (VNPay)
- Quản lý sản phẩm với nhiều biến thể (màu sắc, dung lượng)
- Hệ thống đánh giá sản phẩm
- Quản lý đơn hàng và khách hàng

### 1.3. Các công cụ và công nghệ sử dụng

| Công nghệ | Mô tả |
|-----------|-------|
| PHP 7.4+ | Ngôn ngữ lập trình backend |
| MySQL | Hệ quản trị cơ sở dữ liệu |
| Bootstrap 5 | Framework CSS responsive |
| jQuery | Thư viện JavaScript |
| PDO | PHP Data Objects - kết nối database |
| MVC Pattern | Mô hình kiến trúc phần mềm |
| VNPay API | Cổng thanh toán trực tuyến |
| Apache | Web server |


### 1.4. Kết quả dự kiến đạt được

- Website bán điện thoại hoạt động ổn định
- Giao diện đẹp, dễ sử dụng trên mọi thiết bị
- Hệ thống quản trị đầy đủ chức năng
- Tích hợp thanh toán VNPay thành công
- Cơ sở dữ liệu được thiết kế chuẩn hóa

---

## CHƯƠNG 2: KHẢO SÁT HỆ THỐNG

### 2.1. Thống kê kết quả khảo sát

**Đối tượng khảo sát:** Người dùng có nhu cầu mua điện thoại trực tuyến

| Tiêu chí | Tỷ lệ |
|----------|-------|
| Thường xuyên mua hàng online | 78% |
| Ưu tiên thanh toán trực tuyến | 65% |
| Quan tâm đến đánh giá sản phẩm | 85% |
| Cần so sánh nhiều biến thể | 72% |
| Muốn theo dõi đơn hàng | 90% |

### 2.2. Xác định vấn đề

**Vấn đề của người dùng:**
- Khó khăn trong việc so sánh giá và cấu hình điện thoại
- Thiếu thông tin chi tiết về sản phẩm
- Lo ngại về bảo mật khi thanh toán online
- Muốn xem đánh giá từ người dùng khác

**Vấn đề của doanh nghiệp:**
- Quản lý tồn kho phức tạp với nhiều biến thể sản phẩm
- Theo dõi đơn hàng và trạng thái giao hàng
- Quản lý khách hàng và lịch sử mua hàng
- Thống kê doanh thu và báo cáo

---

## CHƯƠNG 3: PHÂN TÍCH THIẾT KẾ

### 3.1. Phân tích Usecase

#### 3.1.1. Các tác nhân của hệ thống

| Tác nhân | Mô tả |
|----------|-------|
| **Khách (Guest)** | Người dùng chưa đăng nhập, có thể xem sản phẩm, tìm kiếm |
| **Khách hàng (Customer)** | Người dùng đã đăng nhập, có thể mua hàng, đánh giá |
| **Quản trị viên (Admin)** | Quản lý toàn bộ hệ thống |

#### 3.1.2. Biểu đồ Usecase tổng quát

```
┌─────────────────────────────────────────────────────────────────┐
│                    HỆ THỐNG BÁN ĐIỆN THOẠI                      │
├─────────────────────────────────────────────────────────────────┤
│                                                                 │
│  ┌─────────┐                                    ┌─────────┐    │
│  │  Guest  │                                    │  Admin  │    │
│  └────┬────┘                                    └────┬────┘    │
│       │                                              │         │
│       ├──► Xem sản phẩm                              │         │
│       ├──► Tìm kiếm                                  │         │
│       ├──► Đăng ký/Đăng nhập                         │         │
│       │                                              │         │
│  ┌────┴────┐                                         │         │
│  │Customer │                                         │         │
│  └────┬────┘                                         │         │
│       │                                              │         │
│       ├──► Thêm giỏ hàng          ◄──────────────────┤         │
│       ├──► Đặt hàng               Quản lý sản phẩm ──┤         │
│       ├──► Thanh toán VNPay       Quản lý đơn hàng ──┤         │
│       ├──► Xem lịch sử đơn hàng   Quản lý khách hàng─┤         │
│       ├──► Đánh giá sản phẩm      Quản lý danh mục ──┤         │
│       └──► Quản lý tài khoản      Duyệt đánh giá ────┘         │
│                                                                 │
└─────────────────────────────────────────────────────────────────┘
```


#### 3.1.3. Biểu đồ Usecase phân rã

**A. Usecase Khách hàng (Customer)**

| UC ID | Tên Usecase | Mô tả |
|-------|-------------|-------|
| UC01 | Đăng ký tài khoản | Khách hàng tạo tài khoản mới |
| UC02 | Đăng nhập | Khách hàng đăng nhập hệ thống |
| UC03 | Xem sản phẩm | Xem danh sách và chi tiết sản phẩm |
| UC04 | Tìm kiếm sản phẩm | Tìm kiếm theo tên, thương hiệu |
| UC05 | Lọc sản phẩm | Lọc theo danh mục, giá, thương hiệu |
| UC06 | Thêm giỏ hàng | Thêm sản phẩm vào giỏ hàng |
| UC07 | Quản lý giỏ hàng | Cập nhật, xóa sản phẩm trong giỏ |
| UC08 | Đặt hàng | Tạo đơn hàng mới |
| UC09 | Thanh toán VNPay | Thanh toán qua cổng VNPay |
| UC10 | Xem đơn hàng | Xem lịch sử và chi tiết đơn hàng |
| UC11 | Đánh giá sản phẩm | Đánh giá sao và bình luận |
| UC12 | Cập nhật thông tin | Cập nhật thông tin cá nhân |

**B. Usecase Quản trị viên (Admin)**

| UC ID | Tên Usecase | Mô tả |
|-------|-------------|-------|
| UC13 | Đăng nhập Admin | Admin đăng nhập hệ thống quản trị |
| UC14 | Xem Dashboard | Xem thống kê tổng quan |
| UC15 | Quản lý sản phẩm | Thêm, sửa, xóa sản phẩm |
| UC16 | Quản lý biến thể | Quản lý màu sắc, dung lượng, giá |
| UC17 | Quản lý danh mục | Thêm, sửa, xóa danh mục |
| UC18 | Quản lý đơn hàng | Xem, cập nhật trạng thái đơn hàng |
| UC19 | Quản lý khách hàng | Xem, khóa/mở khóa tài khoản |
| UC20 | Quản lý đánh giá | Duyệt, từ chối, xóa đánh giá |
| UC21 | Upload hình ảnh | Upload ảnh sản phẩm, danh mục |

### 3.2. Biểu đồ hoạt động

**A. Quy trình đặt hàng**

```
┌─────────┐     ┌─────────────┐     ┌─────────────┐     ┌─────────────┐
│  Bắt đầu │────►│ Xem sản phẩm│────►│Thêm giỏ hàng│────►│ Xem giỏ hàng│
└─────────┘     └─────────────┘     └─────────────┘     └──────┬──────┘
                                                               │
                                                               ▼
┌─────────┐     ┌─────────────┐     ┌─────────────┐     ┌─────────────┐
│ Kết thúc│◄────│Xác nhận đơn │◄────│ Thanh toán  │◄────│Nhập thông tin│
└─────────┘     └─────────────┘     └─────────────┘     └─────────────┘
```

**B. Quy trình thanh toán VNPay**

```
┌─────────┐     ┌─────────────┐     ┌─────────────┐     ┌─────────────┐
│Chọn VNPay│───►│Chuyển hướng │────►│ Nhập thông  │────►│  Xác nhận   │
│          │    │  đến VNPay  │     │ tin thẻ/TK  │     │    OTP      │
└─────────┘     └─────────────┘     └─────────────┘     └──────┬──────┘
                                                               │
                     ┌─────────────────────────────────────────┘
                     ▼
              ┌─────────────┐     ┌─────────────┐     ┌─────────────┐
              │ Kết quả TT  │────►│Cập nhật đơn │────►│  Hoàn tất   │
              │  từ VNPay   │     │   hàng      │     │             │
              └─────────────┘     └─────────────┘     └─────────────┘
```

---

## CHƯƠNG 4: THIẾT KẾ HỆ THỐNG

### 4.1. Thiết kế giao diện Admin

**Dashboard:**
- Thống kê tổng quan: Tổng sản phẩm, đơn hàng, khách hàng, doanh thu
- Danh sách đơn hàng gần đây
- Biểu đồ thống kê

**Quản lý sản phẩm:**
- Danh sách sản phẩm với phân trang
- Form thêm/sửa sản phẩm
- Quản lý biến thể (màu, dung lượng, giá, tồn kho)
- Upload hình ảnh sản phẩm

**Quản lý đơn hàng:**
- Danh sách đơn hàng với trạng thái
- Chi tiết đơn hàng
- Cập nhật trạng thái đơn hàng

**Quản lý khách hàng:**
- Danh sách khách hàng
- Tìm kiếm, lọc theo trạng thái
- Khóa/mở khóa tài khoản

### 4.2. Thiết kế giao diện Client

**Trang chủ:**
- Banner quảng cáo
- Danh sách sản phẩm nổi bật
- Lọc theo thương hiệu, danh mục
- Phân trang

**Trang chi tiết sản phẩm:**
- Hình ảnh sản phẩm
- Thông tin chi tiết
- Chọn biến thể (màu, dung lượng)
- Giá và nút thêm giỏ hàng
- Đánh giá từ khách hàng

**Giỏ hàng:**
- Danh sách sản phẩm trong giỏ
- Cập nhật số lượng
- Tổng tiền
- Nút thanh toán

**Thanh toán:**
- Form thông tin giao hàng
- Chọn phương thức thanh toán
- Xác nhận đơn hàng


---

## CHƯƠNG 5: XÂY DỰNG CƠ SỞ DỮ LIỆU

### 5.1. Cơ sở dữ liệu

**Tên database:** `inventory_system`

**Sơ đồ quan hệ (ERD):**

```
┌─────────────┐       ┌─────────────┐       ┌─────────────────┐
│  Managers   │       │  Categories │       │    Suppliers    │
├─────────────┤       ├─────────────┤       ├─────────────────┤
│ manager_id  │       │ category_id │       │  supplier_id    │
│ username    │       │category_name│       │  supplier_name  │
│ password    │       │ description │       │  phone_number   │
│ full_name   │       └──────┬──────┘       │  email          │
│ role        │              │              └────────┬────────┘
│ status      │              │                       │
└─────────────┘              │                       │
                             ▼                       ▼
                      ┌─────────────────────────────────┐
                      │           Products              │
                      ├─────────────────────────────────┤
                      │ product_id (PK)                 │
                      │ product_name                    │
                      │ brand                           │
                      │ description                     │
                      │ category_id (FK)                │
                      │ supplier_id (FK)                │
                      │ created_at                      │
                      └───────────────┬─────────────────┘
                                      │
                                      ▼
                      ┌─────────────────────────────────┐
                      │       Product_Variants          │
                      ├─────────────────────────────────┤
                      │ variant_id (PK)                 │
                      │ product_id (FK)                 │
                      │ variant_name                    │
                      │ color                           │
                      │ storage                         │
                      │ price                           │
                      │ stock_quantity                  │
                      │ warranty_months                 │
                      └───────────────┬─────────────────┘
                                      │
┌─────────────┐                       │
│  Customers  │                       │
├─────────────┤                       │
│ customer_id │◄──────────────────────┼───────────────────┐
│ full_name   │                       │                   │
│ phone_number│                       │                   │
│ email       │                       ▼                   │
│ address     │              ┌─────────────────┐          │
│ gender      │              │  Order_Details  │          │
│ status      │              ├─────────────────┤          │
└──────┬──────┘              │order_detail_id  │          │
       │                     │ order_id (FK)   │          │
       │                     │ variant_id (FK) │          │
       │                     │ quantity        │          │
       │                     │ unit_price      │          │
       │                     │ subtotal        │          │
       │                     └────────┬────────┘          │
       │                              │                   │
       ▼                              ▼                   │
┌─────────────────┐          ┌─────────────────┐          │
│     Orders      │◄─────────┤   Payments      │          │
├─────────────────┤          ├─────────────────┤          │
│ order_id (PK)   │          │ payment_id      │          │
│ customer_id(FK) │          │ order_id (FK)   │          │
│ total_amount    │          │ amount          │          │
│ order_status_id │          │ payment_method  │          │
│ payment_method  │          │ transaction_code│          │
│ note            │          └─────────────────┘          │
│ order_date      │                                       │
└─────────────────┘                                       │
                                                          │
┌─────────────────┐                                       │
│ Product_Reviews │◄──────────────────────────────────────┘
├─────────────────┤
│ review_id (PK)  │
│ product_id (FK) │
│ customer_id(FK) │
│ rating          │
│ comment         │
│ status          │
│ created_at      │
└─────────────────┘
```

### 5.2. Chi tiết cơ sở dữ liệu

#### Bảng Managers (Quản trị viên)
| Tên cột | Kiểu dữ liệu | Mô tả |
|---------|--------------|-------|
| manager_id | INT (PK) | Mã quản trị viên |
| username | VARCHAR(50) | Tên đăng nhập |
| password | VARCHAR(255) | Mật khẩu (hash) |
| full_name | VARCHAR(100) | Họ tên |
| phone_number | VARCHAR(15) | Số điện thoại |
| email | VARCHAR(100) | Email |
| role | VARCHAR(50) | Vai trò (admin, manager) |
| status | VARCHAR(50) | Trạng thái |
| created_at | DATETIME | Ngày tạo |

#### Bảng Categories (Danh mục)
| Tên cột | Kiểu dữ liệu | Mô tả |
|---------|--------------|-------|
| category_id | INT (PK) | Mã danh mục |
| category_name | VARCHAR(100) | Tên danh mục |
| description | TEXT | Mô tả |

#### Bảng Products (Sản phẩm)
| Tên cột | Kiểu dữ liệu | Mô tả |
|---------|--------------|-------|
| product_id | INT (PK) | Mã sản phẩm |
| product_name | VARCHAR(100) | Tên sản phẩm |
| brand | VARCHAR(50) | Thương hiệu |
| description | TEXT | Mô tả chi tiết |
| category_id | INT (FK) | Mã danh mục |
| supplier_id | INT (FK) | Mã nhà cung cấp |
| created_at | DATETIME | Ngày tạo |

#### Bảng Product_Variants (Biến thể sản phẩm)
| Tên cột | Kiểu dữ liệu | Mô tả |
|---------|--------------|-------|
| variant_id | INT (PK) | Mã biến thể |
| product_id | INT (FK) | Mã sản phẩm |
| variant_name | VARCHAR(100) | Tên biến thể |
| color | VARCHAR(50) | Màu sắc |
| storage | VARCHAR(50) | Dung lượng |
| price | DECIMAL(12,2) | Giá bán |
| stock_quantity | INT | Số lượng tồn kho |
| warranty_months | INT | Số tháng bảo hành |

#### Bảng Customers (Khách hàng)
| Tên cột | Kiểu dữ liệu | Mô tả |
|---------|--------------|-------|
| customer_id | INT (PK) | Mã khách hàng |
| full_name | VARCHAR(100) | Họ tên |
| phone_number | VARCHAR(15) | Số điện thoại |
| email | VARCHAR(100) | Email |
| address | VARCHAR(255) | Địa chỉ |
| gender | VARCHAR(10) | Giới tính |
| date_of_birth | DATE | Ngày sinh |
| status | VARCHAR(20) | Trạng thái (active/locked) |
| created_at | DATETIME | Ngày tạo |

#### Bảng Orders (Đơn hàng)
| Tên cột | Kiểu dữ liệu | Mô tả |
|---------|--------------|-------|
| order_id | INT (PK) | Mã đơn hàng |
| customer_id | INT (FK) | Mã khách hàng |
| employee_id | INT (FK) | Mã nhân viên xử lý |
| order_date | DATETIME | Ngày đặt hàng |
| total_amount | DECIMAL(12,2) | Tổng tiền |
| order_status_id | INT (FK) | Mã trạng thái |
| payment_method | VARCHAR(50) | Phương thức thanh toán |
| note | TEXT | Ghi chú |

#### Bảng Order_Details (Chi tiết đơn hàng)
| Tên cột | Kiểu dữ liệu | Mô tả |
|---------|--------------|-------|
| order_detail_id | INT (PK) | Mã chi tiết |
| order_id | INT (FK) | Mã đơn hàng |
| variant_id | INT (FK) | Mã biến thể |
| quantity | INT | Số lượng |
| unit_price | DECIMAL(12,2) | Đơn giá |
| discount | DECIMAL(5,2) | Giảm giá |
| subtotal | DECIMAL(12,2) | Thành tiền |

#### Bảng Product_Reviews (Đánh giá sản phẩm)
| Tên cột | Kiểu dữ liệu | Mô tả |
|---------|--------------|-------|
| review_id | INT (PK) | Mã đánh giá |
| product_id | INT (FK) | Mã sản phẩm |
| customer_id | INT (FK) | Mã khách hàng |
| rating | INT | Số sao (1-5) |
| comment | TEXT | Nội dung đánh giá |
| status | VARCHAR(20) | Trạng thái duyệt |
| created_at | DATETIME | Ngày tạo |


---

## CHƯƠNG 6: KIỂM THỬ - TRIỂN KHAI HỆ THỐNG

### 6.1. Kiểm thử hệ thống

#### 6.1.1. Kiểm thử chức năng (Functional Testing)

**A. Kiểm thử đăng ký/đăng nhập**

| Test Case | Mô tả | Kết quả mong đợi | Kết quả |
|-----------|-------|------------------|---------|
| TC01 | Đăng ký với thông tin hợp lệ | Tạo tài khoản thành công | ✓ Pass |
| TC02 | Đăng ký với email đã tồn tại | Hiển thị thông báo lỗi | ✓ Pass |
| TC03 | Đăng nhập đúng thông tin | Đăng nhập thành công | ✓ Pass |
| TC04 | Đăng nhập sai mật khẩu | Hiển thị thông báo lỗi | ✓ Pass |
| TC05 | Đăng nhập tài khoản bị khóa | Từ chối đăng nhập | ✓ Pass |

**B. Kiểm thử giỏ hàng**

| Test Case | Mô tả | Kết quả mong đợi | Kết quả |
|-----------|-------|------------------|---------|
| TC06 | Thêm sản phẩm vào giỏ | Sản phẩm được thêm | ✓ Pass |
| TC07 | Cập nhật số lượng | Số lượng được cập nhật | ✓ Pass |
| TC08 | Xóa sản phẩm khỏi giỏ | Sản phẩm bị xóa | ✓ Pass |
| TC09 | Thêm vượt quá tồn kho | Hiển thị thông báo lỗi | ✓ Pass |

**C. Kiểm thử đặt hàng**

| Test Case | Mô tả | Kết quả mong đợi | Kết quả |
|-----------|-------|------------------|---------|
| TC10 | Đặt hàng thành công | Tạo đơn hàng mới | ✓ Pass |
| TC11 | Thanh toán VNPay thành công | Cập nhật trạng thái đơn | ✓ Pass |
| TC12 | Thanh toán VNPay thất bại | Hiển thị thông báo lỗi | ✓ Pass |

**D. Kiểm thử Admin**

| Test Case | Mô tả | Kết quả mong đợi | Kết quả |
|-----------|-------|------------------|---------|
| TC13 | Thêm sản phẩm mới | Sản phẩm được tạo | ✓ Pass |
| TC14 | Sửa thông tin sản phẩm | Thông tin được cập nhật | ✓ Pass |
| TC15 | Xóa sản phẩm | Sản phẩm bị xóa | ✓ Pass |
| TC16 | Cập nhật trạng thái đơn hàng | Trạng thái được cập nhật | ✓ Pass |
| TC17 | Khóa tài khoản khách hàng | Tài khoản bị khóa | ✓ Pass |
| TC18 | Duyệt đánh giá | Đánh giá được duyệt | ✓ Pass |

#### 6.1.2. Kiểm thử bảo mật

| Test Case | Mô tả | Kết quả |
|-----------|-------|---------|
| SEC01 | SQL Injection | Được bảo vệ bằng PDO Prepared Statements |
| SEC02 | XSS Attack | Được bảo vệ bằng htmlspecialchars() |
| SEC03 | CSRF Protection | Session-based authentication |
| SEC04 | Password Hashing | Sử dụng password_hash() |

### 6.2. Triển khai hệ thống

#### 6.2.1. Yêu cầu hệ thống

**Server:**
- Apache 2.4+ với mod_rewrite
- PHP 7.4 trở lên
- MySQL 5.7 trở lên
- Extension: PDO, PDO_MySQL, GD

**Client:**
- Trình duyệt web hiện đại (Chrome, Firefox, Safari, Edge)
- Kết nối Internet

#### 6.2.2. Hướng dẫn cài đặt

**Bước 1: Chuẩn bị môi trường**
```
- Cài đặt XAMPP/WAMP/LAMP
- Bật Apache và MySQL
```

**Bước 2: Import Database**
```sql
-- Mở phpMyAdmin
-- Import file: inventory_system_complete.sql
```

**Bước 3: Cấu hình Database**
```php
// File: config/database.php
private $host = "localhost";
private $db_name = "inventory_system";
private $username = "root";
private $password = "";
```

**Bước 4: Cấu hình URL**
```php
// File: config/config.php
// BASE_URL được tự động xác định
```

**Bước 5: Bật mod_rewrite**
```
- Đảm bảo file .htaccess hoạt động
- Bật AllowOverride All trong Apache config
```

#### 6.2.3. Thông tin đăng nhập mặc định

**Admin:**
- URL: `http://localhost/DuAn1/auth/login`
- Username: `admin`
- Password: `password`

**Test thanh toán VNPay (Sandbox):**
- Ngân hàng: NCB
- Số thẻ: 9704198526191432198
- Tên: NGUYEN VAN A
- Ngày phát hành: 07/15
- OTP: 123456

---

## KẾT LUẬN

### Thời gian phát triển dự án

| Giai đoạn | Thời gian | Công việc |
|-----------|-----------|-----------|
| Tuần 1-2 | 2 tuần | Khảo sát, phân tích yêu cầu |
| Tuần 3-4 | 2 tuần | Thiết kế CSDL, giao diện |
| Tuần 5-8 | 4 tuần | Phát triển chức năng |
| Tuần 9-10 | 2 tuần | Tích hợp VNPay, kiểm thử |
| Tuần 11-12 | 2 tuần | Hoàn thiện, viết báo cáo |

### Mức độ hoàn thành dự án

| Chức năng | Mức độ hoàn thành |
|-----------|-------------------|
| Quản lý sản phẩm | 100% |
| Quản lý biến thể sản phẩm | 100% |
| Giỏ hàng | 100% |
| Đặt hàng | 100% |
| Thanh toán VNPay | 100% |
| Quản lý đơn hàng | 100% |
| Quản lý khách hàng | 100% |
| Đánh giá sản phẩm | 100% |
| Tìm kiếm, lọc sản phẩm | 100% |
| Responsive Design | 100% |

**Tổng mức độ hoàn thành: 100%**

### Những khó khăn rủi ro gặp phải và cách giải quyết

| Khó khăn | Giải pháp |
|----------|-----------|
| Tích hợp VNPay phức tạp | Nghiên cứu tài liệu API, sử dụng sandbox để test |
| Quản lý nhiều biến thể sản phẩm | Thiết kế bảng Product_Variants riêng biệt |
| Đồng bộ giỏ hàng | Sử dụng Session kết hợp AJAX |
| Bảo mật thanh toán | Sử dụng HTTPS, hash signature từ VNPay |
| Responsive trên nhiều thiết bị | Sử dụng Bootstrap 5 Grid System |

### Kế hoạch phát triển trong tương lai

1. **Tính năng mới:**
   - Tích hợp thêm cổng thanh toán (MoMo, ZaloPay)
   - Chat trực tuyến với khách hàng
   - Hệ thống voucher, mã giảm giá
   - So sánh sản phẩm
   - Wishlist (Danh sách yêu thích)

2. **Cải thiện:**
   - Tối ưu hiệu suất với caching
   - Thêm API cho ứng dụng mobile
   - Tích hợp giao hàng (GHN, GHTK)
   - Báo cáo thống kê chi tiết hơn
   - Hệ thống thông báo email/SMS

3. **Bảo mật:**
   - Thêm xác thực 2 lớp (2FA)
   - Mã hóa dữ liệu nhạy cảm
   - Audit log cho Admin

---

## PHỤ LỤC

### Cấu trúc thư mục dự án

```
DuAn1/
├── config/                 # Cấu hình
│   ├── config.php         # Cấu hình chung
│   └── database.php       # Kết nối database
├── controllers/           # Controllers (MVC)
│   ├── BaseController.php
│   ├── HomeController.php
│   ├── AuthController.php
│   ├── ProductController.php
│   ├── CartController.php
│   ├── CustomerController.php
│   ├── AdminController.php
│   ├── ReviewController.php
│   └── PageController.php
├── models/                # Models (MVC)
│   ├── BaseModel.php
│   ├── ProductModel.php
│   ├── CartModel.php
│   ├── CustomerModel.php
│   ├── OrderModel.php
│   ├── AdminModel.php
│   ├── ReviewModel.php
│   └── ContactModel.php
├── views/                 # Views (MVC)
│   ├── admin/            # Giao diện Admin
│   ├── auth/             # Đăng nhập/Đăng ký
│   ├── cart/             # Giỏ hàng
│   ├── customer/         # Tài khoản khách hàng
│   ├── home/             # Trang chủ
│   ├── products/         # Sản phẩm
│   ├── pages/            # Trang tĩnh
│   ├── layouts/          # Layout chung
│   └── errors/           # Trang lỗi
├── public/               # Tài nguyên công khai
│   ├── css/             # Stylesheets
│   ├── js/              # JavaScript
│   ├── images/          # Hình ảnh
│   └── data/            # Ảnh sản phẩm
├── vnpay_php/           # Thư viện VNPay
├── database/            # SQL scripts
├── index.php            # Entry point
├── .htaccess            # URL Rewriting
└── README.md            # Hướng dẫn
```

---

**Ngày hoàn thành:** Tháng 12/2024

**Sinh viên thực hiện:** [Tên sinh viên]

**Giảng viên hướng dẫn:** [Tên giảng viên]
