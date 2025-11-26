<?php
require_once dirname(__DIR__) . "/layouts/header.php";
?>

<!-- Hero Section with Search Sidebar & Thumbnails -->
<div class="row mb-5">
    <!-- Left Sidebar: Search & Filter -->
    <div class="col-lg-3 col-md-4 mb-4">
        <div class="card shadow-sm sticky-top" style="top: 20px;">
            <div class="card-body">
                <h5 class="card-title mb-4">
                    <i class="bi bi-funnel"></i> Tìm Kiếm & Lọc
                </h5>
                
                <!-- Search Input -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Tìm kiếm</label>
                    <form action="<?= BASE_URL ?>product/search" method="GET">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control" placeholder="Nhập tên sản phẩm...">
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Category Filter -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Danh mục</label>
                    <?php if (!empty($categories)): ?>
                        <div class="list-group list-group-flush">
                            <a href="<?= BASE_URL ?>product/index" class="list-group-item list-group-item-action">
                                <i class="bi bi-box"></i> Tất cả sản phẩm
                            </a>
                            <?php foreach (array_slice($categories, 0, 8) as $category): ?>
                            <a href="<?= BASE_URL ?>product/category/<?= $category['category_id'] ?>" class="list-group-item list-group-item-action">
                                <i class="bi bi-tag"></i> <?= htmlspecialchars($category['category_name']) ?>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Price Range Filter -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Khoảng giá</label>
                    <div class="list-group list-group-flush">
                        <a href="<?= BASE_URL ?>product/index" class="list-group-item list-group-item-action">
                            <i class="bi bi-cash"></i> Dưới 5 triệu
                        </a>
                        <a href="<?= BASE_URL ?>product/index" class="list-group-item list-group-item-action">
                            <i class="bi bi-cash"></i> 5 - 10 triệu
                        </a>
                        <a href="<?= BASE_URL ?>product/index" class="list-group-item list-group-item-action">
                            <i class="bi bi-cash"></i> 10 - 20 triệu
                        </a>
                        <a href="<?= BASE_URL ?>product/index" class="list-group-item list-group-item-action">
                            <i class="bi bi-cash"></i> Trên 20 triệu
                        </a>
                    </div>
                </div>

                <!-- Promotion Badge -->
                <div class="alert alert-warning small">
                    <i class="bi bi-star"></i> <strong>Khuyến mãi hot:</strong><br>
                    Giảm giá lên đến 40% cho sản phẩm chọn lọc
                </div>
            </div>
        </div>
    </div>

    <!-- Right: Featured Thumbnails Grid -->
    <div class="col-lg-9 col-md-8">
        <div class="row g-3">
            <h5 class="col-12 mb-0">
                <i class="bi bi-images"></i> Sản Phẩm Tiêu Biểu
            </h5>
            <?php if (!empty($featuredProducts)): ?>
                <?php foreach (array_slice($featuredProducts, 0, 6) as $product): ?>
                <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                    <a href="<?= BASE_URL ?>product/detail/<?= $product['product_id'] ?>" class="text-decoration-none">
                        <div class="card h-100 thumbnail-card shadow-sm overflow-hidden">
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center position-relative" style="height: 180px; overflow: hidden;">
                                <div class="text-center w-100">
                                    <i class="bi bi-image text-secondary" style="font-size: 48px;"></i>
                                </div>
                                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-0 thumbnail-overlay d-flex align-items-center justify-content-center" style="transition: all 0.3s;">
                                    <i class="bi bi-eye text-white" style="font-size: 32px; opacity: 0;"></i>
                                </div>
                            </div>
                            <div class="card-body p-2">
                                <h6 class="card-title text-truncate" style="font-size: 13px;">
                                    <?= htmlspecialchars($product['product_name']) ?>
                                </h6>
                                <p class="text-primary fw-bold mb-0" style="font-size: 14px;">
                                    Từ <?= number_format($product['min_price'] ?? 0, 0, ',', '.') ?> đ
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Featured Products Section -->
<section class="mb-5">
    <h3 class="mb-4">
        <i class="bi bi-star-fill text-warning"></i> Sản Phẩm Nổi Bật
    </h3>
    <div class="row g-4">
        <?php if (!empty($featuredProducts)): ?>
            <?php foreach ($featuredProducts as $product): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="card h-100 product-card shadow-sm hover-shadow transition">
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px; overflow: hidden;">
                        <div class="text-center">
                            <i class="bi bi-image text-secondary" style="font-size: 48px;"></i>
                            <p class="text-muted mt-2 small">Hình ảnh sản phẩm</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-truncate">
                            <?= htmlspecialchars($product['product_name']) ?>
                        </h5>
                        <p class="text-muted small mb-2">
                            <span class="badge bg-light text-dark">
                                <?= htmlspecialchars($product['brand']) ?>
                            </span>
                        </p>
                        <?php if (isset($product['min_price'])): ?>
                        <p class="text-primary fw-bold fs-5 mb-3">
                            Từ <?= number_format($product['min_price'], 0, ',', '.') ?> đ
                        </p>
                        <?php endif; ?>
                        <a href="<?= BASE_URL ?>product/detail/<?= $product['product_id'] ?>" class="btn btn-outline-primary btn-sm w-100 mb-2">
                            <i class="bi bi-eye"></i> Xem Chi Tiết
                        </a>
                        <button class="btn btn-warning btn-sm w-100" onclick="addToCart(<?= $product['variant_id'] ?>)">
                            <i class="bi bi-cart-plus"></i> Thêm Giỏ
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle"></i> Chưa có sản phẩm nổi bật
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Best-Selling Products Section -->
<section class="mb-5">
    <h3 class="mb-4">
        <i class="bi bi-fire text-danger"></i> Sản Phẩm Bán Chạy
    </h3>
    <div class="row g-4">
        <?php if (!empty($bestSellingProducts)): ?>
            <?php foreach ($bestSellingProducts as $product): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="card h-100 product-card shadow-sm hover-shadow transition">
                    <div class="position-relative">
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px; overflow: hidden;">
                            <div class="text-center">
                                <i class="bi bi-image text-secondary" style="font-size: 48px;"></i>
                                <p class="text-muted mt-2 small">Hình ảnh sản phẩm</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-truncate">
                            <?= htmlspecialchars($product['product_name']) ?>
                        </h5>
                        <p class="text-muted small mb-2">
                            <span class="badge bg-light text-dark">
                                <?= htmlspecialchars($product['brand']) ?>
                            </span>
                        </p>
                        <?php if (isset($product['min_price'])): ?>
                        <p class="text-danger fw-bold fs-5 mb-3">
                            Từ <?= number_format($product['min_price'], 0, ',', '.') ?> đ
                        </p>
                        <?php endif; ?>
                        <a href="<?= BASE_URL ?>product/detail/<?= $product['product_id'] ?>" class="btn btn-outline-danger btn-sm w-100 mb-2">
                            <i class="bi bi-eye"></i> Xem Chi Tiết
                        </a>
                        <button class="btn btn-danger btn-sm w-100" onclick="addToCart(<?= $product['variant_id'] ?>)">
                            <i class="bi bi-cart-plus"></i> Thêm Giỏ
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle"></i> Chưa có sản phẩm bán chạy
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Call to Action Section -->
<section class="bg-light py-5 rounded mb-5">
    <div class="container">
        <div class="text-center">
            <h3 class="mb-3">Khám Phá Thêm Sản Phẩm</h3>
            <p class="fs-5 text-muted mb-4">Đầy đủ các dòng điện thoại mới nhất với giá cạnh tranh</p>
            <a href="<?= BASE_URL ?>product/index" class="btn btn-primary btn-lg">
                <i class="bi bi-shop"></i> Xem Tất Cả Sản Phẩm
            </a>
        </div>
    </div>
</section>

<?php
require_once dirname(__DIR__) . "/layouts/footer.php";
?>

<style>
.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
}

.card-img-top {
    background-color: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
}

.carousel-item {
    min-height: 400px;
}

.hover-shadow {
    transition: box-shadow 0.3s ease;
}

.transition {
    transition: all 0.3s ease;
}

/* Thumbnail Card Styles */
.thumbnail-card {
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
    cursor: pointer;
}

.thumbnail-card:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12) !important;
    border-color: #007bff;
}

.thumbnail-card:hover .thumbnail-overlay {
    background-color: rgba(0, 0, 0, 0.4) !important;
}

.thumbnail-card:hover .thumbnail-overlay i {
    opacity: 1 !important;
}

.sticky-top {
    z-index: 100;
}

/* Search sidebar responsive */
@media (max-width: 768px) {
    .sticky-top {
        position: static !important;
    }
}
</style>

<script>
function addToCart(variantId) {
    if (!variantId) {
        alert('Vui lòng chọn sản phẩm');
        return;
    }
    
    $.ajax({
        url: '<?= BASE_URL ?>cart/add',
        type: 'POST',
        data: {
            variant_id: variantId,
            quantity: 1
        },
        success: function(response) {
            // Update cart count
            $.get('<?= BASE_URL ?>cart/getCount', function(count) {
                $('#cart-count').text(count);
            });
            alert('Đã thêm sản phẩm vào giỏ hàng');
        },
        error: function() {
            alert('Có lỗi xảy ra, vui lòng thử lại');
        }
    });
}
</script>
