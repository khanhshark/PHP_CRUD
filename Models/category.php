<?php 
require_once('config.php');

class category {
    public $id;
    public $name;
    public $created;
    public $modified;

    public function __construct($id, $name, $created, $modified) {
        $this->id = $id;
        $this->name = $name;
        $this->created = $created;
        $this->modified = $modified;
    }

    public static function getAllcategory() {
        $database = new Database();
        $result = false;
        
        if($database->connect()) {
            $result = $database->select("category","categories", array("id", "name", "created", "modified"), null, "id ASC");
            $database->disconnect();
            
            if($result === false) {
                echo "Error: Data corruption detected in the 'categories' table. Please investigate and repair the database.";
            } 
        }
        return $result;
    }
    
    public static function addNewcategory($name) {
        $database = new Database();
        $result = false;
        
        if($database->connect()) {
            // Lấy thời gian hiện tại
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $created = date('Y-m-d H:i:s');
            $modified = $created;
            
            // Gọi hàm insert để chèn một danh mục mới vào cơ sở dữ liệu
            $result = $database->insert("categories", array($name, $created, $modified), "name, created, modified");
            $database->disconnect();
        }
        return $result;
    }

    public static function deletecategory($categoryId) {
        $database = new Database();
        $result = false;
        
        if($database->connect()) {
            // Gọi hàm xóa để xóa danh mục dựa trên ID
            $result = $database->remove("categories", "id = $categoryId");
            $database->disconnect();
        }
        return $result;
    }
    public static function getcategoryid($categoryId) {
        $database = new Database();
        $result = false;
        
       
        if($database->connect()){
            $result = $database->select("category","categories",array("id","name","created","modified")," id = {$categoryId} ",null);
            
            $database->disconnect();
           if($result === false){
            echo "Error: Data corruption detected in the 'product' table. Please investigate and repair the database.";
           } 
        }
        return $result;
    }

    public static function update($categories_id, $name) {
        $database = new Database();
        $result = false;
        if($database->connect()){
        //! Lấy thời gian hiện tại
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $rows = [
            'name' => $name,
            'modified' => date('Y-m-d H:i:s') // Giả sử bạn muốn cập nhật thời gian sửa đổi hiện tại
        ];
        
        //! Gọi hàm insert để chèn một sản phẩm mới vào cơ sở dữ liệu
        $result = $database->update("categories", $rows, "id = ". $categories_id);
        $database->disconnect();
        }
        return $result;
    }
}
?>