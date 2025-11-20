<?php require_once __DIR__ . '/../helpers.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Cửa hàng Điện thoại'; ?></title>
    <link rel="stylesheet" href="<?php echo assetUrl('css/style.css'); ?>">
    <?php if (isset($admin) && $admin): ?>
    <link rel="stylesheet" href="<?php echo assetUrl('css/admin.css'); ?>">
    <?php endif; ?>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <a href="<?php echo baseUrl('index.php'); ?>">
                        <h1>📱 Phone Store</h1>
                    </a>
                </div>
                <nav class="main-nav">
                    <a href="<?php echo baseUrl('index.php'); ?>">Trang chủ</a>
                    <a href="<?php echo baseUrl('products.php'); ?>">Sản phẩm</a>
                    <?php if (isLoggedIn()): ?>
                        <a href="<?php echo baseUrl('orders.php'); ?>">Đơn hàng của tôi</a>
                        <?php if (isAdmin()): ?>
                            <a href="<?php echo baseUrl('admin/dashboard.php'); ?>">Quản trị</a>
                        <?php endif; ?>
                        <a href="<?php echo baseUrl('cart.php'); ?>">Giỏ hàng (<?php echo getCartCount(); ?>)</a>
                        <a href="<?php echo baseUrl('auth/logout.php'); ?>">Đăng xuất</a>
                        <span>Xin chào, <?php echo htmlspecialchars($_SESSION['full_name'] ?? 'User'); ?></span>
                    <?php else: ?>
                        <a href="<?php echo baseUrl('cart.php'); ?>">Giỏ hàng (<?php echo getCartCount(); ?>)</a>
                        <a href="<?php echo baseUrl('auth/login.php'); ?>">Đăng nhập</a>
                        <a href="<?php echo baseUrl('auth/register.php'); ?>">Đăng ký</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>

