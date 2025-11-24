// Main JavaScript for User Frontend

$(document).ready(function() {
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
    
    // Format currency on page load
    $('.price').each(function() {
        var price = $(this).text();
        if (price && !isNaN(price)) {
            $(this).text(formatCurrency(price));
        }
    });
});

function formatCurrency(amount) {
    return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND'
    }).format(amount);
}

// Add to cart with AJAX
function addToCart(variantId, quantity) {
    $.ajax({
        url: BASE_URL + 'cart/add',
        method: 'POST',
        data: {
            variant_id: variantId,
            quantity: quantity || 1,
            ajax: 1
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $('#cart-count').text(response.cartCount);
                alert(response.message);
            } else {
                alert(response.message);
            }
        },
        error: function() {
            alert('Có lỗi xảy ra khi thêm vào giỏ hàng');
        }
    });
}

