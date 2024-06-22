<?php 
require_once('config.php');

 class history {
    public $id;
    public $action;
    public $created;
   
    public function __construct($id, $action, $created) {
      $this->id = $id;
      $this->action = $action;
      $this->created = $created;
    }
    public static function getAllhistory() {
        $database = new Database();
        $result = false;
        if($database->connect()){
            $result = $database->select("history","history_actions",array("id","action","created"),null,"created DESC");
            $database->disconnect();
           if($result === false){
            echo "Error: Data corruption detected in the 'product' table. Please investigate and repair the database.";
           } 
        }
        return $result;
    }
  
    public static function addNewProduct($id,$action) {
        $database = new Database();
        $result = false;
        if($database->connect()){
        //! Lấy thời gian hiện tại
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $created = date('Y-m-d H:i:s');
        //! Gọi hàm insert để chèn một sản phẩm mới vào cơ sở dữ liệu
       
        $result = $database->insert("history_actions", array($id,$action,$created) , "id,action, created ");
        $database->disconnect();
        }
        return $result;
    }

    public static function deleteProduct() {
        $database = new Database();
        $result = false;
        if($database->connect()){
        //! Gọi hàm insert để chèn một sản phẩm mới vào cơ sở dữ liệu
        $result = $database->Remove("history_actions", null);
        $database->disconnect();
        }
        return $result;
    }


 }

?>