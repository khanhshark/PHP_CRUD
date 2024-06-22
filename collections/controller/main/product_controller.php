<?php 
require_once('controller/base_controller.php');
require_once('Models/product.php');
require_once('Models/history.php');
require_once('Models/category.php');
class productController extends BaseController{
    function __construct()
    {
        $this->folder = 'views/product';
    }
    function index(){
        $current_page = isset($_GET['numberpage']) ? $_GET['numberpage'] : 1;
        $products = product::getAllproduct();
        $total_pages =  ceil(count($products) / 5);
        //! để lấy danh sách của categories() thêm id
        $categories = category::getAllcategory();
        $data  = array(
            "categories" => $categories,
            "products" => array_slice($products, ($current_page - 1) * 5, 5),
            "total_pages" => $total_pages
        );
       
        $this->renderview('index', $data);
      
    }
    function getproductid(){
      
        $productid = $_GET['productid'];
        $product = product::getproductid( $productid);
        history::addNewProduct($productid,"getproductid");
        $data  = array(
            "product" => $product,
        );
        $this->renderview('infoProduct', $data);
      
    }
    function add(){
        $price = $_POST['addPrice'];
        $description = $_POST['addDescription'];
        $category_id = $_POST['addCategory'];
        $name = $_POST['addName'];
        $product_id = product::addNewProduct($name, $price, $description, $category_id);
        history::addNewProduct($product_id,"addproduct");
       
        
        header("Location: index.php?page=main&controller=product&action=index");
    }
    function edit(){
      
        $product_id = $_POST['editProductId'];
        $price = $_POST['editPrice'];
        $description = $_POST['editDescription'];
        $category_id = $_POST['editCategory'];
        $name = $_POST['editName'];
        history::addNewProduct($product_id,"Editproduct");
        product::updateProduct($product_id, $name, $price, $description, $category_id);
        header("Location: index.php?page=main&controller=product&action=index");
        exit();
    }
    function delete(){
       
        $product_id = $_POST['deleteProductId'];
        product::deleteProduct($product_id);
        history::addNewProduct($product_id,"deleteproduct");
        header("Location: index.php?page=main&controller=product&action=index");
    }

}



?> 