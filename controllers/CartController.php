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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $variantId = isset($_POST['variant_id']) ? (int)$_POST['variant_id'] : 0;
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
            
            if ($variantId > 0 && $quantity > 0) {
                if ($this->cartModel->addToCart($variantId, $quantity)) {
                    if (isset($_POST['ajax'])) {
                        $this->jsonResponse([
                            'success' => true,
                            'message' => 'Đã thêm vào giỏ hàng',
                            'cartCount' => $this->cartModel->getCartCount()
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
                    $_SESSION['success'] = 'Đã cập nhật giỏ hàng';
                } else {
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
}
?>

