<style>
.product-hero-carousel {
    margin-bottom: 30px;
    border-radius: 0 0 30px 30px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}
.product-hero-carousel .carousel-item {
    height: 400px;
    position: relative;
    overflow: hidden;
}
.product-hero-carousel .carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.7);
    transition: transform 0.5s ease, filter 0.5s ease;
}
.product-hero-carousel .carousel-item:hover img {
    transform: scale(1.05);
    filter: brightness(0.8);
}
.product-hero-carousel .carousel-item::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.2) 100%);
    z-index: 1;
}
.product-hero-carousel .carousel-caption {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 2;
    text-align: center;
    width: 100%;
    padding: 0 20px;
    background: rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 30px;
    max-width: 600px;
}
.product-hero-carousel .carousel-item.active .carousel-caption h1 {
    animation: slideInDown 0.8s ease;
}
.product-hero-carousel .carousel-item.active .carousel-caption p {
    animation: slideInUp 0.8s ease 0.2s both;
}
.product-hero-carousel .carousel-item.active .carousel-caption .btn {
    animation: slideInUp 0.8s ease 0.4s both;
}
.product-hero-carousel .carousel-caption h1 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}
.product-hero-carousel .carousel-caption p {
    font-size: 1rem;
    margin-bottom: 1.5rem;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
}
.product-hero-carousel .carousel-caption .btn {
    padding: 10px 25px;
    font-size: 1rem;
    border-radius: 50px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
}
@media (min-width: 768px) {
    .product-hero-carousel .carousel-caption h1 {
        font-size: 3rem;
    }
    .product-hero-carousel .carousel-caption p {
        font-size: 1.25rem;
    }
    .product-hero-carousel .carousel-caption .btn {
        padding: 12px 30px;
        font-size: 1.1rem;
    }
}
.product-hero-carousel .carousel-caption .btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.4);
}
.product-hero-carousel .carousel-control-prev,
.product-hero-carousel .carousel-control-next {
    width: 50px;
    height: 50px;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    backdrop-filter: blur(10px);
    opacity: 0.8;
    transition: all 0.3s ease;
}
.product-hero-carousel .carousel-control-prev:hover,
.product-hero-carousel .carousel-control-next:hover {
    opacity: 1;
    background: rgba(255,255,255,0.3);
}
.product-hero-carousel .carousel-control-prev {
    left: 20px;
}
.product-hero-carousel .carousel-control-next {
    right: 20px;
}
.product-hero-carousel .carousel-indicators {
    bottom: 20px;
}
.product-hero-carousel .carousel-indicators button {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255,255,255,0.5);
    border: 2px solid rgba(255,255,255,0.8);
    transition: all 0.3s ease;
}
.product-hero-carousel .carousel-indicators button.active {
    background: white;
    width: 30px;
    border-radius: 6px;
}
@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.filter-card {
    transition: all 0.3s ease;
    border: none;
    margin-bottom: 20px;
}
.filter-card:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
}
.filter-section {
    border-bottom: 1px solid #e9ecef;
    padding-bottom: 15px;
    margin-bottom: 15px;
}
.filter-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
}
.price-range-input {
    width: 100%;
}
.sort-view-bar {
    background: white;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    margin-bottom: 20px;
}
.view-toggle-btn {
    border: 1px solid #dee2e6;
    background: white;
    color: #6c757d;
    transition: all 0.3s;
}
.view-toggle-btn.active {
    background: #0d6efd;
    color: white;
    border-color: #0d6efd;
}
.view-toggle-btn:hover {
    background: #0d6efd;
    color: white;
    border-color: #0d6efd;
}
.product-card {
    animation: fadeInUp 0.5s ease forwards;
    opacity: 0;
}
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.product-card:nth-child(1) { animation-delay: 0.1s; }
.product-card:nth-child(2) { animation-delay: 0.2s; }
.product-card:nth-child(3) { animation-delay: 0.3s; }
.product-card:nth-child(4) { animation-delay: 0.4s; }
.product-card:nth-child(5) { animation-delay: 0.5s; }
.product-card:nth-child(6) { animation-delay: 0.6s; }
.list-group-item {
    transition: all 0.3s ease;
    border: none;
    border-left: 3px solid transparent;
}
.list-group-item:hover {
    background: #f8f9fa;
    border-left-color: #0d6efd;
    padding-left: 20px;
}
.list-group-item.active {
    background: #e7f1ff;
    border-left-color: #0d6efd;
    color: #0d6efd;
    font-weight: 600;
}
</style>

<div id="productHeroCarousel" class="carousel slide product-hero-carousel" data-bs-ride="carousel" data-bs-interval="4000">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#productHeroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#productHeroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#productHeroCarousel" data-bs-slide-to="2"></button>
        <button type="button" data-bs-target="#productHeroCarousel" data-bs-slide-to="3"></button>
    </div>
    <div class="carousel-inner">
        <!-- Slide 1: Sản Phẩm -->
        <div class="carousel-item active">
            <img src="<?= BASE_URL ?>public/images/banner1.jpg" class="d-block w-100" alt="Sản Phẩm" onerror="this.src='https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=1200&q=80'">
            <div class="carousel-caption">
                <h1 class="display-4 fw-bold">
                    <i class="bi bi-shop me-2"></i> Sản Phẩm
                </h1>
                <p class="lead">Khám phá bộ sưu tập điện thoại và phụ kiện đa dạng</p>
                <a href="#productsGrid" class="btn btn-light btn-lg">
                    <i class="bi bi-arrow-down-circle me-2"></i> Xem Ngay
                </a>
            </div>
        </div>
        
        <!-- Slide 2: Sản Phẩm Mới -->
        <div class="carousel-item">
            <img src="<?= BASE_URL ?>public/images/banner2.jpg" class="d-block w-100" alt="Sản Phẩm Mới" onerror="this.src='https://images.unsplash.com/photo-1592750475338-74b7b21085ab?w=1200&q=80'">
            <div class="carousel-caption">
                <h1 class="display-4 fw-bold">
                    <i class="bi bi-star-fill me-2"></i> Sản Phẩm Mới
                </h1>
                <p class="lead">Cập nhật những mẫu điện thoại mới nhất với công nghệ tiên tiến</p>
                <a href="<?= BASE_URL ?>product/index?sort=newest" class="btn btn-light btn-lg">
                    <i class="bi bi-arrow-right-circle me-2"></i> Khám Phá
                </a>
            </div>
        </div>
        
        <!-- Slide 3: Khuyến Mãi -->
        <div class="carousel-item">
            <img src="<?= BASE_URL ?>public/images/banner3.jpg" class="d-block w-100" alt="Khuyến Mãi" onerror="this.src='https://images.unsplash.com/photo-1556656793-08538906a9f8?w=1200&q=80'">
            <div class="carousel-caption">
                <h1 class="display-4 fw-bold">
                    <i class="bi bi-lightning-charge-fill me-2"></i> Khuyến Mãi Hot
                </h1>
                <p class="lead">Giảm giá lên đến 50% cho các sản phẩm bán chạy nhất</p>
                <a href="<?= BASE_URL ?>product/index?sort=price_asc" class="btn btn-light btn-lg">
                    <i class="bi bi-tag-fill me-2"></i> Mua Ngay
                </a>
            </div>
        </div>
        
        <!-- Slide 4: Thương Hiệu -->
        <div class="carousel-item">
            <img src="<?= BASE_URL ?>public/images/banner1.jpg" class="d-block w-100" alt="Thương Hiệu" onerror="this.src='https://images.unsplash.com/photo-1601784551446-20c9e07cdbdb?w=1200&q=80'">
            <div class="carousel-caption">
                <h1 class="display-4 fw-bold">
                    <i class="bi bi-award-fill me-2"></i> Thương Hiệu Nổi Bật
                </h1>
                <p class="lead">iPhone, Samsung, Xiaomi, OPPO và nhiều thương hiệu khác</p>
                <a href="<?= BASE_URL ?>product/index" class="btn btn-light btn-lg">
                    <i class="bi bi-grid-3x3-gap me-2"></i> Xem Tất Cả
                </a>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#productHeroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#productHeroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container mb-5">
    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-lg-3 col-md-4 mb-4">
            <form method="GET" action="<?= BASE_URL ?>product/index" id="filterForm">
                <!-- Categories -->
                <div class="card shadow-sm filter-card border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-list-ul me-2"></i> Danh Mục</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="<?= BASE_URL ?>product/index<?= !empty($_GET) ? '?' . http_build_query(array_diff_key($_GET, ['category_id' => ''])) : '' ?>" 
                           class="list-group-item list-group-item-action <?= empty($filters['category_id']) ? 'active' : '' ?>">
                            <i class="bi bi-grid me-2"></i> Tất Cả
                        </a>
                        <?php foreach ($categories as $category): ?>
                            <a href="<?= BASE_URL ?>product/index?<?= http_build_query(array_merge($_GET, ['category_id' => $category['category_id'], 'page' => 1])) ?>" 
                               class="list-group-item list-group-item-action <?= (isset($filters['category_id']) && $filters['category_id'] == $category['category_id']) ? 'active' : '' ?>">
                                <i class="bi bi-phone me-2"></i> <?= htmlspecialchars($category['category_name']) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Brands -->
                <?php if (!empty($brands)): ?>
                <div class="card shadow-sm filter-card border-0">
                    <div class="card-header bg-light">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-tag me-2"></i> Thương Hiệu</h5>
                    </div>
                    <div class="card-body">
                        <select name="brand" class="form-select" onchange="document.getElementById('filterForm').submit()">
                            <option value="">Tất cả thương hiệu</option>
                            <?php foreach ($brands as $brand): ?>
                                <option value="<?= htmlspecialchars($brand) ?>" <?= (isset($filters['brand']) && $filters['brand'] == $brand) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($brand) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Price Range -->
                <?php if ($priceRange && $priceRange['min_price']): ?>
                <div class="card shadow-sm filter-card border-0">
                    <div class="card-header bg-light">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-currency-dollar me-2"></i> Khoảng Giá</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label small">Từ:</label>
                            <input type="number" name="min_price" class="form-control form-control-sm" 
                                   placeholder="0" value="<?= $filters['min_price'] ?? '' ?>"
                                   min="0" max="<?= $priceRange['max_price'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Đến:</label>
                            <input type="number" name="max_price" class="form-control form-control-sm" 
                                   placeholder="<?= number_format($priceRange['max_price'], 0, ',', '.') ?>"
                                   value="<?= $filters['max_price'] ?? '' ?>"
                                   min="0" max="<?= $priceRange['max_price'] ?>">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-funnel me-1"></i> Áp Dụng
                        </button>
                    </div>
                </div>
                <?php endif; ?>

                <!-- In Stock -->
                <div class="card shadow-sm filter-card border-0">
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="in_stock" value="1" 
                                   id="inStock" <?= (isset($filters['in_stock']) && $filters['in_stock']) ? 'checked' : '' ?>
                                   onchange="document.getElementById('filterForm').submit()">
                            <label class="form-check-label" for="inStock">
                                <i class="bi bi-check-circle me-1"></i> Chỉ hiển thị còn hàng
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Search -->
                <div class="card shadow-sm filter-card border-0">
                    <div class="card-header bg-light">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-search me-2"></i> Tìm Kiếm</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= BASE_URL ?>product/search" method="GET">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control form-control-sm" 
                                       placeholder="Tên sản phẩm..." value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
                                <button class="btn btn-primary btn-sm" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Clear Filters -->
                <?php if (!empty($filters)): ?>
                <a href="<?= BASE_URL ?>product/index" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-x-circle me-1"></i> Xóa Bộ Lọc
                </a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Products -->
        <div class="col-lg-9 col-md-8">
            <!-- Sort and View Bar -->
            <div class="sort-view-bar">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-2 mb-md-0">
                        <div class="d-flex align-items-center">
                            <span class="text-muted me-2 small">Sắp xếp:</span>
                            <select name="sort" class="form-select form-select-sm" style="max-width: 200px;" 
                                    onchange="var url = new URL(window.location.href); url.searchParams.set('sort', this.value); url.searchParams.set('page', '1'); window.location.href = url.toString();">
                                <option value="newest" <?= ($sort == 'newest') ? 'selected' : '' ?>>Mới nhất</option>
                                <option value="price_asc" <?= ($sort == 'price_asc') ? 'selected' : '' ?>>Giá: Thấp → Cao</option>
                                <option value="price_desc" <?= ($sort == 'price_desc') ? 'selected' : '' ?>>Giá: Cao → Thấp</option>
                                <option value="name_asc" <?= ($sort == 'name_asc') ? 'selected' : '' ?>>Tên: A → Z</option>
                                <option value="name_desc" <?= ($sort == 'name_desc') ? 'selected' : '' ?>>Tên: Z → A</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <span class="text-muted small">
                            Hiển thị <strong><?= count($products) ?></strong> / <strong><?= $totalProducts ?></strong> sản phẩm
                        </span>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <?php if (empty($products)): ?>
                <div class="alert alert-info text-center py-5 shadow-sm">
                    <i class="bi bi-inbox fs-1 d-block mb-3 text-info"></i>
                    <h4 class="fw-bold">Không tìm thấy sản phẩm</h4>
                    <p class="text-muted">Vui lòng thử lại với bộ lọc khác hoặc từ khóa khác.</p>
                    <a href="<?= BASE_URL ?>product/index" class="btn btn-primary mt-3">
                        <i class="bi bi-arrow-left me-1"></i> Xem Tất Cả Sản Phẩm
                    </a>
                </div>
            <?php else: ?>
                <div class="row g-4" id="productsGrid" style="scroll-margin-top: 100px;">
                    <?php foreach ($products as $index => $product): ?>
                        <?php
                        require_once __DIR__ . '/../../models/ProductModel.php';
                        $productModel = new ProductModel();
                        $variants = $productModel->getProductVariants($product['product_id']);
                        if ($variants) {
                            $prices = array_column($variants, 'price');
                            $product['min_price'] = min($prices);
                            $product['max_price'] = max($prices);
                        } else {
                            $product['min_price'] = 0;
                            $product['max_price'] = 0;
                        }
                        ?>
                        <div class="col-lg-4 col-md-6 col-6">
                            <?php include __DIR__ . '/product_card.php'; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
                    <nav aria-label="Page navigation" class="mt-5">
                        <ul class="pagination justify-content-center">
                            <?php if ($page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php
                            $startPage = max(1, $page - 2);
                            $endPage = min($totalPages, $page + 2);
                            
                            if ($startPage > 1): ?>
                                <li class="page-item"><a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => 1])) ?>">1</a></li>
                                <?php if ($startPage > 2): ?>
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                    <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($endPage < $totalPages): ?>
                                <?php if ($endPage < $totalPages - 1): ?>
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                <?php endif; ?>
                                <li class="page-item"><a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $totalPages])) ?>"><?= $totalPages ?></a></li>
                            <?php endif; ?>

                            <?php if ($page < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Preserve other GET parameters when changing sort
    $('select[name="sort"]').on('change', function() {
        var url = new URL(window.location.href);
        url.searchParams.set('sort', $(this).val());
        url.searchParams.set('page', '1');
        window.location.href = url.toString();
    });
    
    // Trigger animations on carousel slide change
    var carousel = document.getElementById('productHeroCarousel');
    if (carousel) {
        carousel.addEventListener('slide.bs.carousel', function() {
            // Remove active class from all captions
            var captions = this.querySelectorAll('.carousel-caption h1, .carousel-caption p, .carousel-caption .btn');
            captions.forEach(function(el) {
                el.style.animation = 'none';
            });
        });
        
        carousel.addEventListener('slid.bs.carousel', function() {
            // Add animation to active slide
            var activeSlide = this.querySelector('.carousel-item.active');
            if (activeSlide) {
                var h1 = activeSlide.querySelector('.carousel-caption h1');
                var p = activeSlide.querySelector('.carousel-caption p');
                var btn = activeSlide.querySelector('.carousel-caption .btn');
                
                setTimeout(function() {
                    if (h1) h1.style.animation = 'slideInDown 0.8s ease';
                    if (p) p.style.animation = 'slideInUp 0.8s ease 0.2s both';
                    if (btn) btn.style.animation = 'slideInUp 0.8s ease 0.4s both';
                }, 50);
            }
        });
    }
    
    // Smooth scroll to products when clicking "Xem Ngay"
    $('a[href="#productsGrid"]').on('click', function(e) {
        e.preventDefault();
        var target = $('#productsGrid');
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 800);
        }
    });
});
</script>
