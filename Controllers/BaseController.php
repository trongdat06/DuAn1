<?php
namespace App\Controllers;

class BaseController {
    protected function view($view, $data = []) {
        extract($data);
        require_once __DIR__ . "/../Views/{$view}.php";
    }
    
    protected function redirect($url) {
        header("Location: $url");
        exit();
    }
    
    protected function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
    
    protected function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
    
    protected function isAdmin() {
        return isset($_SESSION['user_role']) && 
               ($_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'manager');
    }
    
    protected function requireAuth() {
        if (!$this->isLoggedIn()) {
            $this->redirect('/auth/login.php');
        }
    }
    
    protected function requireAdmin() {
        if (!$this->isAdmin()) {
            $this->redirect('/auth/login.php');
        }
    }
    
    protected function requireCustomer() {
        if (!$this->isLoggedIn() || $_SESSION['user_type'] != 'customer') {
            $this->redirect('/auth/login.php');
        }
    }
    
    protected function sanitize($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

