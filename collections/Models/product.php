<?php 
require_once('config.php');
 class product {
    public $id;
    public $name;
    public $price;
    public $description;
    public $category_id;
    public $created;
    public $modified;

    public function __construct($id, $name, $price, $description, $category_id,$created, $modified) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->category_id = $category_id;
        $this->created = $created;
        $this->modified = $modified;
    }
    public static function getAllproduct() {
        $database = new Database();
        $result = false;
        
       
        if($database->connect()){
            $result = $database->select("product","products",array("id","name","price","description","category_id","created","modified"),null,"id ASC");
            
            $database->disconnect();
           if($result === false){
            echo "Error: Data corruption detected in the 'product' table. Please investigate and repair the database.";
           } 
        }
        return $result;
    }
    public static function getproductid($productid) {
        $database = new Database();
        $result = false;
        
       
        if($database->connect()){
            $result = $database->select("product","products",array("id","name","price","description","category_id","created","modified")," id = {$productid} ",null);
            
            $database->disconnect();
           if($result === false){
            echo "Error: Data corruption detected in the 'product' table. Please investigate and repair the database.";
           } 
        }
        return $result;
    }
    public static function addNewProduct($name, $price, $description, $category_id) {
        $database = new Database();
        $result = false;
        if($database->connect()){
        //! Lấy thời gian hiện tại
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $created = date('Y-m-d H:i:s');
        $modified = $created;
        //! Gọi hàm insert để chèn một sản phẩm mới vào cơ sở dữ liệu
       
        $result = $database->insert("products", array($name, $price, $description, $category_id, $created,$modified ), "name, price, description, category_id, created, modified ");
        $database->disconnect();
        }
        return $result;
    }

    public static function deleteProduct($product_id) {
        $database = new Database();
        $result = false;
        if($database->connect()){
        //! Gọi hàm insert để chèn một sản phẩm mới vào cơ sở dữ liệu
        $result = $database->Remove("products", "id = " . $product_id);
        $database->disconnect();
        }
        return $result;
    }

    public static function updateProduct($product_id, $name, $price, $description, $category_id) {
        $database = new Database();
        $result = false;
        if($database->connect()){
        //! Lấy thời gian hiện tại
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $rows = [
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'category_id' => $category_id,
            'modified' => date('Y-m-d H:i:s') // Giả sử bạn muốn cập nhật thời gian sửa đổi hiện tại
        ];
        //! Gọi hàm insert để chèn một sản phẩm mới vào cơ sở dữ liệu
        $result = $database->update("products", $rows, "id = ". $product_id);
        $database->disconnect();
        }
        return $result;
    }
 }

?>