<?php
session_start();
//* với $page là tên của folder trong lớp controller
//* $controller là tên file cộng thêm _controller.php 
//* $action là hàm trong file đó để truy cập đếm
if (isset($_GET['page'])) {
	$page = $_GET['page'];

	if (isset($_GET['controller'])) {

		$controller = $_GET['controller'];

		if (isset($_GET['action'])) {
			$action = $_GET['action'];
		} else {
			$action = 'index';
		}
	} else {
		$controller = 'layouts';
		$action = 'index';
	}
} else {
	//* khỏi tạo ban đầu 
	$page = 'main';
	$controller = 'product';
	$action = 'index';
   
}

//* tiến hành gọi hàm
require_once('routes.php');
