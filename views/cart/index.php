<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Giỏ Hàng Của Bạn</h2>
        <p class="text-muted mb-0 small">
            <i class="bi bi-cart"></i> 
            <span id="totalItems"><?= count($cartItems) ?></span> sản phẩm trong giỏ hàng
        </p>
    </div>
    <?php if (!empty($cartItems)): ?>
    <div>
        <a href="<?= BASE_URL ?>product/index" class="btn btn-outline-primary">
            <i class="bi bi-plus-circle me-2"></i> Thêm Sản Phẩm
        </a>
    </div>
    <?php endif; ?>
</div>

<?php if (empty($cartItems)): ?>
    <div class="text-center py-5">
        <div class="mb-4">
            <i class="bi bi-cart-x" style="font-size: 5rem; color: #dee2e6;"></i>
        </div>
        <h3 class="mb-3">Giỏ hàng của bạn đang trống</h3>
        <p class="text-muted mb-4">Hãy thêm sản phẩm vào giỏ hàng để tiếp tục mua sắm</p>
        <a href="<?= BASE_URL ?>product/index" class="btn btn-primary btn-lg">
            <i class="bi bi-arrow-left me-2"></i> Tiếp Tục Mua Sắm
        </a>
    </div>
<?php else: ?>
    <form id="cartForm" method="POST" action="<?= BASE_URL ?>cart/removeMultiple">
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;" class="text-center">
                            <input type="checkbox" id="selectAll" class="form-check-input" title="Chọn tất cả">
                        </th>
                        <th>Sản Phẩm</th>
                        <th class="text-center">Giá</th>
                        <th class="text-center">Số Lượng</th>
                        <th class="text-end">Thành Tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                    <tr class="cart-item-row" data-variant-id="<?= $item['variant_id'] ?>" data-subtotal="<?= $item['subtotal'] ?>">
                        <td class="text-center">
                            <input type="checkbox" name="variant_ids[]" value="<?= $item['variant_id'] ?>" 
                                   class="form-check-input item-checkbox" 
                                   <?= $item['stock_quantity'] > 0 ? 'checked' : '' ?>
                                   <?= $item['stock_quantity'] == 0 ? 'disabled' : '' ?>>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <?php 
                                    $imgUrl = BASE_URL . "public/data/" . rawurlencode($item['product_name'] ?? 'default') . ".jpg";
                                ?>
                                <a href="<?= BASE_URL ?>product/detail/<?= $item['product_id'] ?>" class="text-decoration-none">
                                    <img src="<?= $imgUrl ?>" 
                                         alt="<?= htmlspecialchars($item['product_name']) ?>" 
                                         class="me-3 rounded shadow-sm" 
                                         style="width: 80px; height: 80px; object-fit: cover; transition: transform 0.2s;"
                                         onerror="this.src='https://placehold.co/80x80?text=<?= urlencode($item['product_name'] ?? '') ?>'"
                                         onmouseover="this.style.transform='scale(1.1)'"
                                         onmouseout="this.style.transform='scale(1)'">
                                </a>
                                <div>
                                    <a href="<?= BASE_URL ?>product/detail/<?= $item['product_id'] ?>" class="text-decoration-none text-dark">
                                        <strong class="d-block mb-1"><?= htmlspecialchars($item['product_name']) ?></strong>
                                    </a>
                                    <small class="text-muted d-block mb-1">
                                        <i class="bi bi-tag"></i> <?= htmlspecialchars($item['variant_name']) ?>
                                    </small>
                                    <small class="text-muted d-block">
                                        <i class="bi bi-palette"></i> <?= htmlspecialchars($item['color']) ?> | 
                                        <i class="bi bi-hdd"></i> <?= htmlspecialchars($item['storage']) ?>
                                    </small>
                                    <?php if ($item['stock_quantity'] <= 5 && $item['stock_quantity'] > 0): ?>
                                        <span class="badge bg-warning text-dark mt-1">
                                            <i class="bi bi-exclamation-triangle"></i> Còn <?= $item['stock_quantity'] ?> sản phẩm
                                        </span>
                                    <?php elseif ($item['stock_quantity'] == 0): ?>
                                        <span class="badge bg-danger mt-1">
                                            <i class="bi bi-x-circle"></i> Hết hàng
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-primary fw-bold fs-6"><?= number_format($item['price'], 0, ',', '.') ?>₫</span>
                        </td>
                        <td class="align-middle">
                            <form method="POST" action="<?= BASE_URL ?>cart/update" class="update-quantity-form d-inline">
                                <input type="hidden" name="variant_id" value="<?= $item['variant_id'] ?>">
                                <div class="input-group" style="width: 140px;">
                                    <button type="button" class="btn btn-outline-secondary btn-sm quantity-decrease" 
                                            data-variant-id="<?= $item['variant_id'] ?>" 
                                            data-current-qty="<?= $item['quantity'] ?>"
                                            <?= $item['quantity'] <= 1 ? 'disabled' : '' ?>>
                                        <i class="bi bi-dash"></i>
                                    </button>
                                    <input type="number" name="quantity" 
                                           class="form-control form-control-sm text-center quantity-input" 
                                           value="<?= $item['quantity'] ?>" 
                                           min="1" 
                                           max="<?= $item['stock_quantity'] ?>"
                                           data-variant-id="<?= $item['variant_id'] ?>"
                                           data-price="<?= $item['price'] ?>"
                                           data-stock="<?= $item['stock_quantity'] ?>"
                                           readonly>
                                    <button type="button" class="btn btn-outline-secondary btn-sm quantity-increase" 
                                            data-variant-id="<?= $item['variant_id'] ?>" 
                                            data-current-qty="<?= $item['quantity'] ?>"
                                            data-stock="<?= $item['stock_quantity'] ?>"
                                            <?= $item['quantity'] >= $item['stock_quantity'] ? 'disabled' : '' ?>>
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                                <small class="text-muted d-block mt-1 text-center">Tối đa: <?= $item['stock_quantity'] ?></small>
                            </form>
                        </td>
                        <td class="align-middle fw-bold text-danger fs-6 text-end item-subtotal" data-variant-id="<?= $item['variant_id'] ?>">
                            <?= number_format($item['subtotal'], 0, ',', '.') ?>₫
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <td colspan="4" class="text-end">
                            <strong class="fs-5">Tổng Tiền (Đã Chọn):</strong>
                        </td>
                        <td class="fw-bold text-danger fs-4 text-end" id="selectedTotal">
                            <?= number_format($total, 0, ',', '.') ?>₫
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-3">
            <div>
                <button type="submit" class="btn btn-danger btn-lg" id="removeSelectedBtn" disabled>
                    <i class="bi bi-trash me-2"></i> Xóa Các Sản Phẩm Đã Chọn 
                    <span class="badge bg-light text-dark ms-2" id="selectedCount">0</span>
                </button>
            </div>
            <div class="d-flex gap-2">
                <a href="<?= BASE_URL ?>product/index" class="btn btn-secondary btn-lg">
                    <i class="bi bi-arrow-left me-2"></i> Tiếp Tục Mua Sắm
                </a>
                <a href="<?= BASE_URL ?>cart/checkout" class="btn btn-primary btn-lg" id="checkoutBtn">
                    <i class="bi bi-cart-check me-2"></i> Thanh Toán
                </a>
            </div>
        </div>
    </form>
    
    <script>
    $(document).ready(function() {
        // Chọn tất cả - sử dụng event delegation
        $(document).on('change', '#selectAll', function() {
            var isChecked = $(this).prop('checked');
            $('.item-checkbox:not(:disabled)').prop('checked', isChecked);
            updateSelectedTotal();
        });
        
        // Khi checkbox item thay đổi - sử dụng event delegation
        $(document).on('change', '.item-checkbox', function() {
            var totalCheckboxes = $('.item-checkbox:not(:disabled)').length;
            var checkedCheckboxes = $('.item-checkbox:not(:disabled):checked').length;
            $('#selectAll').prop('checked', totalCheckboxes > 0 && checkedCheckboxes === totalCheckboxes);
            
            // Cập nhật tổng tiền
            updateSelectedTotal();
        });
        
        // Tăng số lượng
        $('.quantity-increase').on('click', function() {
            var input = $(this).siblings('.quantity-input');
            var currentQty = parseInt(input.val());
            var maxQty = parseInt(input.data('stock'));
            
            if (currentQty < maxQty) {
                input.val(currentQty + 1);
                updateQuantity(input.data('variant-id'), currentQty + 1);
            } else {
                showAlert('Số lượng không được vượt quá tồn kho (' + maxQty + ')', 'warning');
            }
        });
        
        // Giảm số lượng
        $('.quantity-decrease').on('click', function() {
            var input = $(this).siblings('.quantity-input');
            var currentQty = parseInt(input.val());
            
            if (currentQty > 1) {
                input.val(currentQty - 1);
                updateQuantity(input.data('variant-id'), currentQty - 1);
            }
        });
        
        // Cập nhật số lượng khi thay đổi input
        $('.quantity-input').on('change', function() {
            var variantId = $(this).data('variant-id');
            var newQty = parseInt($(this).val());
            var maxQty = parseInt($(this).data('stock'));
            
            if (newQty < 1) {
                $(this).val(1);
                newQty = 1;
            } else if (newQty > maxQty) {
                $(this).val(maxQty);
                newQty = maxQty;
                showAlert('Số lượng không được vượt quá tồn kho', 'warning');
            }
            
            updateQuantity(variantId, newQty);
        });
        
        // Cập nhật số lượng bằng AJAX
        function updateQuantity(variantId, quantity) {
            var form = $('.update-quantity-form').find('input[name="variant_id"][value="' + variantId + '"]').closest('form');
            var input = form.find('.quantity-input');
            var row = form.closest('tr');
            var price = parseFloat(input.data('price'));
            var subtotal = price * quantity;
            
            // Disable buttons
            form.find('button').prop('disabled', true);
            
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: {
                    variant_id: variantId,
                    quantity: quantity
                },
                success: function(response) {
                    // Cập nhật subtotal
                    row.find('.item-subtotal').text(subtotal.toLocaleString('vi-VN') + '₫');
                    row.data('subtotal', subtotal);
                    
                    // Cập nhật data attribute cho input
                    input.data('current-qty', quantity);
                    
                    // Cập nhật enable/disable buttons
                    if (quantity <= 1) {
                        form.find('.quantity-decrease').prop('disabled', true);
                    } else {
                        form.find('.quantity-decrease').prop('disabled', false);
                    }
                    
                    var maxQty = parseInt(input.data('stock'));
                    if (quantity >= maxQty) {
                        form.find('.quantity-increase').prop('disabled', true);
                    } else {
                        form.find('.quantity-increase').prop('disabled', false);
                    }
                    
                    // Cập nhật tổng tiền (tính lại từ các sản phẩm được chọn)
                    updateSelectedTotal();
                    
                    // Cập nhật số lượng trong header
                    updateCartCount();
                    
                    showAlert('Đã cập nhật số lượng', 'success');
                },
                error: function() {
                    // Rollback
                    input.val(input.data('current-qty'));
                    showAlert('Không thể cập nhật số lượng. Vui lòng thử lại.', 'danger');
                },
                complete: function() {
                    form.find('button').prop('disabled', false);
                }
            });
        }
        
        // Cập nhật tổng tiền
        function updateSelectedTotal() {
            var total = 0;
            var selectedCount = 0;
            
            // Chỉ đếm các checkbox được checked và không bị disabled
            $('.item-checkbox:checked:not(:disabled)').each(function() {
                var checkbox = $(this);
                var row = checkbox.closest('tr');
                var input = row.find('.quantity-input');
                
                // Tính lại subtotal từ giá và số lượng hiện tại
                var price = parseFloat(input.data('price')) || 0;
                var qty = parseInt(input.val()) || 0;
                
                if (price > 0 && qty > 0) {
                    var subtotal = price * qty;
                    
                    // Cập nhật lại data attribute và hiển thị
                    row.data('subtotal', subtotal);
                    row.find('.item-subtotal').text(subtotal.toLocaleString('vi-VN') + '₫');
                    
                    total += subtotal;
                    selectedCount++;
                }
            });
            
            // Cập nhật hiển thị tổng tiền
            $('#selectedTotal').text(total.toLocaleString('vi-VN') + '₫');
            $('#selectedCount').text(selectedCount);
            
            var hasSelected = selectedCount > 0;
            
            // Cập nhật trạng thái nút xóa
            $('#removeSelectedBtn').prop('disabled', !hasSelected);
            if (hasSelected) {
                $('#removeSelectedBtn').removeClass('btn-secondary').addClass('btn-danger');
            } else {
                $('#removeSelectedBtn').removeClass('btn-danger').addClass('btn-secondary');
            }
            
            // Cập nhật trạng thái nút thanh toán
            if (!hasSelected) {
                $('#checkoutBtn').attr('href', 'javascript:void(0)');
                $('#checkoutBtn').addClass('disabled').css('pointer-events', 'none').css('opacity', '0.6');
            } else {
                $('#checkoutBtn').attr('href', '<?= BASE_URL ?>cart/checkout');
                $('#checkoutBtn').removeClass('disabled').css('pointer-events', 'auto').css('opacity', '1');
            }
        }
        
        // Cập nhật số lượng giỏ hàng trong header
        function updateCartCount() {
            var totalCount = 0;
            $('.quantity-input').each(function() {
                totalCount += parseInt($(this).val()) || 0;
            });
            
            // Cập nhật badge trong header nếu có
            if ($('#cart-count').length) {
                $('#cart-count').text(totalCount);
            }
            
            // Cập nhật số lượng sản phẩm trong header
            var itemCount = $('.item-checkbox').length;
            $('#totalItems').text(itemCount);
        }
        
        // Hiển thị thông báo
        function showAlert(message, type) {
            type = type || 'info';
            var alertHtml = '<div class="alert alert-' + type + ' alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999; min-width: 300px;" role="alert">' +
                message +
                '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                '</div>';
            $('body').append(alertHtml);
            setTimeout(function() {
                $('.alert').fadeOut(function() {
                    $(this).remove();
                });
            }, 3000);
        }
        
        // Xử lý nút xóa - sử dụng click event thay vì form submit
        $('#removeSelectedBtn').on('click', function(e) {
            e.preventDefault();
            
            // Chỉ đếm các checkbox được checked và không bị disabled
            var selectedCount = $('.item-checkbox:checked:not(:disabled)').length;
            
            if (selectedCount === 0) {
                showAlert('Vui lòng chọn ít nhất một sản phẩm để xóa', 'warning');
                return false;
            }
            
            var message = selectedCount === 1 
                ? 'Bạn có chắc muốn xóa sản phẩm đã chọn?' 
                : 'Bạn có chắc muốn xóa ' + selectedCount + ' sản phẩm đã chọn?';
            
            if (!confirm(message)) {
                return false;
            }
            
            // Lấy danh sách variant_ids được chọn
            var variantIds = [];
            $('.item-checkbox:checked:not(:disabled)').each(function() {
                var variantId = $(this).val();
                if (variantId) {
                    variantIds.push(variantId);
                }
            });
            
            if (variantIds.length === 0) {
                showAlert('Không có sản phẩm nào được chọn', 'warning');
                return false;
            }
            
            // Disable nút và hiển thị loading
            var btn = $(this);
            var originalText = btn.html();
            btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Đang xóa...');
            
            // Tạo form ẩn để submit
            var form = $('<form>', {
                method: 'POST',
                action: '<?= BASE_URL ?>cart/removeMultiple',
                style: 'display: none;'
            });
            
            variantIds.forEach(function(variantId) {
                form.append($('<input>', {
                    type: 'hidden',
                    name: 'variant_ids[]',
                    value: variantId
                }));
            });
            
            $('body').append(form);
            form.submit();
        });
        
        // Xử lý khi click nút thanh toán
        $('#checkoutBtn').on('click', function(e) {
            if ($(this).hasClass('disabled')) {
                e.preventDefault();
                showAlert('Vui lòng chọn ít nhất một sản phẩm để thanh toán', 'warning');
                return false;
            }
            
            var selectedCount = $('.item-checkbox:checked:not(:disabled)').length;
            if (selectedCount === 0) {
                e.preventDefault();
                showAlert('Vui lòng chọn ít nhất một sản phẩm để thanh toán', 'warning');
                return false;
            }
        });
        
        
        // Khởi tạo - cập nhật trạng thái checkbox "Chọn tất cả"
        function initCheckboxes() {
            var totalCheckboxes = $('.item-checkbox:not(:disabled)').length;
            var checkedCheckboxes = $('.item-checkbox:not(:disabled):checked').length;
            $('#selectAll').prop('checked', totalCheckboxes > 0 && checkedCheckboxes === totalCheckboxes);
        }
        
        // Tự động bỏ chọn sản phẩm hết hàng và khởi tạo
        $('.cart-item-row').each(function() {
            var row = $(this);
            var stock = parseInt(row.find('.quantity-input').data('stock')) || 0;
            var checkbox = row.find('.item-checkbox');
            
            if (stock === 0) {
                checkbox.prop('checked', false);
                row.addClass('opacity-50');
            } else {
                // Đảm bảo sản phẩm còn hàng được checked mặc định
                if (!checkbox.prop('checked') && !checkbox.prop('disabled')) {
                    checkbox.prop('checked', true);
                }
            }
        });
        
        // Khởi tạo checkbox "Chọn tất cả"
        initCheckboxes();
        
        // Khởi tạo tổng tiền và số lượng
        updateSelectedTotal();
        updateCartCount();
        
        // Cập nhật lại khi có sự kiện từ bên ngoài (nếu có)
        $(document).on('cartUpdated', function() {
            updateSelectedTotal();
            updateCartCount();
            initCheckboxes();
        });
    });
    </script>
    
    <style>
    .quantity-input {
        border-left: none;
        border-right: none;
        font-weight: 600;
    }
    
    .quantity-input:focus {
        box-shadow: none;
        border-color: #ced4da;
    }
    
    .cart-item-row {
        transition: all 0.2s ease;
    }
    
    .cart-item-row:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }
    
    .table tbody tr {
        transition: all 0.2s ease;
    }
    
    .cart-item-row:has(.item-checkbox:checked) {
        background-color: #f0f7ff;
    }
    
    .cart-item-row.opacity-50 {
        opacity: 0.6;
    }
    
    .cart-item-row:has(.item-checkbox:disabled) {
        background-color: #f8f9fa;
    }
    
    .table thead th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
    
    #removeSelectedBtn:disabled,
    #checkoutBtn.disabled {
        opacity: 0.6;
        cursor: not-allowed;
        pointer-events: none;
    }
    
    .item-checkbox:disabled {
        cursor: not-allowed;
        opacity: 0.5;
    }
    
    .item-checkbox:checked + label,
    .cart-item-row:has(.item-checkbox:checked) {
        background-color: #f0f7ff;
    }
    
    #selectAll {
        cursor: pointer;
    }
    
    .item-checkbox {
        cursor: pointer;
    }
    </style>
<?php endif; ?>

