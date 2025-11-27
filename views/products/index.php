<div class="container mt-5">
    
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-list-ul me-2"></i> Danh Mục</h5>
                </div>
                <div class="list-group list-group-flush">
                    <?php 
                        // Giả định $current_category_id được truyền vào View nếu đang lọc
                        $current_category_id = $current_category_id ?? null;
                    ?>
                    <a href="<?= BASE_URL ?>product/index" class="list-group-item list-group-item-action <?= is_null($current_category_id) ? 'active' : '' ?>">
                        <i class="bi bi-grid me-2"></i> Tất Cả Sản Phẩm
                    </a>
                    <?php foreach ($categories as $category): ?>
                        <a href="<?= BASE_URL ?>product/category/<?= $category['category_id'] ?>"
                            class="list-group-item list-group-item-action <?= ($category['category_id'] == $current_category_id) ? 'active' : '' ?>">
                            <i class="bi bi-phone me-2"></i> <?= htmlspecialchars($category['category_name']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-light">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-search me-2"></i> Tìm Kiếm</h5>
                </div>
                <div class="card-body">
                    <form action="<?= BASE_URL ?>product/search" method="GET">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control" placeholder="Nhập tên sản phẩm..." value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="alert alert-warning mt-4 small border-0 shadow-sm" role="alert">
                <i class="bi bi-lightning-charge-fill"></i> **Khuyến mãi:** Miễn phí vận chuyển cho đơn hàng trên 5 triệu!
            </div>
        </div>

        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                <h2 class="section-title mb-0 fw-bold text-primary">
                    <i class="bi bi-shop me-2"></i> Tất Cả Sản Phẩm
                </h2>
                <div class="text-muted small">
                    Tìm thấy **<?= count($products) ?>** sản phẩm
                </div>
            </div>

            <div class="row g-4">
                <?php if (empty($products)): ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center py-5 shadow-sm">
                            <i class="bi bi-inbox fs-1 d-block mb-3 text-info"></i>
                            <h4 class="fw-bold">Không có sản phẩm nào</h4>
                            <p class="text-muted">Vui lòng thử lại với từ khóa khác hoặc chọn danh mục khác.</p>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>
                        <?php
                        // !!! LƯU Ý: Đoạn code này được giữ lại TẠM THỜI để chạy trong môi trường PHP đơn giản
                        // Trong MVC chuyên nghiệp, DỮ LIỆU NÀY PHẢI ĐƯỢC CHUẨN BỊ TRONG CONTROLLER.
                        // Yêu cầu: Đảm bảo class ProductModel tồn tại và có thể truy cập được.
                        require_once __DIR__ . '/../../models/ProductModel.php';
                        $productModel = new ProductModel();
                        $variants = $productModel->getProductVariants($product['product_id']);
                        $firstVariant = $variants ? $variants[0] : null;
                        $minPrice = $variants ? min(array_column($variants, 'price')) : 0;
                        $maxPrice = $variants ? max(array_column($variants, 'price')) : 0;
                        // Hết Lưu ý
                        ?>
                        <div class="col-lg-4 col-md-6 col-6">
                            <div class="product-card h-100 border rounded overflow-hidden position-relative shadow-sm">
                                
                                <a href="<?= BASE_URL ?>product/detail/<?= $product['product_id'] ?>" class="text-decoration-none text-dark">
                                    <div class="product-image text-center p-3" style="height: 220px; display: flex; align-items: center; justify-content: center; background: #f8f9fa;">
                                        <?php 
                                            $imagePath = BASE_URL . "public/data/" . str_replace(' ', '_', $product['product_name']) . ".jpg"; 
                                            // Sử dụng image tag để gợi ý cho người dùng thêm hình ảnh thực tế
                                            // ) ?>]
                                        ?>
                                        <img src="<?= $imagePath ?>" 
                                            alt="<?= htmlspecialchars($product['product_name']) ?>" 
                                            class="img-fluid" 
                                            style="max-height: 100%; object-fit: contain;"
                                            onerror="this.onerror=null; this.src='<?= BASE_URL ?>public/images/default_phone.png'">
                                        
                                        <?php if ($product['category_name'] == 'Điện thoại thông minh' || $minPrice < 10000000): ?>
                                            <span class="badge bg-danger position-absolute top-0 end-0 m-2 rounded-pill">SALE</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="product-info p-3">
                                        <h6 class="product-name fw-bold mb-1" title="<?= htmlspecialchars($product['product_name']) ?>">
                                            <?= htmlspecialchars($product['product_name']) ?>
                                        </h6>
                                        <p class="text-muted small mb-2">
                                            <i class="bi bi-tag"></i> Hãng: <?= htmlspecialchars($product['brand'] ?? 'N/A') ?>
                                        </p>
                                        
                                        <div class="mb-2">
                                            <?php if ($minPrice > 0): ?>
                                                <?php if ($minPrice == $maxPrice): ?>
                                                    <p class="product-price text-primary fw-bolder fs-5 mb-0">
                                                        <?= number_format($minPrice, 0, ',', '.') ?>₫
                                                    </p>
                                                <?php else: ?>
                                                    <p class="product-price text-primary fw-bold fs-6 mb-0">
                                                        Từ <?= number_format($minPrice, 0, ',', '.') ?>₫
                                                    </p>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <p class="text-danger small mb-0 fw-bold">Hết hàng</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </a>
                                
                                <div class="product-actions p-3 border-top bg-light">
                                    <div class="d-flex gap-2">
                                        <a href="<?= BASE_URL ?>product/detail/<?= $product['product_id'] ?>" class="btn btn-sm btn-outline-primary flex-grow-1">
                                            <i class="bi bi-eye"></i> Chi tiết
                                        </a>
                                        <?php if ($firstVariant && $firstVariant['stock_quantity'] > 0): ?>
                                            <form method="POST" action="<?= BASE_URL ?>cart/add" class="d-inline">
                                                <input type="hidden" name="variant_id" value="<?= $firstVariant['variant_id'] ?>">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn btn-sm btn-primary" title="Thêm nhanh vào giỏ hàng">
                                                    <i class="bi bi-cart-plus"></i> Thêm
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <button class="btn btn-sm btn-secondary" disabled title="Hết hàng">
                                                <i class="bi bi-x-circle"></i> Hết hàng
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?php 
                // Biến $page, $totalPages cần được Controller cung cấp
                $page = $page ?? 1;
                $totalPages = $totalPages ?? 10; // Giả định
            ?>
            <?php if (count($products) > 0 && $totalPages > 1): ?>
                <nav aria-label="Page navigation" class="mt-5">
                    <ul class="pagination justify-content-center shadow-sm rounded">
                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $page - 1 ?>&keyword=<?= htmlspecialchars($_GET['keyword'] ?? '') ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>&keyword=<?= htmlspecialchars($_GET['keyword'] ?? '') ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $page + 1 ?>&keyword=<?= htmlspecialchars($_GET['keyword'] ?? '') ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
/* ... (Giữ nguyên CSS bạn đã cung cấp, nó khá tốt) ... */
    .product-card {
        transition: all 0.3s ease;
        border: 1px solid #e9ecef !important;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }
    
    .product-image img {
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-image img {
        transform: scale(1.05);
    }
    
    .product-name {
        min-height: 40px; /* Đảm bảo chiều cao nhất quán cho tên 2 dòng */
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    .page-link {
        color: #0d6efd;
    }
</style>