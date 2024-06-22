<?php 

class BaseController {
    protected $folder;

     function __construct($folder) {
        $this->folder = $folder;
    }

    function renderview($view, $data = array()) {
      
       $view_file = $this->folder."/".$view.".php";
        if(is_file($view_file)){
            
            extract($data);
         
            require_once ($view_file);
        }

    }

}


?>