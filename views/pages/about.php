<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<style>
.about-hero-carousel {
    margin-bottom: 50px;
    border-radius: 0 0 30px 30px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}
.about-hero-carousel .carousel-item {
    height: 400px;
    position: relative;
    overflow: hidden;
}
.about-hero-carousel .carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.7);
    transition: transform 0.5s ease, filter 0.5s ease;
}
.about-hero-carousel .carousel-item:hover img {
    transform: scale(1.05);
    filter: brightness(0.8);
}
.about-hero-carousel .carousel-item::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.2) 100%);
    z-index: 1;
}
.about-hero-carousel .carousel-caption {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 2;
    text-align: center;
    width: 100%;
    padding: 0 20px;
    background: rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 30px;
    max-width: 700px;
}
.about-hero-carousel .carousel-caption h1 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}
.about-hero-carousel .carousel-caption p {
    font-size: 1rem;
    margin-bottom: 1.5rem;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
}
.about-hero-carousel .carousel-item.active .carousel-caption h1 {
    animation: slideInDown 0.8s ease;
}
.about-hero-carousel .carousel-item.active .carousel-caption p {
    animation: slideInUp 0.8s ease 0.2s both;
}
.about-hero-carousel .carousel-control-prev,
.about-hero-carousel .carousel-control-next {
    width: 50px;
    height: 50px;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    backdrop-filter: blur(10px);
    opacity: 0.8;
    transition: all 0.3s ease;
}
.about-hero-carousel .carousel-control-prev:hover,
.about-hero-carousel .carousel-control-next:hover {
    opacity: 1;
    background: rgba(255,255,255,0.3);
}
.about-hero-carousel .carousel-control-prev {
    left: 20px;
}
.about-hero-carousel .carousel-control-next {
    right: 20px;
}
.about-hero-carousel .carousel-indicators {
    bottom: 20px;
}
.about-hero-carousel .carousel-indicators button {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255,255,255,0.5);
    border: 2px solid rgba(255,255,255,0.8);
    transition: all 0.3s ease;
}
.about-hero-carousel .carousel-indicators button.active {
    background: white;
    width: 30px;
    border-radius: 6px;
}
@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
@media (min-width: 768px) {
    .about-hero-carousel .carousel-caption h1 {
        font-size: 3rem;
    }
    .about-hero-carousel .carousel-caption p {
        font-size: 1.25rem;
    }
}
.about-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none;
}
.about-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
}
.stat-number {
    font-size: 3.5rem;
    font-weight: 700;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
</style>

<div id="aboutHeroCarousel" class="carousel slide about-hero-carousel" data-bs-ride="carousel" data-bs-interval="4000">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#aboutHeroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#aboutHeroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#aboutHeroCarousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <!-- Slide 1: Về Chúng Tôi -->
        <div class="carousel-item active">
            <img src="<?= BASE_URL ?>public/images/banner1.jpg" class="d-block w-100" alt="Về Chúng Tôi" onerror="this.src='https://images.unsplash.com/photo-1552664730-d307ca884978?w=1200&q=80'">
            <div class="carousel-caption">
                <h1 class="display-4 fw-bold">
                    <i class="bi bi-shop me-2"></i> Về Chúng Tôi
                </h1>
                <p class="lead">MIVONSTORE - Điểm đến tin cậy cho điện thoại và phụ kiện</p>
            </div>
        </div>
        
        <!-- Slide 2: Cam Kết -->
        <div class="carousel-item">
            <img src="<?= BASE_URL ?>public/images/banner2.jpg" class="d-block w-100" alt="Cam Kết" onerror="this.src='https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=1200&q=80'">
            <div class="carousel-caption">
                <h1 class="display-4 fw-bold">
                    <i class="bi bi-shield-check me-2"></i> Cam Kết Chất Lượng
                </h1>
                <p class="lead">Sản phẩm chính hãng 100%, bảo hành đầy đủ, giá cả cạnh tranh</p>
            </div>
        </div>
        
        <!-- Slide 3: Thành Tựu -->
        <div class="carousel-item">
            <img src="<?= BASE_URL ?>public/images/banner3.jpg" class="d-block w-100" alt="Thành Tựu" onerror="this.src='https://images.unsplash.com/photo-1551434678-e076c223a692?w=1200&q=80'">
            <div class="carousel-caption">
                <h1 class="display-4 fw-bold">
                    <i class="bi bi-trophy me-2"></i> Thành Tựu
                </h1>
                <p class="lead">Hơn 10 năm kinh nghiệm, 50K+ khách hàng tin tưởng</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#aboutHeroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#aboutHeroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container mb-5">
    
    <div class="row mb-5">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100 border-0 about-card">
                <div class="card-body p-4">
                    <h3 class="text-primary mb-4">
                        <i class="bi bi-info-circle me-2"></i> Giới Thiệu
                    </h3>
                    <p class="lead">MIVONSTORE là cửa hàng chuyên bán điện thoại và phụ kiện điện tử chính hãng, uy tín hàng đầu tại Việt Nam.</p>
                    <p>Với hơn 10 năm kinh nghiệm trong ngành, chúng tôi tự hào mang đến cho khách hàng những sản phẩm chất lượng cao với giá cả hợp lý nhất.</p>
                    <p class="fw-bold mt-4">Chúng tôi cam kết:</p>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success fs-5 me-3 mt-1"></i>
                                <div>
                                    <strong>Sản phẩm chính hãng 100%</strong>
                                    <p class="text-muted small mb-0">Tất cả sản phẩm đều được nhập khẩu chính hãng, có đầy đủ giấy tờ chứng minh nguồn gốc</p>
                                </div>
                            </div>
                        </li>
                        <li class="mb-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success fs-5 me-3 mt-1"></i>
                                <div>
                                    <strong>Bảo hành chính hãng</strong>
                                    <p class="text-muted small mb-0">Bảo hành theo tiêu chuẩn của nhà sản xuất, hỗ trợ tại các trung tâm bảo hành chính hãng</p>
                                </div>
                            </div>
                        </li>
                        <li class="mb-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success fs-5 me-3 mt-1"></i>
                                <div>
                                    <strong>Giá cả cạnh tranh</strong>
                                    <p class="text-muted small mb-0">Giá tốt nhất thị trường, nhiều chương trình khuyến mãi hấp dẫn</p>
                                </div>
                            </div>
                        </li>
                        <li class="mb-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success fs-5 me-3 mt-1"></i>
                                <div>
                                    <strong>Dịch vụ chăm sóc khách hàng tận tâm</strong>
                                    <p class="text-muted small mb-0">Đội ngũ tư vấn chuyên nghiệp, hỗ trợ 24/7</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100 border-0 about-card">
                <div class="card-body p-4">
                    <h3 class="text-primary mb-4">
                        <i class="bi bi-star-fill me-2"></i> Tại Sao Chọn Chúng Tôi?
                    </h3>
                    <div class="mb-4">
                        <div class="d-flex align-items-start mb-3">
                            <div class="flex-shrink-0">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                    <i class="bi bi-shield-check text-primary fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="fw-bold">Uy Tín</h5>
                                <p class="text-muted mb-0">Hơn 10 năm kinh nghiệm, được hàng nghìn khách hàng tin tưởng và đánh giá cao</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-start mb-3">
                            <div class="flex-shrink-0">
                                <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                    <i class="bi bi-truck text-success fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="fw-bold">Giao Hàng Nhanh</h5>
                                <p class="text-muted mb-0">Giao hàng toàn quốc, nhận hàng trong 24-48 giờ. Miễn phí vận chuyển cho đơn hàng trên 5 triệu</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-start mb-3">
                            <div class="flex-shrink-0">
                                <div class="bg-info bg-opacity-10 rounded-circle p-3">
                                    <i class="bi bi-headset text-info fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="fw-bold">Hỗ Trợ 24/7</h5>
                                <p class="text-muted mb-0">Đội ngũ tư vấn chuyên nghiệp, sẵn sàng hỗ trợ mọi lúc, mọi nơi</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                    <i class="bi bi-arrow-repeat text-warning fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="fw-bold">Đổi Trả Dễ Dàng</h5>
                                <p class="text-muted mb-0">Chính sách đổi trả linh hoạt trong 7 ngày, hoàn tiền 100% nếu không hài lòng</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h3 class="text-center text-primary mb-4">
                        <i class="bi bi-trophy me-2"></i> Thành Tựu Của Chúng Tôi
                    </h3>
                    <div class="row text-center">
                        <div class="col-md-3 mb-3">
                            <div class="p-4">
                                <div class="stat-number mb-2">10+</div>
                                <p class="text-muted mb-0 fw-semibold">Năm Kinh Nghiệm</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="p-4">
                                <div class="stat-number mb-2">50K+</div>
                                <p class="text-muted mb-0 fw-semibold">Khách Hàng</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="p-4">
                                <div class="stat-number mb-2">1000+</div>
                                <p class="text-muted mb-0 fw-semibold">Sản Phẩm</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="p-4">
                                <div class="stat-number mb-2">99%</div>
                                <p class="text-muted mb-0 fw-semibold">Hài Lòng</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h3 class="text-primary mb-4"><i class="bi bi-geo-alt me-2"></i> Thông Tin Liên Hệ</h3>
                    <div class="row">
                        <div class="col-md-4 text-center mb-3">
                            <i class="bi bi-geo-alt-fill text-primary" style="font-size: 2rem;"></i>
                            <h5 class="mt-2">Địa Chỉ</h5>
                            <p class="text-muted">Beta, Tổ hợp GD FPT<br>Võ Nguyên Giáp, TP. Thanh Hóa</p>
                        </div>
                        <div class="col-md-4 text-center mb-3">
                            <i class="bi bi-telephone-fill text-primary" style="font-size: 2rem;"></i>
                            <h5 class="mt-2">Hotline</h5>
                            <p class="text-muted">1900-000-000<br>Hỗ trợ 24/7</p>
                        </div>
                        <div class="col-md-4 text-center mb-3">
                            <i class="bi bi-envelope-fill text-primary" style="font-size: 2rem;"></i>
                            <h5 class="mt-2">Email</h5>
                            <p class="text-muted">info@mivonstore.vn<br>support@mivonstore.vn</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Trigger animations on carousel slide change
    var carousel = document.getElementById('aboutHeroCarousel');
    if (carousel) {
        carousel.addEventListener('slide.bs.carousel', function() {
            // Remove active class from all captions
            var captions = this.querySelectorAll('.carousel-caption h1, .carousel-caption p');
            captions.forEach(function(el) {
                el.style.animation = 'none';
            });
        });
        
        carousel.addEventListener('slid.bs.carousel', function() {
            // Add animation to active slide
            var activeSlide = this.querySelector('.carousel-item.active');
            if (activeSlide) {
                var h1 = activeSlide.querySelector('.carousel-caption h1');
                var p = activeSlide.querySelector('.carousel-caption p');
                
                setTimeout(function() {
                    if (h1) h1.style.animation = 'slideInDown 0.8s ease';
                    if (p) p.style.animation = 'slideInUp 0.8s ease 0.2s both';
                }, 50);
            }
        });
    }
});
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>


