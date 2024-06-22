<?php

//* các file trong folder controller
$pages = array(
  'error' => ['errors'],
  'main' => [ 'product','history','category'],
);
//* các hàm trong file <name>_controller.php
$controllers = array(
  'errors' => ['index'],
  'product' => ['index', 'add', 'edit', 'delete','getproductid'],
  'history' => ['index','add','resetHistory'],
  'category' => ['index', 'add', 'edit', 'delete','getcategoryid']
  
  //Main controller
 
); // Các controllers trong hệ thống và các action có thể gọi ra từ controller đó.

// Nếu các tham số nhận được từ URL không hợp lệ (không thuộc list controller và action có thể gọi
// thì trang báo lỗi sẽ được gọi ra.

//* kiểm tra file đó có tồn tại hay không để truy cập
if ($page == 'error' || !array_key_exists($page, $pages) || !array_key_exists($controller, $controllers) ||
 !in_array($action, $controllers[$controller])) {
    echo 'controller/' . $page . "/" . $controller . '_controller.php';
    require_once('error/error_404.php');
}
//* yêu cầu file đó -> khởi tạo class -> truy cập hàm
else {
 
  include_once('controller/' . $page . "/" . $controller . '_controller.php');
  $klass = str_replace('_', '', ucwords($controller, '_')) . 'Controller';
  
  $controller = new $klass;
  $controller->$action();
  unset($controller);
}
