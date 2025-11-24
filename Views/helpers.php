<?php
// Helper functions for views

function baseUrl($path = '') {
    $base = '/duann1';
    return $base . ($path ? '/' . ltrim($path, '/') : '');
}

function assetUrl($path) {
    return baseUrl('assets/' . ltrim($path, '/'));
}

function formatCurrency($amount) {
    return number_format($amount, 0, ',', '.') . ' đ';
}

function formatDate($date) {
    return date('d/m/Y', strtotime($date));
}

function formatDateTime($datetime) {
    return date('d/m/Y H:i', strtotime($datetime));
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['user_role']) && 
           ($_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'manager');
}

function getCurrentUserId() {
    return $_SESSION['user_id'] ?? null;
}

function getCartCount() {
    return isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
}

/**
 * Lấy đường dẫn ảnh sản phẩm, nếu không tồn tại thì trả về placeholder
 * @param mixed $product Mảng chứa thông tin sản phẩm (có variant_id hoặc product_id) HOẶC variant_id/product_id trực tiếp
 * @param string $folder Thư mục chứa ảnh (mặc định: 'products')
 * @return string Đường dẫn ảnh
 */
function getProductImage($product, $folder = 'products') {
    // Xác định đường dẫn gốc của dự án
    $basePath = $_SERVER['DOCUMENT_ROOT'] . '/duann1';
    $imageName = null;
    
    // Xử lý tham số đầu vào
    if (is_array($product)) {
        // Nếu là mảng, ưu tiên variant_id, sau đó product_id
        $imageName = $product['variant_id'] ?? $product['product_id'] ?? null;
    } else {
        // Nếu là số hoặc chuỗi, dùng trực tiếp
        $imageName = $product;
    }
    
    // Nếu không có imageName, trả về placeholder ngay
    if (empty($imageName)) {
        return assetUrl('images/placeholder.jpg');
    }
    
    $imagePath = $basePath . '/assets/images/' . $folder . '/' . $imageName . '.jpg';
    
    // Kiểm tra file ảnh có tồn tại không
    if (file_exists($imagePath)) {
        return assetUrl('images/' . $folder . '/' . $imageName . '.jpg');
    }
    
    // Trả về placeholder nếu không tìm thấy
    return assetUrl('images/placeholder.jpg');
}

