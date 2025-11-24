// Cart Functions
function addToCart(variantId, quantity = 1) {
    const formData = new FormData();
    formData.append('action', 'add');
    formData.append('variant_id', variantId);
    formData.append('quantity', quantity);
    
    fetch('/duann1/api/cart.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            updateCartCount();
            if (window.location.pathname.includes('cart.php')) {
                location.reload();
            }
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra khi thêm vào giỏ hàng');
    });
}

function updateCart(variantId, quantity) {
    const formData = new FormData();
    formData.append('action', 'update');
    formData.append('variant_id', variantId);
    formData.append('quantity', quantity);
    
    fetch('/duann1/api/cart.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra khi cập nhật giỏ hàng');
    });
}

function removeFromCart(variantId) {
    if (!confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')) {
        return;
    }
    
    const formData = new FormData();
    formData.append('action', 'remove');
    formData.append('variant_id', variantId);
    
    fetch('/duann1/api/cart.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra khi xóa sản phẩm');
    });
}

function updateCartCount() {
    fetch('/duann1/api/cart.php?action=get')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const cartLinks = document.querySelectorAll('a[href*="cart.php"]');
                cartLinks.forEach(link => {
                    const text = link.textContent;
                    const match = text.match(/Giỏ hàng \((\d+)\)/);
                    if (match) {
                        link.textContent = `Giỏ hàng (${data.cart_count})`;
                    }
                });
            }
        })
        .catch(error => {
            console.error('Error updating cart count:', error);
        });
}

// Initialize cart count on page load
document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();
    
    // Search functionality
    const searchInput = document.querySelector('.search-input');
    const searchBtn = document.querySelector('.search-btn');
    
    if (searchInput && searchBtn) {
        function performSearch() {
            const query = searchInput.value.trim();
            if (query) {
                window.location.href = '/duann1/products.php?search=' + encodeURIComponent(query);
            }
        }
        
        searchBtn.addEventListener('click', function(e) {
            e.preventDefault();
            performSearch();
        });
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                performSearch();
            }
        });
    }
});

// Form validation
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return false;
    
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            isValid = false;
            input.style.borderColor = '#dc3545';
        } else {
            input.style.borderColor = '#ddd';
        }
    });
    
    if (!isValid) {
        alert('Vui lòng điền đầy đủ thông tin bắt buộc!');
    }
    
    return isValid;
}

// Image placeholder
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('img[onerror]');
    images.forEach(img => {
        img.addEventListener('error', function() {
            this.src = 'assets/images/placeholder.jpg';
        });
    });
});

