<?php
require_once 'BaseController.php';
require_once 'models/AdminModel.php';

class AuthController extends BaseController {
    
    private $adminModel;
    
    public function __construct() {
        $this->adminModel = new AdminModel();
    }
    
    public function login() {
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
        $this->view('auth/login', $data);
    }
    
    public function logout() {
        session_destroy();
        $this->redirect('home/index');
    }
    
    protected function requireAuth() {
        if (!isset($_SESSION['admin_id'])) {
            $this->redirect('auth/login');
        }
    }
}
?>

