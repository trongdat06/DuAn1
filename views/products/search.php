<div class="row">
    <div class="col-md-3">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-list-ul"></i> Danh Mục</h5>
            </div>
            <div class="list-group list-group-flush">
                <a href="<?= BASE_URL ?>product/index" class="list-group-item list-group-item-action">Tất Cả</a>
                <?php foreach ($categories as $category): ?>
                <a href="<?= BASE_URL ?>product/category/<?= $category['category_id'] ?>" 
                   class="list-group-item list-group-item-action">
                    <i class="bi bi-phone"></i> <?= htmlspecialchars($category['category_name']) ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title mb-0">Kết Quả Tìm Kiếm: "<span class="text-primary"><?= htmlspecialchars($keyword) ?></span>"</h2>
            <div class="text-muted small">
                Tìm thấy <strong><?= count($products) ?></strong> sản phẩm
            </div>
        </div>
        
        <div class="row g-4">
            <?php if (empty($products)): ?>
            <div class="col-12">
                <div class="alert alert-info text-center py-5">
                    <i class="bi bi-search fs-1 d-block mb-3"></i>
                    <h4>Không tìm thấy sản phẩm nào</h4>
                    <p class="text-muted">Vui lòng thử lại với từ khóa khác hoặc <a href="<?= BASE_URL ?>product/index">xem tất cả sản phẩm</a>.</p>
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
                $product['min_price'] = $minPrice;
                ?>
                <div class="col-lg-4 col-md-6 col-6">
                    <?php include __DIR__ . '/product_card.php'; ?>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

