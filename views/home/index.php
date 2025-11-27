<div class="container mt-4">
    
    <div id="heroCarousel" class="carousel slide mb-5 shadow-sm rounded-3 overflow-hidden" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= BASE_URL ?>public/images/banner1.jpg" class="d-block w-100" alt="Banner 1" style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
                    <h5>Ưu Đãi Lên Đến 50%</h5>
                    <p>Chào mừng mùa tựu trường, giảm giá lớn cho các mẫu điện thoại mới nhất!</p>
                    <a href="<?= BASE_URL ?>product/index" class="btn btn-warning btn-sm">Mua Ngay</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?= BASE_URL ?>public/images/banner2.jpg" class="d-block w-100" alt="Banner 2" style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
                    <h5>Sản Phẩm Apple Chính Hãng</h5>
                    <p>Nhận ngay bộ quà tặng trị giá 2.000.000đ khi mua iPhone 15 Pro Max.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?= BASE_URL ?>public/images/banner3.jpg" class="d-block w-100" alt="Banner 3" style="height: 400px; object-fit: cover;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    
    <?php if (!empty($categories)): ?>
    <h3 class="fw-bold mb-4 text-center text-primary">Danh Mục Nổi Bật</h3>
    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3 mb-5 justify-content-center">
        <?php foreach ($categories as $category): ?>
        <div class="col">
            <a href="<?= BASE_URL ?>product/category/<?= $category['category_id'] ?>" class="text-decoration-none text-dark d-block text-center category-card p-3 rounded shadow-sm">
                <i class="bi bi-phone-fill fs-3 text-secondary mb-2"></i>
                <p class="mb-0 fw-bold small"><?= htmlspecialchars($category['category_name']) ?></p>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <h3 class="fw-bold mb-4 border-bottom pb-2"><i class="bi bi-star-fill text-warning me-2"></i> Sản Phẩm Nổi Bật</h3>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-5">
        <?php if (!empty($featuredProducts)): ?>
            <?php foreach ($featuredProducts as $product): ?>
                <div class="col">
                    <?php 
                        // Dòng fix lỗi: Include partial view và truyền biến $product vào
                      include __DIR__ . '/../products/product_card.php';
                    ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12"><div class="alert alert-warning">Chưa có sản phẩm nổi bật nào.</div></div>
        <?php endif; ?>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-5">
        <?php if (!empty($newProducts)): ?>
            <?php foreach ($newProducts as $product): ?>
                <div class="col">
                    <?php 
                        // Dòng fix lỗi tương tự: Include partial view và truyền biến $product vào
                        include __DIR__ . '/../products/product_card.php';
                    ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12"><div class="alert alert-warning">Chưa có sản phẩm mới nào.</div></div>
        <?php endif; ?>
    </div>

</div>

<style>
.category-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border: 1px solid #eee;
}
.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}
/* Cần CSS cho Product Card (nếu chưa có trong style.css) */
</style>