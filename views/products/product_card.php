<div class="card h-100 shadow-sm product-card">
    <a href="<?= BASE_URL ?>product/detail/<?= $product['product_id'] ?? '' ?>" class="text-decoration-none text-dark">
        <div class="card-body text-center p-3">
            <?php 
                $imgUrl = BASE_URL . "public/data/" . rawurlencode($product['product_name'] ?? 'default') . ".jpg";
            ?>
            <img src="<?= $imgUrl ?>" 
                 alt="<?= htmlspecialchars($product['product_name'] ?? 'Product') ?>" 
                 class="img-fluid mb-3" 
                 style="height: 180px; object-fit: contain;"
                 onerror="this.src='https://placehold.co/180x180?text=No+Image'">

            <p class="card-title fw-bold mb-1 text-truncate" title="<?= htmlspecialchars($product['product_name'] ?? 'N/A') ?>">
                <?= htmlspecialchars($product['product_name'] ?? 'Sản phẩm') ?>
            </p>
            
            <?php 
                // Lấy giá thấp nhất nếu có nhiều variants, hoặc giá mặc định
                $displayPrice = $product['min_price'] ?? $product['price'] ?? 0;
            ?>
            <div class="d-flex justify-content-center align-items-center mt-2">
                <span class="text-danger fw-bolder fs-5">
                    <?= number_format($displayPrice, 0, ',', '.') ?>₫
                </span>
                <?php if (isset($product['old_price'])): ?>
                    <del class="text-muted small ms-2"><?= number_format($product['old_price'], 0, ',', '.') ?>₫</del>
                <?php endif; ?>
            </div>
        </div>
    </a>
    
    <div class="card-footer bg-white border-0 text-center pb-3 pt-0">
        <a href="<?= BASE_URL ?>product/detail/<?= $product['product_id'] ?? '' ?>" class="btn btn-sm btn-primary w-100">
            <i class="bi bi-cart-plus me-1"></i> Chi tiết
        </a>
    </div>
</div>

<style>
/* CSS cho Product Card */
.product-card:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}
</style>