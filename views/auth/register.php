<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center py-4">
                <h4 class="mb-0"><i class="bi bi-person-plus me-2"></i> Đăng Ký Tài Khoản</h4>
                <p class="mb-0 mt-2 small opacity-75">Tạo tài khoản để mua sắm dễ dàng hơn</p>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="<?= BASE_URL ?>auth/register">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="full_name" class="form-label fw-bold">Họ và Tên <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" id="full_name" name="full_name" 
                                       placeholder="Nguyễn Văn A" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="phone_number" class="form-label fw-bold">Số Điện Thoại <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                <input type="tel" class="form-control" id="phone_number" name="phone_number" 
                                       placeholder="0901234567" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" 
                                   placeholder="your@email.com" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="gender" class="form-label fw-bold">Giới Tính</label>
                            <select class="form-select" id="gender" name="gender">
                                <option value="">Chọn giới tính</option>
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                                <option value="Khác">Khác</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="date_of_birth" class="form-label fw-bold">Ngày Sinh</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label fw-bold">Địa Chỉ <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="address" name="address" rows="2" 
                                  placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành phố" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                        <i class="bi bi-check-circle me-2"></i> Đăng Ký
                    </button>
                </form>
                <div class="mt-4 text-center">
                    <p class="mb-2">Đã có tài khoản? 
                        <a href="<?= BASE_URL ?>auth/login" class="text-primary fw-bold">Đăng nhập ngay</a>
                    </p>
                    <a href="<?= BASE_URL ?>home/index" class="text-muted small">
                        <i class="bi bi-arrow-left"></i> Về Trang Chủ
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

