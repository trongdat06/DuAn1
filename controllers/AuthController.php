<?php
require_once 'BaseController.php';
require_once 'models/AdminModel.php';
require_once 'models/CustomerModel.php';

class AuthController extends BaseController {
    
    private $adminModel;
    private $customerModel;
    
    public function __construct() {
        $this->adminModel = new AdminModel();
        $this->customerModel = new CustomerModel();
    }
    
    public function login() {
        // Kiểm tra nếu đã đăng nhập
        if (isset($_SESSION['customer_id'])) {
            $this->redirect('home/index');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            // Đăng nhập khách hàng
            $customer = $this->customerModel->getCustomerByEmail($email);
            
            if ($customer) {
                // Kiểm tra trạng thái khách hàng
                $status = $customer['status'] ?? 'active';
                if ($status === 'locked') {
                    $_SESSION['error'] = 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ với quản trị viên để được hỗ trợ.';
                    $this->redirect('auth/login');
                    return;
                }
                
                // Tạo session cho khách hàng (không cần password vì chưa có hệ thống password)
                $_SESSION['customer_id'] = $customer['customer_id'];
                $_SESSION['customer_name'] = $customer['full_name'];
                $_SESSION['customer_email'] = $customer['email'];
                
                $_SESSION['success'] = 'Đăng nhập thành công!';
                
                // Redirect về trang trước đó nếu có
                if (isset($_SESSION['redirect_after_login'])) {
                    $redirectUrl = $_SESSION['redirect_after_login'];
                    unset($_SESSION['redirect_after_login']);
                    $this->redirect($redirectUrl);
                } else {
                    $this->redirect('home/index');
                }
            } else {
                $_SESSION['error'] = 'Email không tồn tại. Vui lòng đăng ký tài khoản mới.';
            }
        }
        
        $data = ['pageTitle' => 'Đăng Nhập'];
        $this->view('auth/login', $data);
    }
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'full_name' => $_POST['full_name'] ?? '',
                'phone_number' => $_POST['phone_number'] ?? '',
                'email' => $_POST['email'] ?? '',
                'address' => $_POST['address'] ?? '',
                'gender' => $_POST['gender'] ?? '',
                'date_of_birth' => $_POST['date_of_birth'] ?? null
            ];
            
            // Kiểm tra email đã tồn tại chưa
            $existingCustomer = $this->customerModel->getCustomerByEmail($data['email']);
            if ($existingCustomer) {
                $_SESSION['error'] = 'Email đã được sử dụng. Vui lòng đăng nhập.';
                $this->redirect('auth/login');
            }
            
            $customerId = $this->customerModel->createCustomer($data);
            
            if ($customerId) {
                $_SESSION['customer_id'] = $customerId;
                $_SESSION['customer_name'] = $data['full_name'];
                $_SESSION['customer_email'] = $data['email'];
                
                $_SESSION['success'] = 'Đăng ký thành công!';
                
                // Redirect về trang trước đó nếu có
                if (isset($_SESSION['redirect_after_login'])) {
                    $redirectUrl = $_SESSION['redirect_after_login'];
                    unset($_SESSION['redirect_after_login']);
                    $this->redirect($redirectUrl);
                } else {
                    $this->redirect('home/index');
                }
            } else {
                $_SESSION['error'] = 'Đăng ký thất bại. Vui lòng thử lại.';
            }
        }
        
        $data = ['pageTitle' => 'Đăng Ký'];
        $this->view('auth/register', $data);
    }
    
    public function adminLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $manager = $this->adminModel->login($username, $password);
            
            if ($manager) {
                $_SESSION['admin_id'] = $manager['manager_id'];
                $_SESSION['admin_username'] = $manager['username'];
                $_SESSION['admin_name'] = $manager['full_name'];
                $_SESSION['admin_role'] = $manager['role'];
                
                $this->redirect('admin/dashboard');
            } else {
                $_SESSION['error'] = 'Tên đăng nhập hoặc mật khẩu không đúng';
            }
        }
        
        $data = ['pageTitle' => 'Đăng Nhập Admin'];
        $this->view('auth/admin_login', $data);
    }
    
    public function logout() {
        session_destroy();
        $this->redirect('home/index');
    }
    
    protected function requireAuth() {
        if (!isset($_SESSION['admin_id'])) {
            $this->redirect('auth/adminLogin');
        }
    }
}
?>

