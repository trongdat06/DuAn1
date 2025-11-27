<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle . ' - ' : '' ?><?= SITE_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= BASE_URL ?>home/index">
                <span class="text-warning">MIVON</span><span class="text-dark">STORE</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>home/index">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>product/index">Sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>page/about">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>page/contact">Liên hệ</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <form class="d-flex me-3" action="<?= BASE_URL ?>product/search" method="GET">
                        <div class="input-group" style="width: 300px;">
                            <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm điện thoại...">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                    <a class="nav-link position-relative me-3" href="<?= BASE_URL ?>cart/index">
                        <i class="bi bi-cart fs-4"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cart-count">
                            <?php
                            try {
                                require_once __DIR__ . '/../../models/CartModel.php';
                                $cartModel = new CartModel();
                                echo $cartModel->getCartCount();
                            } catch (Exception $e) {
                                echo 0;
                            }
                            ?>
                        </span>
                    </a>
                    <?php if (isset($_SESSION['customer_id'])): ?>
                        <!-- Customer logged in -->
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="customerMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> <?= htmlspecialchars($_SESSION['customer_name'] ?? 'Khách hàng') ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="customerMenu">
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>customer/profile">
                                    <i class="bi bi-person"></i> Tài Khoản
                                </a></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>customer/orders">
                                    <i class="bi bi-bag"></i> Đơn Hàng
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>auth/logout">
                                    <i class="bi bi-box-arrow-right"></i> Đăng Xuất
                                </a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <!-- Guest user -->
                        <a class="nav-link" href="<?= BASE_URL ?>auth/login" title="Đăng nhập">
                            <i class="bi bi-person fs-4"></i>
                        </a>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['admin_id'])): ?>
                    <a class="nav-link ms-2" href="<?= BASE_URL ?>admin/dashboard">
                        <small>Admin</small>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['success'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION['error'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

