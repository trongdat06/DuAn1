<h2 class="mb-4">Giỏ Hàng</h2>

<?php if (empty($cartItems)): ?>
    <div class="alert alert-info">
        <h4>Giỏ hàng của bạn đang trống</h4>
        <a href="<?= BASE_URL ?>product/index" class="btn btn-primary">Tiếp Tục Mua Sắm</a>
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sản Phẩm</th>
                    <th>Giá</th>
                    <th>Số Lượng</th>
                    <th>Thành Tiền</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item): ?>
                <tr>
                    <td>
                        <strong><?= htmlspecialchars($item['product_name']) ?></strong><br>
                        <small class="text-muted">
                            <?= htmlspecialchars($item['variant_name']) ?> | 
                            Màu: <?= htmlspecialchars($item['color']) ?> | 
                            Bộ nhớ: <?= htmlspecialchars($item['storage']) ?>
                        </small>
                    </td>
                    <td><?= number_format($item['price'], 0, ',', '.') ?> đ</td>
                    <td>
                        <form method="POST" action="<?= BASE_URL ?>cart/update" class="d-inline">
                            <input type="hidden" name="variant_id" value="<?= $item['variant_id'] ?>">
                            <div class="input-group" style="width: 120px;">
                                <input type="number" name="quantity" class="form-control" 
                                       value="<?= $item['quantity'] ?>" min="1" max="<?= $item['stock_quantity'] ?>">
                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-arrow-repeat"></i>
                                </button>
                            </div>
                        </form>
                    </td>
                    <td class="fw-bold"><?= number_format($item['subtotal'], 0, ',', '.') ?> đ</td>
                    <td>
                        <a href="<?= BASE_URL ?>cart/remove/<?= $item['variant_id'] ?>" 
                           class="btn btn-danger btn-sm" 
                           onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"><strong>Tổng Tiền:</strong></td>
                    <td class="fw-bold text-primary fs-5"><?= number_format($total, 0, ',', '.') ?> đ</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
    
    <div class="text-end mt-4">
        <a href="<?= BASE_URL ?>product/index" class="btn btn-secondary me-2">Tiếp Tục Mua Sắm</a>
        <a href="<?= BASE_URL ?>cart/checkout" class="btn btn-primary btn-lg">Thanh Toán</a>
    </div>
<?php endif; ?>

