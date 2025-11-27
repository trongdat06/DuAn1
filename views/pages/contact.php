<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<style>
.contact-hero-carousel {
    margin-bottom: 40px;
    border-radius: 0 0 30px 30px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}
.contact-hero-carousel .carousel-item {
    height: 400px;
    position: relative;
    overflow: hidden;
}
.contact-hero-carousel .carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.7);
    transition: transform 0.5s ease, filter 0.5s ease;
}
.contact-hero-carousel .carousel-item:hover img {
    transform: scale(1.05);
    filter: brightness(0.8);
}
.contact-hero-carousel .carousel-item::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.2) 100%);
    z-index: 1;
}
.contact-hero-carousel .carousel-caption {
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
.contact-hero-carousel .carousel-caption h1 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}
.contact-hero-carousel .carousel-caption p {
    font-size: 1rem;
    margin-bottom: 1.5rem;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
}
.contact-hero-carousel .carousel-item.active .carousel-caption h1 {
    animation: slideInDown 0.8s ease;
}
.contact-hero-carousel .carousel-item.active .carousel-caption p {
    animation: slideInUp 0.8s ease 0.2s both;
}
.contact-hero-carousel .carousel-control-prev,
.contact-hero-carousel .carousel-control-next {
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
.contact-hero-carousel .carousel-control-prev:hover,
.contact-hero-carousel .carousel-control-next:hover {
    opacity: 1;
    background: rgba(255,255,255,0.3);
}
.contact-hero-carousel .carousel-control-prev {
    left: 20px;
}
.contact-hero-carousel .carousel-control-next {
    right: 20px;
}
.contact-hero-carousel .carousel-indicators {
    bottom: 20px;
}
.contact-hero-carousel .carousel-indicators button {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255,255,255,0.5);
    border: 2px solid rgba(255,255,255,0.8);
    transition: all 0.3s ease;
}
.contact-hero-carousel .carousel-indicators button.active {
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
    .contact-hero-carousel .carousel-caption h1 {
        font-size: 3rem;
    }
    .contact-hero-carousel .carousel-caption p {
        font-size: 1.25rem;
    }
}
.contact-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none;
}
.contact-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}
.contact-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}
</style>

<div id="contactHeroCarousel" class="carousel slide contact-hero-carousel" data-bs-ride="carousel" data-bs-interval="4000">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#contactHeroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#contactHeroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#contactHeroCarousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <!-- Slide 1: Liên Hệ -->
        <div class="carousel-item active">
            <img src="<?= BASE_URL ?>public/images/banner1.jpg" class="d-block w-100" alt="Liên Hệ" onerror="this.src='https://images.unsplash.com/photo-1423666639041-f56000c27a9a?w=1200&q=80'">
            <div class="carousel-caption">
                <h1 class="display-4 fw-bold">
                    <i class="bi bi-envelope-paper-heart me-2"></i> Liên Hệ Với Chúng Tôi
                </h1>
                <p class="lead">Chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ bạn</p>
            </div>
        </div>
        
        <!-- Slide 2: Hỗ Trợ -->
        <div class="carousel-item">
            <img src="<?= BASE_URL ?>public/images/banner2.jpg" class="d-block w-100" alt="Hỗ Trợ" onerror="this.src='https://images.unsplash.com/photo-1552664730-d307ca884978?w=1200&q=80'">
            <div class="carousel-caption">
                <h1 class="display-4 fw-bold">
                    <i class="bi bi-headset me-2"></i> Hỗ Trợ 24/7
                </h1>
                <p class="lead">Đội ngũ tư vấn chuyên nghiệp, sẵn sàng hỗ trợ mọi lúc, mọi nơi</p>
            </div>
        </div>
        
        <!-- Slide 3: Thông Tin -->
        <div class="carousel-item">
            <img src="<?= BASE_URL ?>public/images/banner3.jpg" class="d-block w-100" alt="Thông Tin" onerror="this.src='https://images.unsplash.com/photo-1551434678-e076c223a692?w=1200&q=80'">
            <div class="carousel-caption">
                <h1 class="display-4 fw-bold">
                    <i class="bi bi-geo-alt me-2"></i> Thông Tin Liên Hệ
                </h1>
                <p class="lead">Hotline: 1900-000-000 | Email: info@mivonstore.vn</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#contactHeroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#contactHeroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container mb-5">
    
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm contact-card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-envelope-paper me-2"></i> Gửi Tin Nhắn</h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="<?= BASE_URL ?>page/contact" id="contactForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-bold">Họ và Tên <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="<?= htmlspecialchars($_SESSION['customer_name'] ?? '') ?>"
                                           placeholder="Nguyễn Văn A" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label fw-bold">Số Điện Thoại <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                    <input type="tel" class="form-control" id="phone" name="phone" 
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
                                       value="<?= htmlspecialchars($_SESSION['customer_email'] ?? '') ?>"
                                       placeholder="your@email.com" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label fw-bold">Chủ Đề <span class="text-danger">*</span></label>
                            <select class="form-select" id="subject" name="subject" required>
                                <option value="">Chọn chủ đề</option>
                                <option value="Hỗ trợ sản phẩm">Hỗ trợ sản phẩm</option>
                                <option value="Đặt hàng">Đặt hàng</option>
                                <option value="Bảo hành">Bảo hành</option>
                                <option value="Khiếu nại">Khiếu nại</option>
                                <option value="Góp ý">Góp ý</option>
                                <option value="Khác">Khác</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label fw-bold">Nội Dung Tin Nhắn <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="message" name="message" rows="6" 
                                      placeholder="Vui lòng nhập nội dung tin nhắn của bạn..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="bi bi-send me-2"></i> Gửi Tin Nhắn
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow-sm mb-4 contact-card">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i> Thông Tin Liên Hệ</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <div class="contact-icon bg-primary bg-opacity-10">
                                    <i class="bi bi-geo-alt-fill text-primary fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fw-bold mb-1">Địa Chỉ</h6>
                                <p class="text-muted mb-0 small">
                                    Beta, Tổ hợp GD FPT<br>
                                    Võ Nguyên Giáp, TP. Thanh Hóa
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <div class="contact-icon bg-success bg-opacity-10">
                                    <i class="bi bi-telephone-fill text-success fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fw-bold mb-1">Hotline</h6>
                                <p class="text-muted mb-0 small">
                                    <a href="tel:1900000000" class="text-decoration-none">1900-000-000</a><br>
                                    Hỗ trợ 24/7
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <div class="contact-icon bg-warning bg-opacity-10">
                                    <i class="bi bi-envelope-fill text-warning fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fw-bold mb-1">Email</h6>
                                <p class="text-muted mb-0 small">
                                    <a href="mailto:info@mivonstore.vn" class="text-decoration-none">info@mivonstore.vn</a><br>
                                    <a href="mailto:support@mivonstore.vn" class="text-decoration-none">support@mivonstore.vn</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <div class="contact-icon bg-info bg-opacity-10">
                                    <i class="bi bi-clock-fill text-info fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fw-bold mb-1">Giờ Làm Việc</h6>
                                <p class="text-muted mb-0 small">
                                    Thứ 2 - Thứ 6: 8:00 - 20:00<br>
                                    Thứ 7 - Chủ nhật: 9:00 - 18:00
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card shadow-sm contact-card">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="bi bi-share me-2"></i> Mạng Xã Hội</h5>
                </div>
                <div class="card-body text-center">
                    <div class="d-flex justify-content-center gap-3">
                        <a href="#" class="btn btn-primary rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;" title="Facebook">
                            <i class="bi bi-facebook fs-5"></i>
                        </a>
                        <a href="#" class="btn btn-danger rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;" title="Instagram">
                            <i class="bi bi-instagram fs-5"></i>
                        </a>
                        <a href="#" class="btn btn-info rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;" title="Zalo">
                            <i class="bi bi-chat-dots fs-5"></i>
                        </a>
                        <a href="#" class="btn btn-danger rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;" title="YouTube">
                            <i class="bi bi-youtube fs-5"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow-sm contact-card">
                <div class="card-body p-4">
                    <h4 class="text-center mb-4"><i class="bi bi-map me-2"></i> Bản Đồ</h4>
                    <div class="bg-light rounded p-5 text-center" style="min-height: 300px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <i class="bi bi-geo-alt" style="font-size: 4rem; color: #dee2e6;"></i>
                        <p class="text-muted mt-3 mb-2 fw-semibold">Beta, Tổ hợp GD FPT</p>
                        <p class="text-muted mb-2">Võ Nguyên Giáp, TP. Thanh Hóa</p>
                        <p class="text-muted small">Bạn có thể nhúng Google Maps tại đây</p>
                        <a href="https://www.google.com/maps/search/Beta,+Tổ+hợp+GD+FPT,+Võ+Nguyên+Giáp,+TP.+Thanh+Hóa" 
                           target="_blank" 
                           class="btn btn-primary btn-sm mt-3">
                            <i class="bi bi-geo-alt-fill me-2"></i> Xem trên Google Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#contactForm').on('submit', function(e) {
        var btn = $(this).find('button[type="submit"]');
        var originalText = btn.html();
        
        // Validation
        var name = $('#name').val().trim();
        var phone = $('#phone').val().trim();
        var email = $('#email').val().trim();
        var subject = $('#subject').val();
        var message = $('#message').val().trim();
        
        if (!name || !phone || !email || !subject || !message) {
            e.preventDefault();
            alert('Vui lòng điền đầy đủ thông tin');
            return false;
        }
        
        // Phone validation
        var phoneRegex = /^[0-9]{10,11}$/;
        if (!phoneRegex.test(phone.replace(/\s/g, ''))) {
            e.preventDefault();
            alert('Số điện thoại không hợp lệ');
            return false;
        }
        
        // Email validation
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            e.preventDefault();
            alert('Email không hợp lệ');
            return false;
        }
        
        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Đang gửi...');
    });
    
    // Trigger animations on carousel slide change
    var carousel = document.getElementById('contactHeroCarousel');
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

