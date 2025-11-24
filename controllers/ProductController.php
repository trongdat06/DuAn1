<?php
require_once 'BaseController.php';
require_once 'models/ProductModel.php';

class ProductController extends BaseController {
    
    private $productModel;
    
    public function __construct() {
        $this->productModel = new ProductModel();
    }
    
    public function index() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 12;
        $offset = ($page - 1) * $limit;
        
        $products = $this->productModel->getAllProducts($limit, $offset);
        $categories = $this->productModel->getAllCategories();
        
        $data = [
            'products' => $products,
            'categories' => $categories,
            'page' => $page,
            'pageTitle' => 'Sản Phẩm'
        ];
        
        $this->view('products/index', $data);
    }
    
    public function detail($id) {
        $product = $this->productModel->getProductById($id);
        
        if (!$product) {
            $this->redirect('product/index');
        }
        
        $variants = $this->productModel->getProductVariants($id);
        
        $data = [
            'product' => $product,
            'variants' => $variants,
            'pageTitle' => $product['product_name']
        ];
        
        $this->view('products/detail', $data);
    }
    
    public function search() {
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        
        if (empty($keyword)) {
            $this->redirect('product/index');
        }
        
        $products = $this->productModel->searchProducts($keyword);
        $categories = $this->productModel->getAllCategories();
        
        $data = [
            'products' => $products,
            'categories' => $categories,
            'keyword' => $keyword,
            'pageTitle' => 'Tìm kiếm: ' . $keyword
        ];
        
        $this->view('products/search', $data);
    }
    
    public function category($id) {
        $products = $this->productModel->getProductsByCategory($id);
        $categories = $this->productModel->getAllCategories();
        
        $data = [
            'products' => $products,
            'categories' => $categories,
            'categoryId' => $id,
            'pageTitle' => 'Danh Mục'
        ];
        
        $this->view('products/category', $data);
    }
}
?>

