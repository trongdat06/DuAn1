<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Đăng Nhập Admin</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= BASE_URL ?>auth/login">
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên Đăng Nhập</label>
                        <input type="text" class="form-control" id="username" name="username" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật Khẩu</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
                </form>
                <div class="mt-3 text-center">
                    <a href="<?= BASE_URL ?>home/index">← Về Trang Chủ</a>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <div class="alert alert-info">
                <small>
                    <strong>Thông tin đăng nhập mặc định:</strong><br>
                    Username: admin<br>
                    Password: password
                </small>
            </div>
        </div>
    </div>
</div>

