<?php
require_once 'BaseController.php';
require_once 'models/CartModel.php';
require_once 'models/ProductModel.php';
require_once 'models/CustomerModel.php';
require_once 'models/OrderModel.php';

class CartController extends BaseController {
    
    private $cartModel;
    private $productModel;
    private $customerModel;
    private $orderModel;
    
    public function __construct() {
        $this->cartModel = new CartModel();
        $this->productModel = new ProductModel();
        $this->customerModel = new CustomerModel();
        $this->orderModel = new OrderModel();
    }
    
    public function index() {
        $cartItems = $this->cartModel->getCartItems();
        $total = $this->cartModel->getCartTotal();
        
        $data = [
            'cartItems' => $cartItems,
            'total' => $total,
            'pageTitle' => 'Giỏ Hàng'
        ];
        
        $this->view('cart/index', $data);
    }
    
    public function add() {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['customer_id'])) {
            if (isset($_POST['ajax'])) {
                $this->jsonResponse([
                    'success' => false,
                    'message' => 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng',
                    'requireLogin' => true,
                    'loginUrl' => BASE_URL . 'auth/login'
                ], 401);
                return;
            } else {
                $_SESSION['error'] = 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng';
                
                // Lưu URL redirect (chuyển từ absolute sang relative nếu cần)
                $referer = $_SERVER['HTTP_REFERER'] ?? '';
                if (!empty($referer) && strpos($referer, BASE_URL) !== false) {
                    $redirectUrl = str_replace(BASE_URL, '', $referer);
                    $_SESSION['redirect_after_login'] = $redirectUrl;
                } else {
                    $_SESSION['redirect_after_login'] = 'product/index';
                }
                
                $this->redirect('auth/login');
                return;
            }
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $variantId = isset($_POST['variant_id']) ? (int)$_POST['variant_id'] : 0;
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
            
            if ($variantId > 0 && $quantity > 0) {
                if ($this->cartModel->addToCart($variantId, $quantity)) {
                    if (isset($_POST['ajax'])) {
                        $this->jsonResponse([
                            'success' => true,
                            'message' => 'Đã thêm vào giỏ hàng',
                            'cartCount' => $this->cartModel->getCartCount(),
                            'cart' => isset($_SESSION['cart']) ? $_SESSION['cart'] : []
                        ]);
                    } else {
                        $_SESSION['success'] = 'Đã thêm vào giỏ hàng';
                        $this->redirect('cart/index');
                    }
                } else {
                    if (isset($_POST['ajax'])) {
                        $this->jsonResponse([
                            'success' => false,
                            'message' => 'Không đủ hàng trong kho'
                        ], 400);
                    } else {
                        $_SESSION['error'] = 'Không đủ hàng trong kho';
                        $this->redirect('product/index');
                    }
                }
            }
        }
        $this->redirect('product/index');
    }
    
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $variantId = isset($_POST['variant_id']) ? (int)$_POST['variant_id'] : 0;
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;
            
            if ($variantId > 0) {
                if ($this->cartModel->updateCart($variantId, $quantity)) {
                    if (isset($_POST['ajax']) || isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                        $this->jsonResponse([
                            'success' => true,
                            'message' => 'Đã cập nhật giỏ hàng',
                            'cartCount' => $this->cartModel->getCartCount(),
                            'cartTotal' => $this->cartModel->getCartTotal(),
                            'cart' => isset($_SESSION['cart']) ? $_SESSION['cart'] : []
                        ]);
                        return;
                    }
                    $_SESSION['success'] = 'Đã cập nhật giỏ hàng';
                } else {
                    if (isset($_POST['ajax']) || isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                        $this->jsonResponse([
                            'success' => false,
                            'message' => 'Không đủ hàng trong kho'
                        ], 400);
                        return;
                    }
                    $_SESSION['error'] = 'Không đủ hàng trong kho';
                }
            }
        }
        $this->redirect('cart/index');
    }
    
    public function remove($variantId) {
        if ($this->cartModel->removeFromCart($variantId)) {
            $_SESSION['success'] = 'Đã xóa sản phẩm khỏi giỏ hàng';
        }
        $this->redirect('cart/index');
    }
    
    public function removeMultiple() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['variant_ids'])) {
            $variantIds = $_POST['variant_ids'];
            $removedCount = 0;
            
            foreach ($variantIds as $variantId) {
                if ($this->cartModel->removeFromCart((int)$variantId)) {
                    $removedCount++;
                }
            }
            
            if ($removedCount > 0) {
                $_SESSION['success'] = 'Đã xóa ' . $removedCount . ' sản phẩm khỏi giỏ hàng';
                
                if (isset($_POST['ajax'])) {
                    $this->jsonResponse([
                        'success' => true,
                        'message' => 'Đã xóa ' . $removedCount . ' sản phẩm khỏi giỏ hàng',
                        'cartCount' => $this->cartModel->getCartCount(),
                        'cart' => isset($_SESSION['cart']) ? $_SESSION['cart'] : []
                    ]);
                    return;
                }
            } else {
                $_SESSION['error'] = 'Không thể xóa sản phẩm';
            }
        }
        $this->redirect('cart/index');
    }
    
    public function checkout() {
        $cartItems = $this->cartModel->getCartItems();
        
        if (empty($cartItems)) {
            $_SESSION['error'] = 'Giỏ hàng trống';
            $this->redirect('cart/index');
        }
        
        $data = [
            'cartItems' => $cartItems,
            'total' => $this->cartModel->getCartTotal(),
            'pageTitle' => 'Thanh Toán'
        ];
        
        $this->view('cart/checkout', $data);
    }
    
    public function processOrder() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('cart/index');
        }
        
        $cartItems = $this->cartModel->getCartItems();
        if (empty($cartItems)) {
            $_SESSION['error'] = 'Giỏ hàng trống';
            $this->redirect('cart/index');
        }
        
        // Lấy thông tin khách hàng
        $customerData = [
            'full_name' => $_POST['full_name'] ?? '',
            'phone_number' => $_POST['phone_number'] ?? '',
            'email' => $_POST['email'] ?? '',
            'address' => $_POST['address'] ?? '',
            'gender' => $_POST['gender'] ?? '',
            'date_of_birth' => $_POST['date_of_birth'] ?? null
        ];
        
        // Kiểm tra email đã tồn tại chưa
        $customer = $this->customerModel->getCustomerByEmail($customerData['email']);
        if ($customer) {
            $customerId = $customer['customer_id'];
        } else {
            $customerId = $this->customerModel->createCustomer($customerData);
        }
        
        if (!$customerId) {
            $_SESSION['error'] = 'Không thể tạo khách hàng';
            $this->redirect('cart/checkout');
        }
        
        // Tạo đơn hàng
        $total = $this->cartModel->getCartTotal();
        $paymentMethod = $_POST['payment_method'] ?? 'Tiền mặt';
        $note = $_POST['note'] ?? '';
        
        $orderId = $this->orderModel->createOrder($customerId, $total, $paymentMethod, $note);
        
        if ($orderId) {
            // Tạo chi tiết đơn hàng
            foreach ($cartItems as $item) {
                $this->orderModel->createOrderDetail(
                    $orderId,
                    $item['variant_id'],
                    $item['quantity'],
                    $item['price'],
                    0,
                    $item['subtotal']
                );
            }
            
            // Xóa giỏ hàng
            $this->cartModel->clearCart();
            
            $_SESSION['success'] = 'Đặt hàng thành công! Mã đơn hàng: #' . $orderId;
            $this->redirect('cart/orderSuccess/' . $orderId);
        } else {
            $_SESSION['error'] = 'Không thể tạo đơn hàng';
            $this->redirect('cart/checkout');
        }
    }
    
    public function orderSuccess($orderId) {
        $order = $this->orderModel->getOrderById($orderId);
        $orderDetails = $this->orderModel->getOrderDetails($orderId);
        
        $data = [
            'order' => $order,
            'orderDetails' => $orderDetails,
            'pageTitle' => 'Đặt Hàng Thành Công'
        ];
        
        $this->view('cart/order_success', $data);
    }
    
    // Lấy giỏ hàng hiện tại (để sync với localStorage)
    public function getCart() {
        if (!isset($_SESSION['customer_id'])) {
            $this->jsonResponse([
                'success' => false,
                'message' => 'Chưa đăng nhập'
            ], 401);
            return;
        }
        
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        $this->jsonResponse([
            'success' => true,
            'cart' => $cart,
            'cartCount' => $this->cartModel->getCartCount()
        ]);
    }
    
    // Đồng bộ giỏ hàng từ localStorage lên session
    public function syncCart() {
        if (!isset($_SESSION['customer_id'])) {
            $this->jsonResponse([
                'success' => false,
                'message' => 'Chưa đăng nhập'
            ], 401);
            return;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart'])) {
            $cartData = json_decode($_POST['cart'], true);
            
            if (is_array($cartData)) {
                // Validate và merge với cart hiện tại
                $validCart = [];
                foreach ($cartData as $variantId => $quantity) {
                    $variantId = (int)$variantId;
                    $quantity = (int)$quantity;
                    
                    if ($variantId > 0 && $quantity > 0) {
                        // Kiểm tra tồn kho
                        $sql = "SELECT stock_quantity FROM Product_Variants WHERE variant_id = :variant_id";
                        $stmt = $this->cartModel->conn->prepare($sql);
                        $stmt->bindParam(':variant_id', $variantId);
                        $stmt->execute();
                        $variant = $stmt->fetch();
                        
                        if ($variant && $variant['stock_quantity'] >= $quantity) {
                            $validCart[$variantId] = $quantity;
                        } else if ($variant && $variant['stock_quantity'] > 0) {
                            // Điều chỉnh số lượng nếu vượt quá tồn kho
                            $validCart[$variantId] = $variant['stock_quantity'];
                        }
                    }
                }
                
                // Merge với cart hiện tại (ưu tiên số lượng lớn hơn)
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }
                
                foreach ($validCart as $variantId => $quantity) {
                    if (!isset($_SESSION['cart'][$variantId]) || $_SESSION['cart'][$variantId] < $quantity) {
                        $_SESSION['cart'][$variantId] = $quantity;
                    }
                }
                
                // Xóa các sản phẩm không còn trong localStorage
                foreach ($_SESSION['cart'] as $variantId => $quantity) {
                    if (!isset($validCart[$variantId])) {
                        // Giữ lại trong session nếu đang ở trang cart
                        // Chỉ xóa nếu không có trong localStorage
                    }
                }
                
                $this->jsonResponse([
                    'success' => true,
                    'cart' => $_SESSION['cart'],
                    'cartCount' => $this->cartModel->getCartCount(),
                    'message' => 'Đã đồng bộ giỏ hàng'
                ]);
                return;
            }
        }
        
        $this->jsonResponse([
            'success' => false,
            'message' => 'Dữ liệu không hợp lệ'
        ], 400);
    }
}
?>

