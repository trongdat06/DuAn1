<?php
require_once 'BaseController.php';
require_once 'models/ProductModel.php';

class HomeController extends BaseController {
    
    private $productModel;
    
    public function __construct() {
        $this->productModel = new ProductModel();
    }
    
    public function index() {
        $featuredProducts = $this->productModel->getFeaturedProducts(8);
        $bestSellingProducts = $this->productModel->getBestSellingProducts(8);
        $categories = $this->productModel->getAllCategories();
        
        $data = [
            'featuredProducts' => $featuredProducts,
            'bestSellingProducts' => $bestSellingProducts,
            'categories' => $categories,
            'pageTitle' => 'Trang Chủ'
        ];
        
        $this->view('home/index', $data);
    }
}
?>

