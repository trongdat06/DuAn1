<?php
require_once 'BaseController.php';
require_once 'models/ProductModel.php';
require_once 'models/ReviewModel.php';

class ProductController extends BaseController {
    
    private $productModel;
    private $reviewModel;
    
    public function __construct() {
        $this->productModel = new ProductModel();
        $this->reviewModel = new ReviewModel();
    }
    
    public function index() {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 12;
        $offset = ($page - 1) * $limit;
        
        // Get filters
        $filters = [];
        if (!empty($_GET['category_id'])) {
            $filters['category_id'] = (int)$_GET['category_id'];
        }
        if (!empty($_GET['brand'])) {
            $filters['brand'] = $_GET['brand'];
        }
        if (!empty($_GET['min_price'])) {
            $filters['min_price'] = (int)$_GET['min_price'];
        }
        if (!empty($_GET['max_price'])) {
            $filters['max_price'] = (int)$_GET['max_price'];
        }
        if (isset($_GET['in_stock']) && $_GET['in_stock'] == '1') {
            $filters['in_stock'] = true;
        }
        
        // Get sort
        $sort = $_GET['sort'] ?? 'newest';
        $allowedSorts = ['newest', 'price_asc', 'price_desc', 'name_asc', 'name_desc'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'newest';
        }
        
        // Get products
        $products = $this->productModel->getAllProducts($limit, $offset, $filters, $sort);
        $totalProducts = $this->productModel->getProductsCount($filters);
        $totalPages = ceil($totalProducts / $limit);
        
        // Get filter options
        $categories = $this->productModel->getAllCategories();
        $brands = $this->productModel->getAllBrands();
        $priceRange = $this->productModel->getPriceRange();
        
        // Process products to add min_price
        foreach ($products as &$product) {
            $variants = $this->productModel->getProductVariants($product['product_id']);
            if ($variants) {
                $prices = array_column($variants, 'price');
                $product['min_price'] = min($prices);
                $product['max_price'] = max($prices);
            } else {
                $product['min_price'] = 0;
                $product['max_price'] = 0;
            }
        }
        
        $data = [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'priceRange' => $priceRange,
            'filters' => $filters,
            'sort' => $sort,
            'page' => $page,
            'totalPages' => $totalPages,
            'totalProducts' => $totalProducts,
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
        
        // Get reviews
        $reviews = $this->reviewModel->getReviewsByProduct($id);
        $reviewStats = $this->reviewModel->getReviewStats($id);
        
        // Check if current user has reviewed
        $hasReviewed = false;
        if (isset($_SESSION['customer_id'])) {
            $hasReviewed = $this->reviewModel->hasReviewed($id, $_SESSION['customer_id']);
        }
        
        $data = [
            'product' => $product,
            'variants' => $variants,
            'reviews' => $reviews,
            'reviewStats' => $reviewStats,
            'hasReviewed' => $hasReviewed,
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

