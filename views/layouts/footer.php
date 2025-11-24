    </div>

    <footer class="bg-dark text-light mt-5 py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3">
                    <h5 class="fw-bold mb-3">
                        <span class="text-warning">MIVON</span><span>STORE</span>
                    </h5>
                    <p class="text-muted small mb-3">Chuyên bán điện thoại và phụ kiện điện tử chính hãng</p>
                    <div>
                        <p class="small mb-2">Mạng xã hội</p>
                        <div class="d-flex gap-2">
                            <a href="#" class="text-light"><i class="bi bi-facebook fs-5"></i></a>
                            <a href="#" class="text-light"><i class="bi bi-instagram fs-5"></i></a>
                            <a href="#" class="text-light"><i class="bi bi-youtube fs-5"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <h6 class="fw-bold mb-3">Sản phẩm</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?= BASE_URL ?>product/search?keyword=iPhone" class="text-muted text-decoration-none small">iPhone</a></li>
                        <li class="mb-2"><a href="<?= BASE_URL ?>product/search?keyword=Samsung" class="text-muted text-decoration-none small">Samsung</a></li>
                        <li class="mb-2"><a href="<?= BASE_URL ?>product/search?keyword=Xiaomi" class="text-muted text-decoration-none small">Xiaomi</a></li>
                        <li class="mb-2"><a href="<?= BASE_URL ?>product/search?keyword=OPPO" class="text-muted text-decoration-none small">OPPO</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h6 class="fw-bold mb-3">Hỗ trợ</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none small">Chính sách bảo hành</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none small">Hướng dẫn mua hàng</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none small">Chính sách đổi trả</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none small">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-md-5">
                    <h6 class="fw-bold mb-3">Liên hệ</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-telephone me-2"></i>
                            <span class="small">1900-000-000</span>
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-envelope me-2"></i>
                            <span class="small">info@mivonstore.vn</span>
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-geo-alt me-2"></i>
                            <span class="small">Beta, Tổ hợp GD FPT, Võ Nguyên Giáp, TP. Thanh Hóa</span>
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="bg-secondary my-4">
            <div class="text-center">
                <p class="text-muted small mb-0">&copy; <?= date('Y') ?> MivonStore. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        var BASE_URL = '<?= BASE_URL ?>';
    </script>
    <script src="<?= BASE_URL ?>public/js/main.js"></script>
</body>
</html>

