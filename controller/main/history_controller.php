<?php 
require_once('controller/base_controller.php');
require_once('Models/history.php');
class historyController extends BaseController{
    function __construct()
    {
        $this->folder = 'views/history';
    }
    function index(){
        $history = history::getAllhistory();
        $total_pages =  ceil(count($history) / 5);
        $data  = array(
            "historys" => array_slice($history, 0, 5),
            "total_pages" => $total_pages
        );
      
        $this->renderview('index', $data);
      
    }
    function resetHistory(){
        $product = history::deleteProduct();
        header("Location: index.php?page=main&controller=history&action=index");
    }

}



?> 