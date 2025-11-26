<div class="row">
    <div class="col-md-3">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-list-ul"></i> Danh Mục</h5>
            </div>
            <div class="list-group list-group-flush">
                <a href="<?= BASE_URL ?>product/index" class="list-group-item list-group-item-action active">
                    <i class="bi bi-grid"></i> Tất Cả
                </a>
                <?php foreach ($categories as $category): ?>
                <a href="<?= BASE_URL ?>product/category/<?= $category['category_id'] ?>" 
                   class="list-group-item list-group-item-action">
                    <i class="bi bi-phone"></i> <?= htmlspecialchars($category['category_name']) ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-search"></i> Tìm Kiếm</h5>
            </div>
            <div class="card-body">
                <form action="<?= BASE_URL ?>product/search" method="GET">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm...">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title mb-0">Tất Cả Sản Phẩm</h2>
            <div class="text-muted small">
                Tìm thấy <strong><?= count($products) ?></strong> sản phẩm
            </div>
        </div>
        
        <div class="row g-4">
            <?php if (empty($products)): ?>
            <div class="col-12">
                <div class="alert alert-info text-center py-5">
                    <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                    <h4>Không có sản phẩm nào</h4>
                    <p class="text-muted">Vui lòng thử lại với từ khóa khác hoặc chọn danh mục khác.</p>
                </div>
            </div>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                <?php
                require_once __DIR__ . '/../../models/ProductModel.php';
                $productModel = new ProductModel();
                $variants = $productModel->getProductVariants($product['product_id']);
                $firstVariant = $variants ? $variants[0] : null;
                $minPrice = $variants ? min(array_column($variants, 'price')) : 0;
                $maxPrice = $variants ? max(array_column($variants, 'price')) : 0;
                ?>
                <div class="col-lg-4 col-md-6 col-6">
                    <div class="product-card h-100 border rounded overflow-hidden position-relative shadow-sm">
                        <div class="product-image bg-light text-center p-4" style="height: 220px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                            <img src="./public/data/<?=$product['product_name']?>.jpg" alt="">
                            <?php if ($product['category_name'] == 'Điện thoại thông minh'): ?>
                            <span class="badge bg-primary position-absolute top-0 end-0 m-2">Hot</span>
                            <?php endif; ?>
                        </div>
                        <div class="product-info p-3">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="product-name fw-bold mb-0 flex-grow-1"><?= htmlspecialchars($product['product_name']) ?></h6>
                            </div>
                            <p class="text-muted small mb-2">
                                <i class="bi bi-tag"></i> <?= htmlspecialchars($product['brand']) ?>
                            </p>
                            <?php if ($firstVariant): ?>
                            <p class="text-muted small mb-2">
                                <i class="bi bi-hdd"></i> <?= htmlspecialchars($firstVariant['storage']) ?> | 
                                <i class="bi bi-palette"></i> <?= htmlspecialchars($firstVariant['color']) ?>
                            </p>
                            <?php endif; ?>
                            <div class="mb-2">
                                <?php if ($minPrice > 0): ?>
                                    <?php if ($minPrice == $maxPrice): ?>
                                    <p class="product-price text-primary fw-bold fs-5 mb-0">
                                        <?= number_format($minPrice, 0, ',', '.') ?>₫
                                    </p>
                                    <?php else: ?>
                                    <p class="product-price text-primary fw-bold fs-6 mb-0">
                                        Từ <?= number_format($minPrice, 0, ',', '.') ?>₫
                                    </p>
                                    <p class="text-muted small mb-0">
                                        Đến <?= number_format($maxPrice, 0, ',', '.') ?>₫
                                    </p>
                                    <?php endif; ?>
                                <?php else: ?>
                                <p class="text-danger small mb-0">Hết hàng</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="product-actions p-3 border-top bg-light">
                            <div class="d-flex gap-2">
                                <a href="<?= BASE_URL ?>product/detail/<?= $product['product_id'] ?>" class="btn btn-sm btn-outline-primary flex-grow-1">
                                    <i class="bi bi-eye"></i> Chi tiết
                                </a>
                                <?php if ($firstVariant && $firstVariant['stock_quantity'] > 0): ?>
                                <form method="POST" action="<?= BASE_URL ?>cart/add" class="d-inline">
                                    <input type="hidden" name="variant_id" value="<?= $firstVariant['variant_id'] ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-sm btn-primary" title="Thêm vào giỏ hàng">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                </form>
                                <?php else: ?>
                                <button class="btn btn-sm btn-secondary" disabled title="Hết hàng">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <?php if (count($products) > 0 && isset($page) && $page > 1): ?>
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page - 1 ?>">Trước</a>
                </li>
                <?php endif; ?>
                <li class="page-item active">
                    <span class="page-link"><?= $page ?></span>
                </li>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page + 1 ?>">Sau</a>
                </li>
            </ul>
        </nav>
        <?php endif; ?>
    </div>
</div>

<style>
.product-card {
    transition: all 0.3s ease;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.15) !important;
}

.product-image {
    transition: transform 0.3s ease;
}

.product-card:hover .product-image {
    transform: scale(1.05);
}

.product-name {
    min-height: 40px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.list-group-item-action:hover {
    background-color: #f8f9fa;
    color: #0d6efd;
}
</style>
