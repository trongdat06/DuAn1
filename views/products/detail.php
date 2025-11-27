<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body text-center p-4">
                <?php 
                    $imgUrl = BASE_URL . "public/data/" . rawurlencode($product['product_name'] ?? 'default') . ".jpg";
                ?>
                <img src="<?= $imgUrl ?>" 
                     alt="<?= htmlspecialchars($product['product_name']) ?>" 
                     class="img-fluid" 
                     style="max-height: 500px; object-fit: contain;"
                     id="productImage"
                     onerror="this.src='https://placehold.co/500x500?text=<?= urlencode($product['product_name']) ?>'">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <?php if (!empty($product['brand'])): ?>
                <span class="badge bg-primary mb-2">
                    <i class="bi bi-tag-fill"></i> <?= htmlspecialchars($product['brand']) ?>
                </span>
            <?php endif; ?>
            <?php if (!empty($product['category_name'])): ?>
                <span class="badge bg-secondary mb-2">
                    <i class="bi bi-grid"></i> <?= htmlspecialchars($product['category_name']) ?>
                </span>
            <?php endif; ?>
        </div>
        
        <h1 class="fw-bold mb-3" style="color: #212529;"><?= htmlspecialchars($product['product_name']) ?></h1>
        
        <?php if (!empty($product['description'])): ?>
            <?php 
                $shortDesc = strip_tags($product['description']);
                $shortDesc = mb_strlen($shortDesc) > 150 ? mb_substr($shortDesc, 0, 150) . '...' : $shortDesc;
            ?>
            <div class="alert alert-light border-start border-primary border-4 mb-4" role="alert">
                <h6 class="alert-heading fw-bold mb-2">
                    <i class="bi bi-info-circle text-primary"></i> Mô Tả Ngắn
                </h6>
                <p class="mb-0" style="line-height: 1.6;"><?= nl2br(htmlspecialchars($shortDesc)) ?></p>
            </div>
        <?php endif; ?>
        
        <hr class="my-4">
        
        <h5 class="fw-bold mb-3">
            <i class="bi bi-file-text text-primary"></i> Thông Tin Chi Tiết
        </h5>
        <div class="mb-4" style="line-height: 1.8;">
            <?php if (!empty($product['description'])): ?>
                <p class="text-muted"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
            <?php else: ?>
                <p class="text-muted">Sản phẩm chất lượng cao, chính hãng, bảo hành đầy đủ. Liên hệ để biết thêm chi tiết.</p>
            <?php endif; ?>
        </div>
        
        <hr class="my-4">
        
        <h4>Chọn Phiên Bản</h4>
        <?php if (empty($variants)): ?>
            <div class="alert alert-warning">Sản phẩm hiện đang hết hàng.</div>
        <?php else: ?>
            <form id="addToCartForm" method="POST" action="<?= BASE_URL ?>cart/add">
                <div class="mb-3">
                    <?php foreach ($variants as $index => $variant): ?>
                    <div class="card mb-2 variant-card" style="cursor: pointer; transition: all 0.3s;">
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="variant_id" 
                                       id="variant_<?= $variant['variant_id'] ?>" 
                                       value="<?= $variant['variant_id'] ?>" 
                                       <?= $index === 0 ? 'checked' : '' ?> required>
                                <label class="form-check-label w-100" for="variant_<?= $variant['variant_id'] ?>" style="cursor: pointer;">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <strong class="d-block mb-1"><?= htmlspecialchars($variant['variant_name']) ?></strong>
                                            <small class="text-muted d-block">
                                                <i class="bi bi-palette"></i> <?= htmlspecialchars($variant['color']) ?> | 
                                                <i class="bi bi-hdd"></i> <?= htmlspecialchars($variant['storage']) ?> | 
                                                <i class="bi bi-shield-check"></i> <?= $variant['warranty_months'] ?> tháng
                                            </small>
                                        </div>
                                        <div class="text-end">
                                            <span class="text-danger fw-bold fs-5 d-block">
                                                <?= number_format($variant['price'], 0, ',', '.') ?>₫
                                            </span>
                                            <span class="badge bg-<?= $variant['stock_quantity'] > 10 ? 'success' : ($variant['stock_quantity'] > 0 ? 'warning' : 'danger') ?>">
                                                <?= $variant['stock_quantity'] > 0 ? 'Còn ' . $variant['stock_quantity'] : 'Hết hàng' ?>
                                            </span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="mb-3">
                    <label for="quantity" class="form-label fw-bold">Số Lượng</label>
                    <div class="input-group" style="max-width: 150px;">
                        <button class="btn btn-outline-secondary" type="button" id="decreaseQty">-</button>
                        <input type="number" class="form-control text-center" id="quantity" name="quantity" 
                               value="1" min="1" max="10" required>
                        <button class="btn btn-outline-secondary" type="button" id="increaseQty">+</button>
                    </div>
                </div>
                
                <?php if (isset($_SESSION['customer_id'])): ?>
                    <button type="submit" class="btn btn-primary btn-lg w-100 mb-2">
                        <i class="bi bi-cart-plus"></i> Thêm Vào Giỏ Hàng
                    </button>
                <?php else: ?>
                    <a href="<?= BASE_URL ?>auth/login" class="btn btn-primary btn-lg w-100 mb-2">
                        <i class="bi bi-box-arrow-in-right"></i> Đăng Nhập Để Mua Hàng
                    </a>
                    <div class="alert alert-info mb-2">
                        <i class="bi bi-info-circle me-2"></i>
                        <small>Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng</small>
                    </div>
                <?php endif; ?>
                <a href="<?= BASE_URL ?>product/index" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-left"></i> Tiếp Tục Mua Sắm
                </a>
            </form>
        <?php endif; ?>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#addToCartForm').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = form.serialize() + '&ajax=1';
        
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#cart-count').text(response.cartCount);
                    // Hiển thị thông báo đẹp hơn
                    var alertHtml = '<div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999;" role="alert">' +
                        '<i class="bi bi-check-circle me-2"></i>' + response.message +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                        '</div>';
                    $('body').append(alertHtml);
                    setTimeout(function() {
                        $('.alert').fadeOut();
                    }, 3000);
                } else {
                    if (response.requireLogin) {
                        if (confirm(response.message + '\n\nBạn có muốn chuyển đến trang đăng nhập không?')) {
                            window.location.href = response.loginUrl;
                        }
                    } else {
                        alert(response.message);
                    }
                }
            },
            error: function(xhr) {
                if (xhr.status === 401) {
                    var response = xhr.responseJSON;
                    if (response && response.requireLogin) {
                        if (confirm(response.message + '\n\nBạn có muốn chuyển đến trang đăng nhập không?')) {
                            window.location.href = response.loginUrl;
                        }
                    } else {
                        alert('Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng');
                    }
                } else {
                    alert('Có lỗi xảy ra');
                }
            }
        });
    });
    
    // Animation khi chọn variant
    $('input[name="variant_id"]').on('change', function() {
        $(this).closest('.card').addClass('border-primary border-2 shadow-sm');
        $('input[name="variant_id"]').not(this).closest('.card').removeClass('border-primary border-2 shadow-sm');
    });
    
    // Tăng/giảm số lượng
    $('#increaseQty').on('click', function() {
        var qty = parseInt($('#quantity').val());
        var max = parseInt($('#quantity').attr('max'));
        if (qty < max) {
            $('#quantity').val(qty + 1);
        }
    });
    
    $('#decreaseQty').on('click', function() {
        var qty = parseInt($('#quantity').val());
        var min = parseInt($('#quantity').attr('min'));
        if (qty > min) {
            $('#quantity').val(qty - 1);
        }
    });
    
    // Đánh dấu variant đầu tiên được chọn
    $('input[name="variant_id"]:checked').closest('.card').addClass('border-primary border-2 shadow-sm');
    
    // Star rating
    $('.star-rating .star').on('click', function() {
        var rating = $(this).data('rating');
        $('.star-rating .star').removeClass('active');
        $('.star-rating .star').each(function(index) {
            if (index < rating) {
                $(this).addClass('active');
            }
        });
        $('#rating').val(rating);
    });
    
    $('.star-rating .star').on('mouseenter', function() {
        var rating = $(this).data('rating');
        $('.star-rating .star').removeClass('hover');
        $('.star-rating .star').each(function(index) {
            if (index < rating) {
                $(this).addClass('hover');
            }
        });
    });
    
    $('.star-rating').on('mouseleave', function() {
        var currentRating = $('#rating').val() || 0;
        $('.star-rating .star').removeClass('hover');
        $('.star-rating .star').each(function(index) {
            if (index < currentRating) {
                $(this).addClass('active');
            }
        });
    });
});
</script>

<!-- Reviews Section -->
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-12">
            <h3 class="fw-bold mb-4 border-bottom pb-3">
                <i class="bi bi-star-fill text-warning me-2"></i> Đánh Giá & Bình Luận
            </h3>
            
            <!-- Review Stats -->
            <?php if ($reviewStats && $reviewStats['total_reviews'] > 0): ?>
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card shadow-sm text-center p-4">
                        <div class="display-4 fw-bold text-primary mb-2">
                            <?= number_format($reviewStats['average_rating'], 1) ?>
                        </div>
                        <div class="mb-2">
                            <?php 
                                $avgRating = round($reviewStats['average_rating']);
                                for ($i = 1; $i <= 5; $i++): 
                            ?>
                                <i class="bi bi-star<?= $i <= $avgRating ? '-fill' : '' ?> text-warning"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="text-muted mb-0">Dựa trên <?= $reviewStats['total_reviews'] ?> đánh giá</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card shadow-sm p-4">
                        <h6 class="fw-bold mb-3">Phân Bố Đánh Giá</h6>
                        <?php for ($i = 5; $i >= 1; $i--): 
                            $count = $reviewStats['rating_' . $i] ?? 0;
                            $percentage = $reviewStats['total_reviews'] > 0 ? ($count / $reviewStats['total_reviews']) * 100 : 0;
                        ?>
                        <div class="mb-2">
                            <div class="d-flex align-items-center">
                                <span class="me-2" style="width: 60px;">
                                    <?= $i ?> <i class="bi bi-star-fill text-warning"></i>
                                </span>
                                <div class="progress flex-grow-1 me-2" style="height: 20px;">
                                    <div class="progress-bar bg-warning" role="progressbar" 
                                         style="width: <?= $percentage ?>%"></div>
                                </div>
                                <span class="text-muted small" style="width: 50px; text-align: right;">
                                    <?= $count ?>
                                </span>
                            </div>
                        </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i>
                Chưa có đánh giá nào cho sản phẩm này. Hãy là người đầu tiên đánh giá!
            </div>
            <?php endif; ?>
            
            <!-- Add Review Form -->
            <?php if (isset($_SESSION['customer_id'])): ?>
                <?php if (!$hasReviewed): ?>
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Viết Đánh Giá</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?= BASE_URL ?>review/create" id="reviewForm">
                            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                            <input type="hidden" name="rating" id="rating" value="5" required>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Đánh Giá <span class="text-danger">*</span></label>
                                <div class="star-rating">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="bi bi-star-fill star <?= $i <= 5 ? 'active' : '' ?>" 
                                           data-rating="<?= $i ?>" 
                                           style="font-size: 2rem; color: #ffc107; cursor: pointer; margin-right: 5px;"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="comment" class="form-label fw-bold">Bình Luận</label>
                                <textarea class="form-control" id="comment" name="comment" rows="4" 
                                          placeholder="Chia sẻ trải nghiệm của bạn về sản phẩm này..."></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send me-2"></i> Gửi Đánh Giá
                            </button>
                        </form>
                    </div>
                </div>
                <?php else: ?>
                <div class="alert alert-success">
                    <i class="bi bi-check-circle me-2"></i>
                    Bạn đã đánh giá sản phẩm này rồi. Cảm ơn bạn đã chia sẻ!
                </div>
                <?php endif; ?>
            <?php else: ?>
            <div class="alert alert-warning">
                <i class="bi bi-info-circle me-2"></i>
                <a href="<?= BASE_URL ?>auth/login" class="alert-link">Đăng nhập</a> để viết đánh giá và bình luận.
            </div>
            <?php endif; ?>
            
            <!-- Reviews List -->
            <div class="mt-4">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-chat-dots me-2"></i> 
                    Tất Cả Đánh Giá (<?= count($reviews) ?>)
                </h5>
                
                <?php if (empty($reviews)): ?>
                <div class="text-center py-5">
                    <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                    <p class="text-muted">Chưa có đánh giá nào</p>
                </div>
                <?php else: ?>
                <div class="reviews-list">
                    <?php foreach ($reviews as $review): ?>
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="fw-bold mb-1">
                                        <i class="bi bi-person-circle me-2"></i>
                                        <?= htmlspecialchars($review['full_name'] ?? 'Khách hàng') ?>
                                    </h6>
                                    <small class="text-muted">
                                        <i class="bi bi-calendar me-1"></i>
                                        <?= date('d/m/Y H:i', strtotime($review['created_at'])) ?>
                                    </small>
                                </div>
                                <div class="text-end">
                                    <div class="mb-1">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i class="bi bi-star<?= $i <= $review['rating'] ? '-fill' : '' ?> text-warning"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="badge bg-primary"><?= $review['rating'] ?>/5</span>
                                </div>
                            </div>
                            <?php if (!empty($review['comment'])): ?>
                            <p class="mb-0 mt-2" style="line-height: 1.6;">
                                <?= nl2br(htmlspecialchars($review['comment'])) ?>
                            </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
.star-rating .star {
    transition: all 0.2s ease;
}
.star-rating .star.active,
.star-rating .star.hover {
    color: #ffc107 !important;
    transform: scale(1.1);
}
.star-rating .star:not(.active):not(.hover) {
    color: #dee2e6 !important;
}
.reviews-list .card {
    transition: all 0.3s ease;
}
.reviews-list .card:hover {
    transform: translateX(5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
}
</style>

