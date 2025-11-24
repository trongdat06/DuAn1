<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main>
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Chào mừng đến với Cửa hàng Điện thoại</h1>
            <p>Nơi cung cấp các sản phẩm điện thoại và phụ kiện chính hãng</p>
            <a href="/products.php" class="btn btn-primary btn-large">Xem sản phẩm</a>
        </div>
    </section>

    <!-- Categories -->
    <section class="categories">
        <div class="container">
            <h2>Danh mục sản phẩm</h2>
            <div class="category-grid">
                <?php foreach ($categories as $category): ?>
                    <div class="category-card">
                        <h3><?php echo htmlspecialchars($category['category_name']); ?></h3>
                        <p><?php echo htmlspecialchars($category['description'] ?? ''); ?></p>
                        <a href="/products.php?category=<?php echo $category['category_id']; ?>" class="btn btn-secondary">Xem sản phẩm</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="featured-products">
        <div class="container">
            <h2>Sản phẩm nổi bật</h2>
            <div class="product-grid">
                <?php foreach ($featuredProducts as $product): ?>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="<?php echo getProductImage($product); ?>" 
                                 alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                        </div>
                        <div class="product-info">
                            <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
                            <p class="product-brand"><?php echo htmlspecialchars($product['brand']); ?></p>
                            <p class="product-variant"><?php echo htmlspecialchars($product['variant_name']); ?></p>
                            <p class="product-price"><?php echo formatCurrency($product['price']); ?></p>
                            <div class="product-actions">
                                <a href="/product-detail.php?id=<?php echo $product['variant_id']; ?>" class="btn btn-primary">Xem chi tiết</a>
                                <button class="btn btn-cart" onclick="addToCart(<?php echo $product['variant_id']; ?>)">Thêm vào giỏ</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

