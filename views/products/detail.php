<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body text-center p-5">
                <i class="bi bi-phone fs-1 text-muted" style="font-size: 200px !important;"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <h1><?= htmlspecialchars($product['product_name']) ?></h1>
        <p class="text-muted">Thương hiệu: <?= htmlspecialchars($product['brand']) ?></p>
        <p class="text-muted">Danh mục: <?= htmlspecialchars($product['category_name']) ?></p>
        
        <hr>
        
        <h4>Mô Tả</h4>
        <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
        
        <hr>
        
        <h4>Chọn Phiên Bản</h4>
        <?php if (empty($variants)): ?>
            <div class="alert alert-warning">Sản phẩm hiện đang hết hàng.</div>
        <?php else: ?>
            <form id="addToCartForm" method="POST" action="<?= BASE_URL ?>cart/add">
                <div class="mb-3">
                    <?php foreach ($variants as $variant): ?>
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="variant_id" 
                                       id="variant_<?= $variant['variant_id'] ?>" 
                                       value="<?= $variant['variant_id'] ?>" required>
                                <label class="form-check-label" for="variant_<?= $variant['variant_id'] ?>">
                                    <strong><?= htmlspecialchars($variant['variant_name']) ?></strong><br>
                                    <small class="text-muted">
                                        Màu: <?= htmlspecialchars($variant['color']) ?> | 
                                        Bộ nhớ: <?= htmlspecialchars($variant['storage']) ?> | 
                                        Bảo hành: <?= $variant['warranty_months'] ?> tháng
                                    </small><br>
                                    <span class="text-primary fw-bold fs-5">
                                        <?= number_format($variant['price'], 0, ',', '.') ?> đ
                                    </span>
                                    <span class="badge bg-success ms-2">
                                        Còn <?= $variant['stock_quantity'] ?> sản phẩm
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="mb-3">
                    <label for="quantity" class="form-label">Số Lượng</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" 
                           value="1" min="1" max="10" required>
                </div>
                
                <button type="submit" class="btn btn-primary btn-lg w-100">
                    <i class="bi bi-cart-plus"></i> Thêm Vào Giỏ Hàng
                </button>
            </form>
        <?php endif; ?>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#addToCartForm').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = form.serialize() + '&ajax=1';
        
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#cart-count').text(response.cartCount);
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('Có lỗi xảy ra');
            }
        });
    });
});
</script>

