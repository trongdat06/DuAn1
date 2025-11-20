<?php
namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\CustomerModel;

class AuthController extends BaseController {
    private $authModel;
    private $customerModel;
    
    public function __construct() {
        $this->authModel = new AuthModel();
        $this->customerModel = new CustomerModel();
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $this->sanitize($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $user_type = $_POST['user_type'] ?? 'customer';
            
            if (empty($username) || empty($password)) {
                $this->view('auth_login', ['error' => 'Vui lòng nhập đầy đủ thông tin!']);
                return;
            }
            
            if ($user_type == 'admin') {
                $manager = $this->authModel->loginManager($username, $password);
                
                if ($manager) {
                    $_SESSION['user_id'] = $manager['manager_id'];
                    $_SESSION['username'] = $manager['username'];
                    $_SESSION['full_name'] = $manager['full_name'];
                    $_SESSION['user_role'] = $manager['role'];
                    $_SESSION['user_type'] = 'admin';
                    
                    $this->redirect('/admin/dashboard.php');
                } else {
                    $this->view('auth_login', ['error' => 'Tên đăng nhập hoặc mật khẩu không đúng!']);
                }
            } else {
                $customer = $this->authModel->loginCustomer($username);
                
                if ($customer) {
                    $_SESSION['user_id'] = $customer['customer_id'];
                    $_SESSION['username'] = $customer['phone_number'];
                    $_SESSION['full_name'] = $customer['full_name'];
                    $_SESSION['user_role'] = 'customer';
                    $_SESSION['user_type'] = 'customer';
                    
                    $this->redirect('/index.php');
                } else {
                    $this->view('auth_login', ['error' => 'Số điện thoại hoặc email không tồn tại!']);
                }
            }
        } else {
            $this->view('auth/login');
        }
    }
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'full_name' => $this->sanitize($_POST['full_name'] ?? ''),
                'phone_number' => $this->sanitize($_POST['phone_number'] ?? ''),
                'email' => $this->sanitize($_POST['email'] ?? ''),
                'address' => $this->sanitize($_POST['address'] ?? ''),
                'gender' => $this->sanitize($_POST['gender'] ?? ''),
                'date_of_birth' => $_POST['date_of_birth'] ?? null
            ];
            
            if (empty($data['full_name']) || empty($data['phone_number']) || empty($data['email'])) {
                $this->view('auth_register', ['error' => 'Vui lòng điền đầy đủ thông tin!']);
                return;
            }
            
            if ($this->customerModel->exists($data['phone_number'], $data['email'])) {
                $this->view('auth_register', ['error' => 'Số điện thoại hoặc email đã được sử dụng!']);
                return;
            }
            
            $this->customerModel->create($data);
            $this->view('auth_register', ['success' => 'Đăng ký thành công! Bạn có thể đăng nhập ngay.']);
        } else {
            $this->view('auth/register');
        }
    }
    
    public function logout() {
        session_destroy();
        $this->redirect('/index.php');
    }
}

