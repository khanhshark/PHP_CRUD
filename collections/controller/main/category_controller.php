<?php 
require_once('controller/base_controller.php');
require_once('Models/category.php');
class categoryController extends BaseController{
    function __construct()
    {
        $this->folder = 'views/categorie';
    }
    function index(){
        $current_page = isset($_GET['numberpage']) ? $_GET['numberpage'] : 1;
        $categories = category::getAllcategory();
        $total_pages =  ceil(count($categories) / 5);
        $data  = array(
            "categories" => array_slice($categories, ($current_page - 1) * 5, 5),
            "total_pages" => $total_pages
        );
       
        $this->renderview('index', $data);
      
    }
    function getcategoryid(){
      
        $categoriesid = $_GET['categorieid'];
        echo $categoriesid;
        $categories =  category::getcategoryid($categoriesid);
        $data  = array(
            "categories" => $categories,
        );
        $this->renderview('infocategorie', $data);
      
    }
    function add(){
        $name = $_POST['addName'];
        $categories = category::addNewcategory($name);
        header("Location: index.php?page=main&controller=category&action=index");
    }
    function edit(){
      
        $categorie_id = $_POST['editcategorieId'];
        $name = $_POST['editName'];
        print($name);
        category::update($categorie_id, $name);
        header("Location: index.php?page=main&controller=category&action=index");
        exit();
    }
    function delete(){
       
        $categories = $_POST['deletecategorieId'];
        category::deletecategory($categories);
        header("Location: index.php?page=main&controller=category&action=index");
    }

}



?> 