<?php
require_once 'BaseController.php';
require_once 'models/AdminModel.php';
require_once 'models/ProductModel.php';
require_once 'models/CustomerModel.php';
require_once 'models/OrderModel.php';

class AdminController extends BaseController {
    
    private $adminModel;
    private $productModel;
    private $customerModel;
    private $orderModel;
    
    public function __construct() {
        $this->checkAuth();
        $this->adminModel = new AdminModel();
        $this->productModel = new ProductModel();
        $this->customerModel = new CustomerModel();
        $this->orderModel = new OrderModel();
    }
    
    private function checkAuth() {
        if (!isset($_SESSION['admin_id'])) {
            $this->redirect('auth/login');
        }
    }
    
    public function dashboard() {
        $stats = $this->adminModel->getDashboardStats();
        $recentOrders = $this->orderModel->getAllOrders(5);
        
        $data = [
            'stats' => $stats,
            'recentOrders' => $recentOrders,
            'pageTitle' => 'Dashboard'
        ];
        
        $this->view('admin/dashboard', $data, true);
    }
    
    // Quản lý sản phẩm
    public function products() {
        $products = $this->productModel->getAllProducts();
        $categories = $this->productModel->getAllCategories();
        
        $data = [
            'products' => $products,
            'categories' => $categories,
            'pageTitle' => 'Quản Lý Sản Phẩm'
        ];
        
        $this->view('admin/products/index', $data, true);
    }
    
    public function productCreate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'product_name' => $_POST['product_name'],
                'brand' => $_POST['brand'],
                'description' => $_POST['description'],
                'category_id' => $_POST['category_id'] ?: null,
                'supplier_id' => $_POST['supplier_id'] ?: null
            ];
            
            if ($this->productModel->createProduct($data)) {
                $_SESSION['success'] = 'Tạo sản phẩm thành công';
                $this->redirect('admin/products');
            } else {
                $_SESSION['error'] = 'Không thể tạo sản phẩm';
            }
        }
        
        $categories = $this->productModel->getAllCategories();
        $data = [
            'categories' => $categories,
            'pageTitle' => 'Thêm Sản Phẩm'
        ];
        
        $this->view('admin/products/create', $data, true);
    }
    
    public function productEdit($id) {
        $product = $this->productModel->getProductById($id);
        
        if (!$product) {
            $this->redirect('admin/products');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'product_name' => $_POST['product_name'],
                'brand' => $_POST['brand'],
                'description' => $_POST['description'],
                'category_id' => $_POST['category_id'] ?: null,
                'supplier_id' => $_POST['supplier_id'] ?: null
            ];
            
            if ($this->productModel->updateProduct($id, $data)) {
                $_SESSION['success'] = 'Cập nhật sản phẩm thành công';
                $this->redirect('admin/products');
            } else {
                $_SESSION['error'] = 'Không thể cập nhật sản phẩm';
            }
        }
        
        $variants = $this->productModel->getProductVariants($id);
        $categories = $this->productModel->getAllCategories();
        
        $data = [
            'product' => $product,
            'variants' => $variants,
            'categories' => $categories,
            'pageTitle' => 'Sửa Sản Phẩm'
        ];
        
        $this->view('admin/products/edit', $data, true);
    }
    
    public function productDelete($id) {
        if ($this->productModel->deleteProduct($id)) {
            $_SESSION['success'] = 'Xóa sản phẩm thành công';
        } else {
            $_SESSION['error'] = 'Không thể xóa sản phẩm';
        }
        $this->redirect('admin/products');
    }
    
    public function variantCreate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'product_id' => $_POST['product_id'],
                'variant_name' => $_POST['variant_name'],
                'color' => $_POST['color'],
                'storage' => $_POST['storage'],
                'price' => $_POST['price'],
                'stock_quantity' => $_POST['stock_quantity'],
                'warranty_months' => $_POST['warranty_months']
            ];
            
            if ($this->productModel->createVariant($data)) {
                $_SESSION['success'] = 'Tạo biến thể thành công';
                $this->redirect('admin/productEdit/' . $data['product_id']);
            } else {
                $_SESSION['error'] = 'Không thể tạo biến thể';
            }
        }
        $this->redirect('admin/products');
    }
    
    public function variantEdit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'variant_name' => $_POST['variant_name'],
                'color' => $_POST['color'],
                'storage' => $_POST['storage'],
                'price' => $_POST['price'],
                'stock_quantity' => $_POST['stock_quantity'],
                'warranty_months' => $_POST['warranty_months']
            ];
            
            $variant = $this->productModel->getVariantById($id);
            
            if ($this->productModel->updateVariant($id, $data)) {
                $_SESSION['success'] = 'Cập nhật biến thể thành công';
                $this->redirect('admin/productEdit/' . $variant['product_id']);
            } else {
                $_SESSION['error'] = 'Không thể cập nhật biến thể';
            }
        }
        $this->redirect('admin/products');
    }
    
    public function variantDelete($id) {
        $variant = $this->productModel->getVariantById($id);
        if ($this->productModel->deleteVariant($id)) {
            $_SESSION['success'] = 'Xóa biến thể thành công';
            $this->redirect('admin/productEdit/' . $variant['product_id']);
        } else {
            $_SESSION['error'] = 'Không thể xóa biến thể';
        }
        $this->redirect('admin/products');
    }
    
    // Quản lý khách hàng
    public function customers() {
        $customers = $this->customerModel->getAllCustomers();
        
        $data = [
            'customers' => $customers,
            'pageTitle' => 'Quản Lý Khách Hàng'
        ];
        
        $this->view('admin/customers/index', $data, true);
    }
    
    public function customerEdit($id) {
        $customer = $this->customerModel->getCustomerById($id);
        
        if (!$customer) {
            $this->redirect('admin/customers');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'full_name' => $_POST['full_name'],
                'phone_number' => $_POST['phone_number'],
                'email' => $_POST['email'],
                'address' => $_POST['address'],
                'gender' => $_POST['gender'],
                'date_of_birth' => $_POST['date_of_birth'] ?: null
            ];
            
            if ($this->customerModel->updateCustomer($id, $data)) {
                $_SESSION['success'] = 'Cập nhật khách hàng thành công';
                $this->redirect('admin/customers');
            } else {
                $_SESSION['error'] = 'Không thể cập nhật khách hàng';
            }
        }
        
        $data = [
            'customer' => $customer,
            'pageTitle' => 'Sửa Khách Hàng'
        ];
        
        $this->view('admin/customers/edit', $data, true);
    }
    
    public function customerDelete($id) {
        if ($this->customerModel->deleteCustomer($id)) {
            $_SESSION['success'] = 'Xóa khách hàng thành công';
        } else {
            $_SESSION['error'] = 'Không thể xóa khách hàng';
        }
        $this->redirect('admin/customers');
    }
    
    // Quản lý đơn hàng
    public function orders() {
        $orders = $this->orderModel->getAllOrders();
        
        $data = [
            'orders' => $orders,
            'pageTitle' => 'Quản Lý Đơn Hàng'
        ];
        
        $this->view('admin/orders/index', $data, true);
    }
    
    public function orderDetail($id) {
        $order = $this->orderModel->getOrderById($id);
        $orderDetails = $this->orderModel->getOrderDetails($id);
        $statuses = $this->orderModel->getAllOrderStatuses();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $statusId = $_POST['status_id'];
            if ($this->orderModel->updateOrderStatus($id, $statusId)) {
                $_SESSION['success'] = 'Cập nhật trạng thái đơn hàng thành công';
                $this->redirect('admin/orderDetail/' . $id);
            }
        }
        
        $data = [
            'order' => $order,
            'orderDetails' => $orderDetails,
            'statuses' => $statuses,
            'pageTitle' => 'Chi Tiết Đơn Hàng'
        ];
        
        $this->view('admin/orders/detail', $data, true);
    }
}
?>

