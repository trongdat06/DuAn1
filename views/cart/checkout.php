<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<style>
.checkout-card {
    border-radius: 15px;
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    margin-bottom: 20px;
}
.checkout-card-header {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
    border-radius: 15px 15px 0 0 !important;
    padding: 20px 25px;
}
.form-control:focus,
.form-select:focus,
textarea:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
}
.payment-option {
    position: relative;
}
.payment-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}
.payment-option label {
    display: block;
    padding: 20px;
    border: 2px solid #dee2e6;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s;
    text-align: center;
    background: white;
}
.payment-option label:hover {
    border-color: #dc3545;
    background: #fff5f5;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
.payment-option input[type="radio"]:checked + label {
    border-color: #dc3545;
    background: #fff5f5;
    border-width: 3px;
    box-shadow: 0 5px 20px rgba(220, 53, 69, 0.2);
}
.payment-icon {
    font-size: 2.5rem;
    margin-bottom: 10px;
}
.summary-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    position: sticky;
    top: 100px;
}
.summary-item {
    display: flex;
    justify-content: space-between;
    padding: 15px 0;
    border-bottom: 1px solid #e9ecef;
}
.summary-item:last-child {
    border-bottom: none;
}
.summary-product {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #f0f0f0;
}
.summary-product:last-child {
    border-bottom: none;
}
.summary-product img {
    width: 60px;
    height: 60px;
    object-fit: contain;
    border-radius: 8px;
    background: #f8f9fa;
    padding: 5px;
}
.summary-total {
    font-size: 1.8rem;
    font-weight: 800;
    color: #dc3545;
}
.btn-checkout {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    border: none;
    padding: 15px 30px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s;
}
.btn-checkout:hover {
    background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(220, 53, 69, 0.3);
}
.step-indicator {
    display: flex;
    justify-content: space-between;
    margin-bottom: 40px;
    position: relative;
}
.step-indicator::before {
    content: '';
    position: absolute;
    top: 20px;
    left: 0;
    right: 0;
    height: 2px;
    background: #e9ecef;
    z-index: 0;
}
.step {
    position: relative;
    z-index: 1;
    text-align: center;
    flex: 1;
}
.step-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: white;
    border: 3px solid #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    font-weight: bold;
    color: #6c757d;
    transition: all 0.3s;
}
.step.active .step-circle {
    background: #dc3545;
    border-color: #dc3545;
    color: white;
}
.step.completed .step-circle {
    background: #28a745;
    border-color: #28a745;
    color: white;
}
.step-label {
    font-size: 0.9rem;
    color: #6c757d;
    font-weight: 500;
}
.step.active .step-label {
    color: #dc3545;
    font-weight: 600;
}
</style>

<div class="container mb-5 mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <div>
            <h2 class="fw-bold mb-2">
                <i class="bi bi-cart-check me-2 text-danger"></i>Thanh Toán
            </h2>
            <p class="text-muted mb-0">Hoàn tất đơn hàng của bạn</p>
        </div>
        <a href="<?= BASE_URL ?>cart/index" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i> Quay Lại Giỏ Hàng
        </a>
    </div>
    <!-- Step Indicator -->
    <div class="step-indicator">
        <div class="step completed">
            <div class="step-circle">
                <i class="bi bi-check"></i>
            </div>
            <div class="step-label">Giỏ Hàng</div>
        </div>
        <div class="step active">
            <div class="step-circle">2</div>
            <div class="step-label">Thanh Toán</div>
        </div>
        <div class="step">
            <div class="step-circle">3</div>
            <div class="step-label">Hoàn Tất</div>
        </div>
    </div>

    <div class="row">
        <!-- Checkout Form -->
        <div class="col-lg-8">
            <!-- Customer Information -->
            <div class="checkout-card card">
                <div class="checkout-card-header">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-person-circle me-2"></i> Thông Tin Khách Hàng
                    </h5>
                </div>
                <div class="card-body p-4">
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
                                <label for="full_name" class="form-label fw-bold">
                                    <i class="bi bi-person me-1"></i> Họ và Tên <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-lg" id="full_name" name="full_name" 
                                       value="<?= htmlspecialchars($customer['full_name'] ?? '') ?>"
                                       placeholder="Nguyễn Văn A" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone_number" class="form-label fw-bold">
                                    <i class="bi bi-phone me-1"></i> Số Điện Thoại <span class="text-danger">*</span>
                                </label>
                                <input type="tel" class="form-control form-control-lg" id="phone_number" name="phone_number" 
                                       value="<?= htmlspecialchars($customer['phone_number'] ?? '') ?>"
                                       placeholder="0901234567" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">
                                <i class="bi bi-envelope me-1"></i> Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control form-control-lg" id="email" name="email" 
                                   value="<?= htmlspecialchars($customer['email'] ?? '') ?>"
                                   placeholder="your@email.com" required>
                        </div>
                        <div class="mb-4">
                            <label for="address" class="form-label fw-bold">
                                <i class="bi bi-geo-alt me-1"></i> Địa Chỉ Giao Hàng <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" id="address" name="address" rows="3" 
                                      placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành phố" required><?= htmlspecialchars($customer['address'] ?? '') ?></textarea>
                        </div>
                        
                        <!-- Payment Method -->
                        <div class="mb-4">
                            <label class="form-label fw-bold mb-3">
                                <i class="bi bi-credit-card me-1"></i> Phương Thức Thanh Toán <span class="text-danger">*</span>
                            </label>
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="payment-option">
                                        <input type="radio" name="payment_method" id="payment_cash" value="Tiền mặt" checked>
                                        <label for="payment_cash">
                                            <div class="payment-icon text-success">
                                                <i class="bi bi-cash-coin"></i>
                                            </div>
                                            <strong class="d-block mb-1">Tiền mặt</strong>
                                            <small class="text-muted">Thanh toán khi nhận hàng</small>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="payment-option">
                                        <input type="radio" name="payment_method" id="payment_vnpay" value="VNPay">
                                        <label for="payment_vnpay">
                                            <div class="payment-icon text-danger">
                                                <i class="bi bi-wallet2"></i>
                                            </div>
                                            <strong class="d-block mb-1">VNPay</strong>
                                            <small class="text-muted">Ví điện tử VNPay</small>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="payment-option">
                                        <input type="radio" name="payment_method" id="payment_bank" value="Chuyển khoản">
                                        <label for="payment_bank">
                                            <div class="payment-icon text-primary">
                                                <i class="bi bi-bank"></i>
                                            </div>
                                            <strong class="d-block mb-1">Chuyển khoản</strong>
                                            <small class="text-muted">Ngân hàng</small>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="payment-option">
                                        <input type="radio" name="payment_method" id="payment_card" value="Thẻ tín dụng">
                                        <label for="payment_card">
                                            <div class="payment-icon text-warning">
                                                <i class="bi bi-credit-card"></i>
                                            </div>
                                            <strong class="d-block mb-1">Thẻ tín dụng</strong>
                                            <small class="text-muted">Visa/Mastercard</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Note -->
                        <div class="mb-4">
                            <label for="note" class="form-label fw-bold">
                                <i class="bi bi-chat-left-text me-1"></i> Ghi Chú (Tùy chọn)
                            </label>
                            <textarea class="form-control" id="note" name="note" rows="3" 
                                      placeholder="Ghi chú thêm cho đơn hàng (thời gian giao hàng, yêu cầu đặc biệt...)"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-checkout btn-lg w-100 text-white">
                            <i class="bi bi-check-circle me-2"></i> Xác Nhận Đặt Hàng
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Order Summary -->
        <div class="col-lg-4">
            <div class="summary-card card">
                <div class="card-header bg-light py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-receipt me-2 text-danger"></i> Tóm Tắt Đơn Hàng
                    </h5>
                </div>
                <div class="card-body p-4">
                    <!-- Products List -->
                    <div class="mb-4">
                        <?php foreach ($cartItems as $item): ?>
                        <div class="summary-product">
                            <?php 
                                $imgUrl = BASE_URL . "public/data/" . rawurlencode($item['product_name'] ?? 'default') . ".jpg";
                            ?>
                            <img src="<?= $imgUrl ?>" 
                                 alt="<?= htmlspecialchars($item['product_name']) ?>"
                                 onerror="this.src='https://placehold.co/60x60?text=<?= urlencode($item['product_name'] ?? '') ?>'">
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1 small"><?= htmlspecialchars($item['product_name']) ?></h6>
                                <p class="text-muted small mb-1">
                                    <?= htmlspecialchars($item['variant_name']) ?>
                                </p>
                                <p class="text-muted small mb-0">
                                    Số lượng: <strong><?= $item['quantity'] ?></strong>
                                </p>
                            </div>
                            <div class="text-end">
                                <strong class="text-danger">
                                    <?= number_format($item['subtotal'], 0, ',', '.') ?>₫
                                </strong>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <hr>
                    
                    <!-- Summary -->
                    <div class="summary-item">
                        <span class="text-muted">Tạm tính:</span>
                        <span class="fw-bold"><?= number_format($total, 0, ',', '.') ?>₫</span>
                    </div>
                    <div class="summary-item">
                        <span class="text-muted">Phí vận chuyển:</span>
                        <span class="fw-bold text-success">Miễn phí</span>
                    </div>
                    <div class="summary-item">
                        <span class="text-muted">Giảm giá:</span>
                        <span class="fw-bold text-success">-0₫</span>
                    </div>
                    <hr>
                    <div class="summary-item">
                        <span class="fw-bold fs-5">Tổng cộng:</span>
                        <span class="summary-total"><?= number_format($total, 0, ',', '.') ?>₫</span>
                    </div>
                    
                    <!-- Info Box -->
                    <div class="alert alert-info mt-4 mb-0 small">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Lưu ý:</strong> Đơn hàng sẽ được xử lý trong vòng 24h. Chúng tôi sẽ liên hệ với bạn để xác nhận.
                    </div>
                    
                    <!-- Security Info -->
                    <div class="mt-4 p-3 bg-light rounded">
                        <h6 class="fw-bold mb-2">
                            <i class="bi bi-shield-check text-success me-2"></i> Bảo Mật
                        </h6>
                        <ul class="small mb-0 ps-3">
                            <li>Thông tin được mã hóa</li>
                            <li>Không lưu thẻ tín dụng</li>
                            <li>Bảo vệ dữ liệu cá nhân</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Payment option click
    $('.payment-option label').on('click', function() {
        var radio = $(this).prev('input[type="radio"]');
        radio.prop('checked', true);
        $('.payment-option label').removeClass('border-danger');
        $(this).addClass('border-danger');
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
            showAlert('Vui lòng điền đầy đủ thông tin bắt buộc', 'warning');
            return false;
        }
        
        // Phone validation
        var phoneRegex = /^[0-9]{10,11}$/;
        if (!phoneRegex.test(phone.replace(/\s/g, ''))) {
            e.preventDefault();
            showAlert('Số điện thoại không hợp lệ. Vui lòng nhập 10-11 chữ số', 'warning');
            $('#phone_number').focus();
            return false;
        }
        
        // Email validation
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            e.preventDefault();
            showAlert('Email không hợp lệ. Vui lòng nhập đúng định dạng email', 'warning');
            $('#email').focus();
            return false;
        }
        
        // Address validation
        if (address.length < 10) {
            e.preventDefault();
            showAlert('Vui lòng nhập địa chỉ chi tiết hơn', 'warning');
            $('#address').focus();
            return false;
        }
        
        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Đang xử lý...');
        
        // Timeout để reset nếu có lỗi
        setTimeout(function() {
            btn.prop('disabled', false).html(originalText);
        }, 10000);
    });
    
    // Show alert
    function showAlert(message, type) {
        type = type || 'info';
        var alertHtml = '<div class="alert alert-' + type + ' alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999; min-width: 300px;" role="alert">' +
            '<i class="bi bi-exclamation-triangle me-2"></i>' + message +
            '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
            '</div>';
        $('body').append(alertHtml);
        setTimeout(function() {
            $('.alert').fadeOut(function() {
                $(this).remove();
            });
        }, 4000);
    }
});
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
