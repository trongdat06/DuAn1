<h2 class="mb-4">Thanh Toán</h2>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Thông Tin Khách Hàng</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= BASE_URL ?>cart/processOrder">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="full_name" class="form-label">Họ và Tên *</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone_number" class="form-label">Số Điện Thoại *</label>
                            <input type="tel" class="form-control" id="phone_number" name="phone_number" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa Chỉ *</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Phương Thức Thanh Toán *</label>
                        <select class="form-select" id="payment_method" name="payment_method" required>
                            <option value="Tiền mặt">Tiền mặt</option>
                            <option value="Chuyển khoản">Chuyển khoản</option>
                            <option value="Thẻ tín dụng">Thẻ tín dụng</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Ghi Chú</label>
                        <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100">Đặt Hàng</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Đơn Hàng</h5>
            </div>
            <div class="card-body">
                <?php foreach ($cartItems as $item): ?>
                <div class="d-flex justify-content-between mb-2">
                    <div>
                        <small><?= htmlspecialchars($item['product_name']) ?></small><br>
                        <small class="text-muted">x<?= $item['quantity'] ?></small>
                    </div>
                    <div class="text-end">
                        <small><?= number_format($item['subtotal'], 0, ',', '.') ?> đ</small>
                    </div>
                </div>
                <?php endforeach; ?>
                <hr>
                <div class="d-flex justify-content-between">
                    <strong>Tổng Tiền:</strong>
                    <strong class="text-primary"><?= number_format($total, 0, ',', '.') ?> đ</strong>
                </div>
            </div>
        </div>
    </div>
</div>

