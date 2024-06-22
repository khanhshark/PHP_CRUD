<?php
chdir('../'); //! Đổi thư mục làm việc thành thư mục cha của thư mục hiện tại
$model = isset($_GET['model']) ? $_GET['model'] : false;
if($model == false){
    echo json_encode(['items' => [], 'totalPages' => 0, 'page' => 1]);
    return;
};
//! include once $model
require_once('Models/' . $model . '.php');

$itemsPerPage = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$offset = ($page - 1) * $itemsPerPage;
//! lấy hàm get danh sách
$method_name = 'getAll' . $model;
//! Kiểm tra nếu phương phức tồn trại trong class này 

if (method_exists($model, $method_name)=== false){
    echo json_encode(['items' => [], 'totalPages' => 0, 'page' => $page]);
    return;
};
//! lấy danh sách
$items = $model::$method_name();
//! Phân trang thêm trang
$totalItems = count($items);
$totalPages = ceil($totalItems / $itemsPerPage);
$slice = array_slice($items, $offset, $itemsPerPage);
//! trả về json
$response = [
    'items' => $slice,
    'totalPages' => $totalPages,
    'all' => $_GET['page']
];

echo json_encode($response);
?>
