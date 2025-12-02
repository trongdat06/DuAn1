-- Script thêm 10 sản phẩm cho mỗi danh mục
-- Chạy file này sau khi đã có dữ liệu cơ bản trong database

USE inventory_system;

-- ============================================
-- DANH MỤC 1: ĐIỆN THOẠI THÔNG MINH (category_id = 1)
-- ============================================
INSERT INTO Products (product_name, brand, description, category_id, supplier_id) VALUES
('iPhone 15 Pro', 'Apple', 'iPhone 15 Pro 128GB, màn hình 6.1 inch, chip A17 Pro, camera 48MP', 1, 3),
('Samsung Galaxy S23 FE', 'Samsung', 'Galaxy S23 FE 128GB, màn hình 6.4 inch, chip Exynos 2200', 1, 4),
('Xiaomi 13T Pro', 'Xiaomi', 'Xiaomi 13T Pro 256GB, màn hình 6.67 inch, chip MediaTek Dimensity 9200+', 1, 5),
('OPPO Reno 11 Pro', 'OPPO', 'OPPO Reno 11 Pro 256GB, màn hình 6.7 inch, chip Snapdragon 8+ Gen 1', 1, 6),
('Vivo X100 Pro', 'Vivo', 'Vivo X100 Pro 256GB, màn hình 6.78 inch, chip MediaTek Dimensity 9300', 1, 7),
('Realme GT 5 Pro', 'Realme', 'Realme GT 5 Pro 256GB, màn hình 6.78 inch, chip Snapdragon 8 Gen 3', 1, 8),
('OnePlus 12', 'OnePlus', 'OnePlus 12 256GB, màn hình 6.82 inch, chip Snapdragon 8 Gen 3', 1, 9),
('Google Pixel 8 Pro', 'Google', 'Google Pixel 8 Pro 128GB, màn hình 6.7 inch, chip Google Tensor G3', 1, 1),
('HONOR Magic 6 Pro', 'HONOR', 'HONOR Magic 6 Pro 256GB, màn hình 6.8 inch, chip Snapdragon 8 Gen 3', 1, 1),
('TECNO Phantom V Fold', 'TECNO', 'TECNO Phantom V Fold 256GB, màn hình gập 7.85 inch', 1, 1);

-- Thêm variants cho điện thoại
INSERT INTO Product_Variants (product_id, variant_name, color, storage, price, stock_quantity, warranty_months) VALUES
-- iPhone 15 Pro
(16, 'iPhone 15 Pro 128GB Titanium Xanh', 'Titanium Xanh', '128GB', 27990000, 15, 12),
(16, 'iPhone 15 Pro 128GB Titanium Trắng', 'Titanium Trắng', '128GB', 27990000, 12, 12),
(16, 'iPhone 15 Pro 256GB Titanium Xanh', 'Titanium Xanh', '256GB', 30990000, 10, 12),
-- Samsung Galaxy S23 FE
(17, 'Samsung S23 FE 128GB Đen', 'Đen', '128GB', 12990000, 20, 12),
(17, 'Samsung S23 FE 128GB Tím', 'Tím', '128GB', 12990000, 18, 12),
(17, 'Samsung S23 FE 256GB Đen', 'Đen', '256GB', 14990000, 15, 12),
-- Xiaomi 13T Pro
(18, 'Xiaomi 13T Pro 256GB Đen', 'Đen', '256GB', 14990000, 12, 12),
(18, 'Xiaomi 13T Pro 256GB Xanh', 'Xanh', '256GB', 14990000, 10, 12),
(18, 'Xiaomi 13T Pro 512GB Đen', 'Đen', '512GB', 16990000, 8, 12),
-- OPPO Reno 11 Pro
(19, 'OPPO Reno 11 Pro 256GB Đen', 'Đen', '256GB', 13990000, 15, 12),
(19, 'OPPO Reno 11 Pro 256GB Xanh', 'Xanh', '256GB', 13990000, 12, 12),
-- Vivo X100 Pro
(20, 'Vivo X100 Pro 256GB Đen', 'Đen', '256GB', 19990000, 10, 12),
(20, 'Vivo X100 Pro 256GB Xanh', 'Xanh', '256GB', 19990000, 8, 12),
(20, 'Vivo X100 Pro 512GB Đen', 'Đen', '512GB', 22990000, 6, 12),
-- Realme GT 5 Pro
(21, 'Realme GT 5 Pro 256GB Đen', 'Đen', '256GB', 16990000, 12, 12),
(21, 'Realme GT 5 Pro 256GB Cam', 'Cam', '256GB', 16990000, 10, 12),
-- OnePlus 12
(22, 'OnePlus 12 256GB Đen', 'Đen', '256GB', 18990000, 10, 12),
(22, 'OnePlus 12 256GB Xanh', 'Xanh', '256GB', 18990000, 8, 12),
(22, 'OnePlus 12 512GB Đen', 'Đen', '512GB', 21990000, 6, 12),
-- Google Pixel 8 Pro
(23, 'Google Pixel 8 Pro 128GB Đen', 'Đen', '128GB', 22990000, 8, 12),
(23, 'Google Pixel 8 Pro 128GB Trắng', 'Trắng', '128GB', 22990000, 6, 12),
(23, 'Google Pixel 8 Pro 256GB Đen', 'Đen', '256GB', 25990000, 5, 12),
-- HONOR Magic 6 Pro
(24, 'HONOR Magic 6 Pro 256GB Đen', 'Đen', '256GB', 17990000, 10, 12),
(24, 'HONOR Magic 6 Pro 256GB Tím', 'Tím', '256GB', 17990000, 8, 12),
-- TECNO Phantom V Fold
(25, 'TECNO Phantom V Fold 256GB Đen', 'Đen', '256GB', 15990000, 6, 12),
(25, 'TECNO Phantom V Fold 256GB Xanh', 'Xanh', '256GB', 15990000, 5, 12);

-- ============================================
-- DANH MỤC 2: PHỤ KIỆN (category_id = 2)
-- ============================================
INSERT INTO Products (product_name, brand, description, category_id, supplier_id) VALUES
('Tai nghe Bluetooth Sony WH-1000XM5', 'Sony', 'Tai nghe chụp tai không dây chống ồn chủ động', 2, 2),
('Loa Bluetooth JBL Flip 6', 'JBL', 'Loa Bluetooth di động chống nước IPX7', 2, 2),
('Bàn phím cơ Logitech MX Keys', 'Logitech', 'Bàn phím không dây đa thiết bị', 2, 2),
('Chuột không dây Logitech MX Master 3S', 'Logitech', 'Chuột không dây đa thiết bị, cảm biến 8K DPI', 2, 2),
('Webcam Logitech C920', 'Logitech', 'Webcam Full HD 1080p với micro tích hợp', 2, 2),
('Giá đỡ điện thoại Baseus', 'Baseus', 'Giá đỡ điện thoại đa năng, điều chỉnh góc độ', 2, 2),
('Hub USB-C Baseus 7 trong 1', 'Baseus', 'Hub USB-C với HDMI, USB 3.0, thẻ nhớ', 2, 2),
('Bàn di chuột gaming Razer', 'Razer', 'Bàn di chuột gaming kích thước lớn', 2, 2),
('Đèn bàn LED Baseus', 'Baseus', 'Đèn bàn LED điều chỉnh độ sáng, sạc không dây', 2, 2),
('Giá đỡ laptop Nulaxy', 'Nulaxy', 'Giá đỡ laptop nhôm, điều chỉnh chiều cao', 2, 2);

-- Thêm variants cho phụ kiện
INSERT INTO Product_Variants (product_id, variant_name, color, storage, price, stock_quantity, warranty_months) VALUES
-- Tai nghe Sony
(26, 'Sony WH-1000XM5 Đen', 'Đen', '', 8990000, 15, 12),
(26, 'Sony WH-1000XM5 Bạc', 'Bạc', '', 8990000, 12, 12),
-- Loa JBL
(27, 'JBL Flip 6 Đen', 'Đen', '', 2990000, 20, 12),
(27, 'JBL Flip 6 Xanh', 'Xanh', '', 2990000, 18, 12),
(27, 'JBL Flip 6 Hồng', 'Hồng', '', 2990000, 15, 12),
-- Bàn phím Logitech
(28, 'Logitech MX Keys Đen', 'Đen', '', 2490000, 15, 12),
(28, 'Logitech MX Keys Trắng', 'Trắng', '', 2490000, 12, 12),
-- Chuột Logitech
(29, 'Logitech MX Master 3S Đen', 'Đen', '', 2990000, 20, 12),
(29, 'Logitech MX Master 3S Trắng', 'Trắng', '', 2990000, 15, 12),
-- Webcam Logitech
(30, 'Logitech C920', 'Đen', '', 1990000, 25, 12),
-- Giá đỡ Baseus
(31, 'Giá đỡ Baseus Đen', 'Đen', '', 250000, 50, 6),
(31, 'Giá đỡ Baseus Trắng', 'Trắng', '', 250000, 45, 6),
-- Hub USB-C Baseus
(32, 'Hub USB-C Baseus 7 trong 1', 'Bạc', '', 650000, 30, 12),
-- Bàn di chuột Razer
(33, 'Bàn di Razer Đen', 'Đen', '', 450000, 40, 12),
(33, 'Bàn di Razer Xanh', 'Xanh', '', 450000, 35, 12),
-- Đèn bàn Baseus
(34, 'Đèn bàn Baseus Trắng', 'Trắng', '', 550000, 30, 12),
(34, 'Đèn bàn Baseus Đen', 'Đen', '', 550000, 25, 12),
-- Giá đỡ laptop Nulaxy
(35, 'Giá đỡ laptop Nulaxy Bạc', 'Bạc', '', 350000, 40, 12),
(35, 'Giá đỡ laptop Nulaxy Đen', 'Đen', '', 350000, 35, 12);

-- ============================================
-- DANH MỤC 3: ĐỒNG HỒ THÔNG MINH (category_id = 3)
-- ============================================
INSERT INTO Products (product_name, brand, description, category_id, supplier_id) VALUES
('Apple Watch Ultra 2', 'Apple', 'Apple Watch Ultra 2 GPS + Cellular 49mm', 3, 3),
('Samsung Galaxy Watch 6 Classic', 'Samsung', 'Galaxy Watch 6 Classic 47mm, Bluetooth', 3, 4),
('Xiaomi Watch S3', 'Xiaomi', 'Xiaomi Watch S3 47mm, GPS, Bluetooth', 3, 5),
('Garmin Forerunner 265', 'Garmin', 'Đồng hồ chạy bộ Garmin Forerunner 265', 3, 2),
('Fitbit Charge 6', 'Fitbit', 'Vòng tay thông minh Fitbit Charge 6', 3, 2),
('Amazfit GTR 4', 'Amazfit', 'Amazfit GTR 4 46mm, GPS, Bluetooth', 3, 2),
('Huawei Watch GT 4', 'Huawei', 'Huawei Watch GT 4 46mm, GPS, Bluetooth', 3, 2),
('OnePlus Watch 2', 'OnePlus', 'OnePlus Watch 2 46mm, GPS, Bluetooth', 3, 9),
('TicWatch Pro 5', 'TicWatch', 'TicWatch Pro 5 49mm, GPS, Bluetooth', 3, 2),
('Fossil Gen 6', 'Fossil', 'Fossil Gen 6 44mm, GPS, Bluetooth', 3, 2);

-- Thêm variants cho đồng hồ thông minh
INSERT INTO Product_Variants (product_id, variant_name, color, storage, price, stock_quantity, warranty_months) VALUES
-- Apple Watch Ultra 2
(36, 'Apple Watch Ultra 2 49mm Titanium', 'Titanium', '49mm', 18990000, 10, 12),
-- Samsung Galaxy Watch 6 Classic
(37, 'Samsung Watch 6 Classic 47mm Đen', 'Đen', '47mm', 8990000, 15, 12),
(37, 'Samsung Watch 6 Classic 47mm Bạc', 'Bạc', '47mm', 8990000, 12, 12),
-- Xiaomi Watch S3
(38, 'Xiaomi Watch S3 47mm Đen', 'Đen', '47mm', 2990000, 20, 12),
(38, 'Xiaomi Watch S3 47mm Xanh', 'Xanh', '47mm', 2990000, 18, 12),
-- Garmin Forerunner 265
(39, 'Garmin Forerunner 265 Đen', 'Đen', '', 8990000, 12, 12),
(39, 'Garmin Forerunner 265 Trắng', 'Trắng', '', 8990000, 10, 12),
-- Fitbit Charge 6
(40, 'Fitbit Charge 6 Đen', 'Đen', '', 2990000, 25, 12),
(40, 'Fitbit Charge 6 Xanh', 'Xanh', '', 2990000, 20, 12),
-- Amazfit GTR 4
(41, 'Amazfit GTR 4 46mm Đen', 'Đen', '46mm', 3990000, 15, 12),
(41, 'Amazfit GTR 4 46mm Bạc', 'Bạc', '46mm', 3990000, 12, 12),
-- Huawei Watch GT 4
(42, 'Huawei Watch GT 4 46mm Đen', 'Đen', '46mm', 4990000, 15, 12),
(42, 'Huawei Watch GT 4 46mm Xanh', 'Xanh', '46mm', 4990000, 12, 12),
-- OnePlus Watch 2
(43, 'OnePlus Watch 2 46mm Đen', 'Đen', '46mm', 5990000, 10, 12),
(43, 'OnePlus Watch 2 46mm Bạc', 'Bạc', '46mm', 5990000, 8, 12),
-- TicWatch Pro 5
(44, 'TicWatch Pro 5 49mm Đen', 'Đen', '49mm', 6990000, 10, 12),
-- Fossil Gen 6
(45, 'Fossil Gen 6 44mm Đen', 'Đen', '44mm', 5990000, 12, 12),
(45, 'Fossil Gen 6 44mm Bạc', 'Bạc', '44mm', 5990000, 10, 12);

-- ============================================
-- DANH MỤC 4: TABLET (category_id = 4)
-- ============================================
INSERT INTO Products (product_name, brand, description, category_id, supplier_id) VALUES
('iPad Air M2', 'Apple', 'iPad Air 11 inch M2, 128GB, Wi-Fi', 4, 3),
('Samsung Galaxy Tab S9 FE', 'Samsung', 'Galaxy Tab S9 FE 10.9 inch, 128GB, Wi-Fi', 4, 4),
('Xiaomi Pad 6 Pro', 'Xiaomi', 'Xiaomi Pad 6 Pro 11 inch, 128GB, Wi-Fi', 4, 5),
('OPPO Pad 2', 'OPPO', 'OPPO Pad 2 11.61 inch, 256GB, Wi-Fi', 4, 6),
('Lenovo Tab P12 Pro', 'Lenovo', 'Lenovo Tab P12 Pro 12.6 inch, 256GB, Wi-Fi', 4, 1),
('Huawei MatePad Pro 13.2', 'Huawei', 'Huawei MatePad Pro 13.2 inch, 256GB, Wi-Fi', 4, 2),
('Microsoft Surface Pro 9', 'Microsoft', 'Surface Pro 9 13 inch, 256GB, Wi-Fi', 4, 1),
('Amazon Fire Max 11', 'Amazon', 'Fire Max 11 11 inch, 64GB', 4, 2),
('Realme Pad 2', 'Realme', 'Realme Pad 2 11.5 inch, 128GB, Wi-Fi', 4, 8),
('OnePlus Pad', 'OnePlus', 'OnePlus Pad 11.61 inch, 128GB, Wi-Fi', 4, 9);

-- Thêm variants cho tablet
INSERT INTO Product_Variants (product_id, variant_name, color, storage, price, stock_quantity, warranty_months) VALUES
-- iPad Air M2
(46, 'iPad Air 11 inch M2 128GB Xám', 'Xám', '128GB', 17990000, 15, 12),
(46, 'iPad Air 11 inch M2 128GB Xanh', 'Xanh', '128GB', 17990000, 12, 12),
(46, 'iPad Air 11 inch M2 256GB Xám', 'Xám', '256GB', 20990000, 10, 12),
-- Samsung Galaxy Tab S9 FE
(47, 'Samsung Tab S9 FE 128GB Đen', 'Đen', '128GB', 8990000, 20, 12),
(47, 'Samsung Tab S9 FE 128GB Xanh', 'Xanh', '128GB', 8990000, 18, 12),
(47, 'Samsung Tab S9 FE 256GB Đen', 'Đen', '256GB', 10990000, 15, 12),
-- Xiaomi Pad 6 Pro
(48, 'Xiaomi Pad 6 Pro 128GB Đen', 'Đen', '128GB', 7990000, 15, 12),
(48, 'Xiaomi Pad 6 Pro 128GB Xanh', 'Xanh', '128GB', 7990000, 12, 12),
(48, 'Xiaomi Pad 6 Pro 256GB Đen', 'Đen', '256GB', 9490000, 10, 12),
-- OPPO Pad 2
(49, 'OPPO Pad 2 256GB Đen', 'Đen', '256GB', 9990000, 12, 12),
(49, 'OPPO Pad 2 256GB Xanh', 'Xanh', '256GB', 9990000, 10, 12),
-- Lenovo Tab P12 Pro
(50, 'Lenovo Tab P12 Pro 256GB Xám', 'Xám', '256GB', 12990000, 10, 12),
(50, 'Lenovo Tab P12 Pro 256GB Xanh', 'Xanh', '256GB', 12990000, 8, 12),
-- Huawei MatePad Pro
(51, 'Huawei MatePad Pro 256GB Đen', 'Đen', '256GB', 14990000, 8, 12),
(51, 'Huawei MatePad Pro 256GB Xanh', 'Xanh', '256GB', 14990000, 6, 12),
-- Microsoft Surface Pro 9
(52, 'Surface Pro 9 256GB Bạc', 'Bạc', '256GB', 24990000, 6, 12),
(52, 'Surface Pro 9 256GB Đen', 'Đen', '256GB', 24990000, 5, 12),
-- Amazon Fire Max 11
(53, 'Fire Max 11 64GB Đen', 'Đen', '64GB', 3990000, 25, 12),
(53, 'Fire Max 11 64GB Xanh', 'Xanh', '64GB', 3990000, 20, 12),
-- Realme Pad 2
(54, 'Realme Pad 2 128GB Xám', 'Xám', '128GB', 5990000, 15, 12),
(54, 'Realme Pad 2 128GB Xanh', 'Xanh', '128GB', 5990000, 12, 12),
-- OnePlus Pad
(55, 'OnePlus Pad 128GB Xanh', 'Xanh', '128GB', 8990000, 10, 12),
(55, 'OnePlus Pad 128GB Đen', 'Đen', '128GB', 8990000, 8, 12);

-- ============================================
-- DANH MỤC 5: LAPTOP (category_id = 5)
-- ============================================
INSERT INTO Products (product_name, brand, description, category_id, supplier_id) VALUES
('MacBook Pro 14 inch M3', 'Apple', 'MacBook Pro 14 inch M3, 512GB SSD, 18GB RAM', 5, 3),
('Dell XPS 13 Plus', 'Dell', 'Dell XPS 13 Plus, Intel Core i7, 512GB SSD, 16GB RAM', 5, 1),
('HP Spectre x360 14', 'HP', 'HP Spectre x360 14, Intel Core i7, 512GB SSD, 16GB RAM', 5, 1),
('Lenovo ThinkPad X1 Carbon', 'Lenovo', 'ThinkPad X1 Carbon Gen 11, Intel Core i7, 512GB SSD, 16GB RAM', 5, 1),
('ASUS ROG Zephyrus G14', 'ASUS', 'ROG Zephyrus G14, AMD Ryzen 9, RTX 4060, 1TB SSD, 16GB RAM', 5, 1),
('Microsoft Surface Laptop 5', 'Microsoft', 'Surface Laptop 5 13.5 inch, Intel Core i7, 512GB SSD, 16GB RAM', 5, 1),
('Acer Swift X 14', 'Acer', 'Swift X 14, Intel Core i7, RTX 4050, 512GB SSD, 16GB RAM', 5, 1),
('Razer Blade 14', 'Razer', 'Razer Blade 14, AMD Ryzen 9, RTX 4070, 1TB SSD, 16GB RAM', 5, 1),
('LG Gram 17', 'LG', 'LG Gram 17, Intel Core i7, 512GB SSD, 16GB RAM', 5, 1),
('Samsung Galaxy Book3 Pro', 'Samsung', 'Galaxy Book3 Pro 14 inch, Intel Core i7, 512GB SSD, 16GB RAM', 5, 4);

-- Thêm variants cho laptop
INSERT INTO Product_Variants (product_id, variant_name, color, storage, price, stock_quantity, warranty_months) VALUES
-- MacBook Pro 14 M3
(56, 'MacBook Pro 14 M3 512GB Xám', 'Xám', '512GB', 49990000, 8, 12),
(56, 'MacBook Pro 14 M3 512GB Bạc', 'Bạc', '512GB', 49990000, 6, 12),
(56, 'MacBook Pro 14 M3 1TB Xám', 'Xám', '1TB', 57990000, 5, 12),
-- Dell XPS 13 Plus
(57, 'Dell XPS 13 Plus 512GB Bạc', 'Bạc', '512GB', 39990000, 10, 12),
(57, 'Dell XPS 13 Plus 512GB Đen', 'Đen', '512GB', 39990000, 8, 12),
-- HP Spectre x360
(58, 'HP Spectre x360 512GB Bạc', 'Bạc', '512GB', 34990000, 10, 12),
(58, 'HP Spectre x360 512GB Xanh', 'Xanh', '512GB', 34990000, 8, 12),
-- Lenovo ThinkPad X1
(59, 'ThinkPad X1 Carbon 512GB Đen', 'Đen', '512GB', 42990000, 8, 12),
(59, 'ThinkPad X1 Carbon 1TB Đen', 'Đen', '1TB', 47990000, 6, 12),
-- ASUS ROG Zephyrus
(60, 'ROG Zephyrus G14 1TB Đen', 'Đen', '1TB', 44990000, 6, 12),
(60, 'ROG Zephyrus G14 1TB Trắng', 'Trắng', '1TB', 44990000, 5, 12),
-- Microsoft Surface Laptop 5
(61, 'Surface Laptop 5 512GB Bạc', 'Bạc', '512GB', 37990000, 8, 12),
(61, 'Surface Laptop 5 512GB Đen', 'Đen', '512GB', 37990000, 6, 12),
-- Acer Swift X
(62, 'Acer Swift X 512GB Xám', 'Xám', '512GB', 29990000, 10, 12),
(62, 'Acer Swift X 512GB Xanh', 'Xanh', '512GB', 29990000, 8, 12),
-- Razer Blade 14
(63, 'Razer Blade 14 1TB Đen', 'Đen', '1TB', 54990000, 5, 12),
-- LG Gram 17
(64, 'LG Gram 17 512GB Trắng', 'Trắng', '512GB', 39990000, 8, 12),
(64, 'LG Gram 17 512GB Đen', 'Đen', '512GB', 39990000, 6, 12),
-- Samsung Galaxy Book3 Pro
(65, 'Galaxy Book3 Pro 512GB Bạc', 'Bạc', '512GB', 34990000, 10, 12),
(65, 'Galaxy Book3 Pro 512GB Xanh', 'Xanh', '512GB', 34990000, 8, 12);

-- ============================================
-- DANH MỤC 6: TAI NGHE (category_id = 6)
-- ============================================
INSERT INTO Products (product_name, brand, description, category_id, supplier_id) VALUES
('AirPods Max', 'Apple', 'Tai nghe chụp tai không dây AirPods Max', 6, 3),
('Sony WF-1000XM5', 'Sony', 'Tai nghe true wireless chống ồn chủ động', 6, 2),
('Samsung Galaxy Buds2 Pro', 'Samsung', 'Tai nghe true wireless Galaxy Buds2 Pro', 6, 4),
('Bose QuietComfort Earbuds II', 'Bose', 'Tai nghe true wireless chống ồn chủ động', 6, 2),
('Jabra Elite 10', 'Jabra', 'Tai nghe true wireless chống ồn chủ động', 6, 2),
('Beats Fit Pro', 'Beats', 'Tai nghe true wireless thể thao', 6, 3),
('Anker Soundcore Liberty 4', 'Anker', 'Tai nghe true wireless chống ồn', 6, 2),
('Nothing Ear (2)', 'Nothing', 'Tai nghe true wireless trong suốt', 6, 2),
('OnePlus Buds Pro 2', 'OnePlus', 'Tai nghe true wireless chống ồn', 6, 9),
('Xiaomi Buds 4 Pro', 'Xiaomi', 'Tai nghe true wireless chống ồn', 6, 5);

-- Thêm variants cho tai nghe
INSERT INTO Product_Variants (product_id, variant_name, color, storage, price, stock_quantity, warranty_months) VALUES
-- AirPods Max
(66, 'AirPods Max Xanh', 'Xanh', '', 12990000, 12, 12),
(66, 'AirPods Max Bạc', 'Bạc', '', 12990000, 10, 12),
(66, 'AirPods Max Hồng', 'Hồng', '', 12990000, 8, 12),
-- Sony WF-1000XM5
(67, 'Sony WF-1000XM5 Đen', 'Đen', '', 6990000, 20, 12),
(67, 'Sony WF-1000XM5 Bạc', 'Bạc', '', 6990000, 15, 12),
-- Samsung Galaxy Buds2 Pro
(68, 'Galaxy Buds2 Pro Tím', 'Tím', '', 3990000, 25, 12),
(68, 'Galaxy Buds2 Pro Trắng', 'Trắng', '', 3990000, 20, 12),
(68, 'Galaxy Buds2 Pro Đen', 'Đen', '', 3990000, 18, 12),
-- Bose QuietComfort Earbuds II
(69, 'Bose QC Earbuds II Đen', 'Đen', '', 8990000, 15, 12),
(69, 'Bose QC Earbuds II Trắng', 'Trắng', '', 8990000, 12, 12),
-- Jabra Elite 10
(70, 'Jabra Elite 10 Đen', 'Đen', '', 5990000, 18, 12),
(70, 'Jabra Elite 10 Trắng', 'Trắng', '', 5990000, 15, 12),
-- Beats Fit Pro
(71, 'Beats Fit Pro Tím', 'Tím', '', 4990000, 20, 12),
(71, 'Beats Fit Pro Đen', 'Đen', '', 4990000, 18, 12),
(71, 'Beats Fit Pro Trắng', 'Trắng', '', 4990000, 15, 12),
-- Anker Soundcore Liberty 4
(72, 'Anker Liberty 4 Đen', 'Đen', '', 2490000, 30, 12),
(72, 'Anker Liberty 4 Trắng', 'Trắng', '', 2490000, 25, 12),
-- Nothing Ear (2)
(73, 'Nothing Ear (2) Trắng', 'Trắng', '', 3990000, 20, 12),
(73, 'Nothing Ear (2) Đen', 'Đen', '', 3990000, 18, 12),
-- OnePlus Buds Pro 2
(74, 'OnePlus Buds Pro 2 Đen', 'Đen', '', 3990000, 15, 12),
(74, 'OnePlus Buds Pro 2 Trắng', 'Trắng', '', 3990000, 12, 12),
-- Xiaomi Buds 4 Pro
(75, 'Xiaomi Buds 4 Pro Đen', 'Đen', '', 2990000, 20, 12),
(75, 'Xiaomi Buds 4 Pro Trắng', 'Trắng', '', 2990000, 18, 12);

-- ============================================
-- DANH MỤC 7: SẠC VÀ CÁP (category_id = 7)
-- ============================================
INSERT INTO Products (product_name, brand, description, category_id, supplier_id) VALUES
('Sạc nhanh Apple 20W USB-C', 'Apple', 'Củ sạc nhanh Apple 20W USB-C chính hãng', 7, 3),
('Sạc nhanh Samsung 25W', 'Samsung', 'Củ sạc nhanh Samsung 25W USB-C', 7, 4),
('Cáp sạc Baseus 100W USB-C', 'Baseus', 'Cáp sạc USB-C to USB-C 100W, dài 2m', 7, 2),
('Sạc không dây MagSafe Baseus', 'Baseus', 'Sạc không dây MagSafe 15W cho iPhone', 7, 2),
('Sạc đa cổng Anker 65W', 'Anker', 'Sạc đa cổng Anker 65W 3 cổng USB-C', 7, 2),
('Cáp Lightning Baseus 1m', 'Baseus', 'Cáp sạc Lightning to USB-C 1m', 7, 2),
('Sạc xe hơi Baseus 30W', 'Baseus', 'Sạc xe hơi 30W 2 cổng USB-C', 7, 2),
('Cáp sạc nhanh Xiaomi 67W', 'Xiaomi', 'Cáp sạc USB-C 67W dài 1m', 7, 5),
('Sạc không dây Samsung 15W', 'Samsung', 'Sạc không dây Samsung 15W cho Galaxy', 7, 4),
('Sạc đứng Baseus 20W', 'Baseus', 'Sạc đứng không dây 20W đa thiết bị', 7, 2);

-- Thêm variants cho sạc và cáp
INSERT INTO Product_Variants (product_id, variant_name, color, storage, price, stock_quantity, warranty_months) VALUES
-- Sạc Apple 20W
(76, 'Sạc Apple 20W Trắng', 'Trắng', '', 550000, 50, 12),
-- Sạc Samsung 25W
(77, 'Sạc Samsung 25W Trắng', 'Trắng', '', 450000, 40, 12),
(77, 'Sạc Samsung 25W Đen', 'Đen', '', 450000, 35, 12),
-- Cáp Baseus 100W
(78, 'Cáp Baseus 100W Đen 2m', 'Đen', '2m', 250000, 60, 12),
(78, 'Cáp Baseus 100W Trắng 2m', 'Trắng', '2m', 250000, 55, 12),
-- Sạc không dây MagSafe Baseus
(79, 'Sạc MagSafe Baseus Trắng', 'Trắng', '', 450000, 40, 12),
(79, 'Sạc MagSafe Baseus Đen', 'Đen', '', 450000, 35, 12),
-- Sạc đa cổng Anker
(80, 'Sạc Anker 65W Trắng', 'Trắng', '', 850000, 30, 12),
(80, 'Sạc Anker 65W Đen', 'Đen', '', 850000, 25, 12),
-- Cáp Lightning Baseus
(81, 'Cáp Lightning Baseus Trắng 1m', 'Trắng', '1m', 150000, 80, 6),
(81, 'Cáp Lightning Baseus Đen 1m', 'Đen', '1m', 150000, 75, 6),
-- Sạc xe hơi Baseus
(82, 'Sạc xe hơi Baseus Đen', 'Đen', '', 350000, 50, 12),
(82, 'Sạc xe hơi Baseus Bạc', 'Bạc', '', 350000, 45, 12),
-- Cáp Xiaomi 67W
(83, 'Cáp Xiaomi 67W Đen 1m', 'Đen', '1m', 200000, 40, 12),
(83, 'Cáp Xiaomi 67W Trắng 1m', 'Trắng', '1m', 200000, 35, 12),
-- Sạc không dây Samsung
(84, 'Sạc không dây Samsung Đen', 'Đen', '', 650000, 30, 12),
(84, 'Sạc không dây Samsung Trắng', 'Trắng', '', 650000, 25, 12),
-- Sạc đứng Baseus
(85, 'Sạc đứng Baseus Trắng', 'Trắng', '', 550000, 35, 12),
(85, 'Sạc đứng Baseus Đen', 'Đen', '', 550000, 30, 12);

-- ============================================
-- DANH MỤC 8: PIN DỰ PHÒNG (category_id = 8)
-- ============================================
INSERT INTO Products (product_name, brand, description, category_id, supplier_id) VALUES
('Pin dự phòng Anker PowerCore 20000', 'Anker', 'Pin dự phòng 20000mAh, sạc nhanh 20W', 8, 2),
('Pin dự phòng Xiaomi 20000 Pro', 'Xiaomi', 'Pin dự phòng 20000mAh, sạc nhanh 50W', 8, 5),
('Pin dự phòng Baseus 20000', 'Baseus', 'Pin dự phòng 20000mAh, sạc nhanh 22.5W', 8, 2),
('Pin dự phòng Samsung 10000', 'Samsung', 'Pin dự phòng 10000mAh, sạc nhanh 25W', 8, 4),
('Pin dự phòng Belkin 10000', 'Belkin', 'Pin dự phòng 10000mAh, sạc nhanh 18W', 8, 2),
('Pin dự phòng Romoss 30000', 'Romoss', 'Pin dự phòng 30000mAh, sạc nhanh 18W', 8, 2),
('Pin dự phòng Mophie Powerstation', 'Mophie', 'Pin dự phòng 10000mAh, sạc không dây', 8, 2),
('Pin dự phòng RavPower 20000', 'RavPower', 'Pin dự phòng 20000mAh, sạc nhanh 60W', 8, 2),
('Pin dự phòng UGREEN 20000', 'UGREEN', 'Pin dự phòng 20000mAh, sạc nhanh 45W', 8, 2),
('Pin dự phòng Zendure SuperTank', 'Zendure', 'Pin dự phòng 26800mAh, sạc nhanh 100W', 8, 2);

-- Thêm variants cho pin dự phòng
INSERT INTO Product_Variants (product_id, variant_name, color, storage, price, stock_quantity, warranty_months) VALUES
-- Anker PowerCore 20000
(86, 'Anker PowerCore 20000 Đen', 'Đen', '20000mAh', 899000, 30, 12),
(86, 'Anker PowerCore 20000 Trắng', 'Trắng', '20000mAh', 899000, 25, 12),
-- Xiaomi 20000 Pro
(87, 'Xiaomi 20000 Pro Đen', 'Đen', '20000mAh', 799000, 35, 12),
(87, 'Xiaomi 20000 Pro Trắng', 'Trắng', '20000mAh', 799000, 30, 12),
-- Baseus 20000
(88, 'Baseus 20000 Đen', 'Đen', '20000mAh', 699000, 40, 12),
(88, 'Baseus 20000 Trắng', 'Trắng', '20000mAh', 699000, 35, 12),
-- Samsung 10000
(89, 'Samsung 10000 Đen', 'Đen', '10000mAh', 599000, 45, 12),
(89, 'Samsung 10000 Trắng', 'Trắng', '10000mAh', 599000, 40, 12),
-- Belkin 10000
(90, 'Belkin 10000 Đen', 'Đen', '10000mAh', 799000, 30, 12),
(90, 'Belkin 10000 Trắng', 'Trắng', '10000mAh', 799000, 25, 12),
-- Romoss 30000
(91, 'Romoss 30000 Đen', 'Đen', '30000mAh', 999000, 25, 12),
(91, 'Romoss 30000 Xanh', 'Xanh', '30000mAh', 999000, 20, 12),
-- Mophie Powerstation
(92, 'Mophie Powerstation Đen', 'Đen', '10000mAh', 1299000, 20, 12),
(92, 'Mophie Powerstation Trắng', 'Trắng', '10000mAh', 1299000, 15, 12),
-- RavPower 20000
(93, 'RavPower 20000 Đen', 'Đen', '20000mAh', 1099000, 25, 12),
(93, 'RavPower 20000 Trắng', 'Trắng', '20000mAh', 1099000, 20, 12),
-- UGREEN 20000
(94, 'UGREEN 20000 Đen', 'Đen', '20000mAh', 899000, 30, 12),
(94, 'UGREEN 20000 Xanh', 'Xanh', '20000mAh', 899000, 25, 12),
-- Zendure SuperTank
(95, 'Zendure SuperTank Đen', 'Đen', '26800mAh', 2499000, 15, 12),
(95, 'Zendure SuperTank Xanh', 'Xanh', '26800mAh', 2499000, 12, 12);

-- ============================================
-- DANH MỤC 9: ỐP LƯNG (category_id = 9)
-- ============================================
INSERT INTO Products (product_name, brand, description, category_id, supplier_id) VALUES
('Ốp lưng iPhone 15 Pro Spigen', 'Spigen', 'Ốp lưng iPhone 15 Pro chống sốc', 9, 2),
('Ốp lưng Samsung S24 Ultra Otterbox', 'Otterbox', 'Ốp lưng Samsung S24 Ultra chống sốc', 9, 2),
('Ốp lưng trong suốt Baseus', 'Baseus', 'Ốp lưng trong suốt đa dòng điện thoại', 9, 2),
('Ốp lưng da Apple Leather', 'Apple', 'Ốp lưng da chính hãng Apple', 9, 3),
('Ốp lưng MagSafe Spigen', 'Spigen', 'Ốp lưng MagSafe cho iPhone', 9, 2),
('Ốp lưng chống nước Lifeproof', 'Lifeproof', 'Ốp lưng chống nước IP68', 9, 2),
('Ốp lưng gỗ Pela', 'Pela', 'Ốp lưng gỗ thân thiện môi trường', 9, 2),
('Ốp lưng trong suốt Ringke', 'Ringke', 'Ốp lưng trong suốt chống vân tay', 9, 2),
('Ốp lưng silicon Caseology', 'Caseology', 'Ốp lưng silicon mềm mại', 9, 2),
('Ốp lưng kim loại Rhinoshield', 'Rhinoshield', 'Ốp lưng kim loại chống sốc', 9, 2);

-- Thêm variants cho ốp lưng
INSERT INTO Product_Variants (product_id, variant_name, color, storage, price, stock_quantity, warranty_months) VALUES
-- Ốp lưng Spigen iPhone 15 Pro
(96, 'Ốp Spigen iPhone 15 Pro Đen', 'Đen', '', 450000, 50, 6),
(96, 'Ốp Spigen iPhone 15 Pro Xanh', 'Xanh', '', 450000, 45, 6),
(96, 'Ốp Spigen iPhone 15 Pro Trong suốt', 'Trong suốt', '', 450000, 40, 6),
-- Ốp lưng Otterbox Samsung
(97, 'Ốp Otterbox S24 Ultra Đen', 'Đen', '', 650000, 40, 12),
(97, 'Ốp Otterbox S24 Ultra Xanh', 'Xanh', '', 650000, 35, 12),
-- Ốp lưng Baseus trong suốt
(98, 'Ốp Baseus Trong suốt', 'Trong suốt', '', 150000, 100, 3),
-- Ốp lưng da Apple
(99, 'Ốp da Apple Đen', 'Đen', '', 1290000, 30, 12),
(99, 'Ốp da Apple Nâu', 'Nâu', '', 1290000, 25, 12),
(99, 'Ốp da Apple Xanh', 'Xanh', '', 1290000, 20, 12),
-- Ốp lưng MagSafe Spigen
(100, 'Ốp MagSafe Spigen Đen', 'Đen', '', 550000, 45, 12),
(100, 'Ốp MagSafe Spigen Trong suốt', 'Trong suốt', '', 550000, 40, 12),
-- Ốp lưng Lifeproof
(101, 'Ốp Lifeproof Đen', 'Đen', '', 899000, 30, 12),
(101, 'Ốp Lifeproof Xanh', 'Xanh', '', 899000, 25, 12),
-- Ốp lưng gỗ Pela
(102, 'Ốp gỗ Pela Nâu', 'Nâu', '', 599000, 35, 12),
(102, 'Ốp gỗ Pela Đen', 'Đen', '', 599000, 30, 12),
-- Ốp lưng Ringke
(103, 'Ốp Ringke Trong suốt', 'Trong suốt', '', 200000, 60, 6),
-- Ốp lưng Caseology
(104, 'Ốp Caseology Đen', 'Đen', '', 350000, 50, 6),
(104, 'Ốp Caseology Xanh', 'Xanh', '', 350000, 45, 6),
(104, 'Ốp Caseology Hồng', 'Hồng', '', 350000, 40, 6),
-- Ốp lưng Rhinoshield
(105, 'Ốp Rhinoshield Bạc', 'Bạc', '', 799000, 30, 12),
(105, 'Ốp Rhinoshield Đen', 'Đen', '', 799000, 25, 12);

-- ============================================
-- DANH MỤC 10: CAMERA VÀ PHỤ KIỆN (category_id = 10)
-- ============================================
INSERT INTO Products (product_name, brand, description, category_id, supplier_id) VALUES
('Camera GoPro Hero 12', 'GoPro', 'Camera hành động GoPro Hero 12 4K', 10, 2),
('Camera DJI Osmo Action 4', 'DJI', 'Camera hành động DJI Osmo Action 4 4K', 10, 2),
('Gimbal DJI OM 6', 'DJI', 'Gimbal chống rung DJI OM 6 cho điện thoại', 10, 2),
('Ống kính Moment cho iPhone', 'Moment', 'Ống kính wide angle Moment cho iPhone', 10, 2),
('Micro Rode VideoMic Me-C', 'Rode', 'Micro thu âm Rode VideoMic Me-C cho điện thoại', 10, 2),
('Đèn LED Ring Light Neewer', 'Neewer', 'Đèn LED Ring Light 18 inch cho quay video', 10, 2),
('Tripod Manfrotto Compact', 'Manfrotto', 'Tripod gấp gọn Manfrotto Compact', 10, 2),
('Camera 360 Insta360 X3', 'Insta360', 'Camera 360 độ Insta360 X3', 10, 2),
('Bộ lọc ND Variable', 'Generic', 'Bộ lọc ND Variable cho camera điện thoại', 10, 2),
('Stabilizer Zhiyun Smooth 5', 'Zhiyun', 'Gimbal chống rung Zhiyun Smooth 5', 10, 2);

-- Thêm variants cho camera và phụ kiện
INSERT INTO Product_Variants (product_id, variant_name, color, storage, price, stock_quantity, warranty_months) VALUES
-- GoPro Hero 12
(106, 'GoPro Hero 12 Đen', 'Đen', '', 9990000, 15, 12),
(106, 'GoPro Hero 12 Xanh', 'Xanh', '', 9990000, 12, 12),
-- DJI Osmo Action 4
(107, 'DJI Osmo Action 4 Đen', 'Đen', '', 8990000, 15, 12),
(107, 'DJI Osmo Action 4 Trắng', 'Trắng', '', 8990000, 12, 12),
-- DJI OM 6
(108, 'DJI OM 6 Trắng', 'Trắng', '', 2990000, 30, 12),
(108, 'DJI OM 6 Đen', 'Đen', '', 2990000, 25, 12),
-- Ống kính Moment
(109, 'Ống kính Moment Wide Đen', 'Đen', '', 2490000, 20, 12),
(109, 'Ống kính Moment Tele Đen', 'Đen', '', 2490000, 18, 12),
-- Micro Rode
(110, 'Micro Rode VideoMic Me-C Đen', 'Đen', '', 1990000, 25, 12),
(110, 'Micro Rode VideoMic Me-C Trắng', 'Trắng', '', 1990000, 20, 12),
-- Đèn LED Ring Light
(111, 'Ring Light Neewer 18 inch', 'Trắng', '18 inch', 899000, 30, 12),
(111, 'Ring Light Neewer 12 inch', 'Trắng', '12 inch', 599000, 35, 12),
-- Tripod Manfrotto
(112, 'Tripod Manfrotto Compact Đen', 'Đen', '', 1299000, 25, 12),
(112, 'Tripod Manfrotto Compact Bạc', 'Bạc', '', 1299000, 20, 12),
-- Insta360 X3
(113, 'Insta360 X3 Đen', 'Đen', '', 11990000, 10, 12),
(113, 'Insta360 X3 Xanh', 'Xanh', '', 11990000, 8, 12),
-- Bộ lọc ND
(114, 'Bộ lọc ND Variable 37mm', 'Đen', '37mm', 350000, 40, 6),
(114, 'Bộ lọc ND Variable 52mm', 'Đen', '52mm', 450000, 35, 6),
-- Zhiyun Smooth 5
(115, 'Gimbal Zhiyun Smooth 5 Đen', 'Đen', '', 2490000, 20, 12),
(115, 'Gimbal Zhiyun Smooth 5 Trắng', 'Trắng', '', 2490000, 18, 12);

