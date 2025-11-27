<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center py-4">
                <h4 class="mb-0"><i class="bi bi-box-arrow-in-right me-2"></i> Đăng Nhập</h4>
                <p class="mb-0 mt-2 small opacity-75">Chào mừng bạn trở lại!</p>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="<?= BASE_URL ?>auth/login">
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" 
                                   placeholder="your@email.com" required autofocus>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Mật Khẩu</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="(Tùy chọn)">
                        </div>
                        <small class="text-muted">
                            <i class="bi bi-info-circle"></i> Hiện tại hệ thống chỉ cần email để đăng nhập
                        </small>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Đăng Nhập
                    </button>
                </form>
                <div class="mt-4 text-center">
                    <p class="mb-2">Chưa có tài khoản? 
                        <a href="<?= BASE_URL ?>auth/register" class="text-primary fw-bold">Đăng ký ngay</a>
                    </p>
                    <a href="<?= BASE_URL ?>home/index" class="text-muted small">
                        <i class="bi bi-arrow-left"></i> Về Trang Chủ
                    </a>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <a href="<?= BASE_URL ?>auth/adminLogin" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-shield-lock me-1"></i> Đăng Nhập Admin
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

