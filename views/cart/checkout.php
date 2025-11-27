<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Thanh Toán</h2>
    <a href="<?= BASE_URL ?>cart/index" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i> Quay Lại Giỏ Hàng
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-person-circle me-2"></i> Thông Tin Khách Hàng</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= BASE_URL ?>cart/processOrder" id="checkoutForm">
                    <?php 
                        // Auto-fill thông tin nếu đã đăng nhập
                        $customer = null;
                        if (isset($_SESSION['customer_id'])) {
                            require_once __DIR__ . '/../../models/CustomerModel.php';
                            $customerModel = new CustomerModel();
                            $customer = $customerModel->getCustomerById($_SESSION['customer_id']);
                        }
                    ?>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="full_name" class="form-label fw-bold">Họ và Tên <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" id="full_name" name="full_name" 
                                       value="<?= htmlspecialchars($customer['full_name'] ?? '') ?>"
                                       placeholder="Nguyễn Văn A" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone_number" class="form-label fw-bold">Số Điện Thoại <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                <input type="tel" class="form-control" id="phone_number" name="phone_number" 
                                       value="<?= htmlspecialchars($customer['phone_number'] ?? '') ?>"
                                       placeholder="0901234567" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?= htmlspecialchars($customer['email'] ?? '') ?>"
                                   placeholder="your@email.com" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label fw-bold">Địa Chỉ Giao Hàng <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="address" name="address" rows="3" 
                                  placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành phố" required><?= htmlspecialchars($customer['address'] ?? '') ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="payment_method" class="form-label fw-bold">Phương Thức Thanh Toán <span class="text-danger">*</span></label>
                        <div class="row g-2">
                            <div class="col-md-4">
                                <div class="form-check payment-option">
                                    <input class="form-check-input" type="radio" name="payment_method" id="payment_cash" value="Tiền mặt" checked>
                                    <label class="form-check-label w-100 p-3 border rounded" for="payment_cash" style="cursor: pointer;">
                                        <i class="bi bi-cash-coin fs-4 d-block mb-2 text-success"></i>
                                        <strong>Tiền mặt</strong>
                                        <small class="d-block text-muted">Thanh toán khi nhận hàng</small>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check payment-option">
                                    <input class="form-check-input" type="radio" name="payment_method" id="payment_bank" value="Chuyển khoản">
                                    <label class="form-check-label w-100 p-3 border rounded" for="payment_bank" style="cursor: pointer;">
                                        <i class="bi bi-bank fs-4 d-block mb-2 text-primary"></i>
                                        <strong>Chuyển khoản</strong>
                                        <small class="d-block text-muted">Ngân hàng</small>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check payment-option">
                                    <input class="form-check-input" type="radio" name="payment_method" id="payment_card" value="Thẻ tín dụng">
                                    <label class="form-check-label w-100 p-3 border rounded" for="payment_card" style="cursor: pointer;">
                                        <i class="bi bi-credit-card fs-4 d-block mb-2 text-warning"></i>
                                        <strong>Thẻ tín dụng</strong>
                                        <small class="d-block text-muted">Visa/Mastercard</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label fw-bold">Ghi Chú (Tùy chọn)</label>
                        <textarea class="form-control" id="note" name="note" rows="3" 
                                  placeholder="Ghi chú thêm cho đơn hàng..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100 py-3">
                        <i class="bi bi-check-circle me-2"></i> Xác Nhận Đặt Hàng
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card shadow-sm sticky-top" style="top: 20px;">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-receipt me-2"></i> Tóm Tắt Đơn Hàng</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <?php foreach ($cartItems as $item): ?>
                    <div class="list-group-item px-0 border-0">
                        <div class="d-flex align-items-start mb-2">
                            <?php 
                                $imgUrl = BASE_URL . "public/data/" . rawurlencode($item['product_name'] ?? 'default') . ".jpg";
                            ?>
                            <img src="<?= $imgUrl ?>" 
                                 alt="<?= htmlspecialchars($item['product_name']) ?>" 
                                 class="me-2 rounded" 
                                 style="width: 50px; height: 50px; object-fit: cover;"
                                 onerror="this.src='https://placehold.co/50x50?text=<?= urlencode($item['product_name'] ?? '') ?>'">
                            <div class="flex-grow-1">
                                <small class="fw-bold d-block"><?= htmlspecialchars($item['product_name']) ?></small>
                                <small class="text-muted">
                                    <?= htmlspecialchars($item['variant_name']) ?> | x<?= $item['quantity'] ?>
                                </small>
                            </div>
                            <small class="text-primary fw-bold">
                                <?= number_format($item['subtotal'], 0, ',', '.') ?>₫
                            </small>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="fw-bold fs-5">Tổng Tiền:</span>
                    <span class="text-danger fw-bold fs-4"><?= number_format($total, 0, ',', '.') ?>₫</span>
                </div>
                <div class="alert alert-info mb-0 small">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Lưu ý:</strong> Đơn hàng sẽ được xử lý trong vòng 24h. Chúng tôi sẽ liên hệ với bạn để xác nhận.
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.payment-option input[type="radio"] {
    display: none;
}

.payment-option label {
    transition: all 0.3s ease;
}

.payment-option input[type="radio"]:checked + label {
    background-color: #e7f3ff;
    border-color: #0d6efd !important;
    border-width: 2px;
    transform: scale(1.02);
}

.payment-option label:hover {
    background-color: #f8f9fa;
    border-color: #0d6efd;
}
</style>

<script>
$(document).ready(function() {
    // Payment option click
    $('.payment-option label').on('click', function() {
        var radio = $(this).prev('input[type="radio"]');
        radio.prop('checked', true);
        $('.payment-option label').removeClass('border-primary');
        $(this).addClass('border-primary');
    });
    
    // Form validation
    $('#checkoutForm').on('submit', function(e) {
        var btn = $(this).find('button[type="submit"]');
        var originalText = btn.html();
        
        // Validate
        var fullName = $('#full_name').val().trim();
        var phone = $('#phone_number').val().trim();
        var email = $('#email').val().trim();
        var address = $('#address').val().trim();
        
        if (!fullName || !phone || !email || !address) {
            e.preventDefault();
            alert('Vui lòng điền đầy đủ thông tin bắt buộc');
            return false;
        }
        
        // Phone validation
        var phoneRegex = /^[0-9]{10,11}$/;
        if (!phoneRegex.test(phone.replace(/\s/g, ''))) {
            e.preventDefault();
            alert('Số điện thoại không hợp lệ. Vui lòng nhập 10-11 chữ số');
            return false;
        }
        
        // Email validation
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            e.preventDefault();
            alert('Email không hợp lệ');
            return false;
        }
        
        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Đang xử lý...');
        
        // Timeout để reset nếu có lỗi
        setTimeout(function() {
            btn.prop('disabled', false).html(originalText);
        }, 10000);
    });
});
</script>

