<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .pagination {
 
 position: fixed;
 bottom: 50px;
 left: 50%;

 width: 100%;
 background-color: #fff;
 z-index: 1000;
}
 /* Styles */
 .pagination button {
            display: inline-block;
            margin: 0 5px; /* Khoảng cách giữa các nút */
            padding: 8px 16px; /* Khoảng đệm bên trong nút */
            text-decoration: none; /* Loại bỏ gạch chân */
            color: #000; /* Màu chữ */
            border: 1px solid #ddd; /* Đường viền */
            border-radius: 4px; /* Bo tròn góc */
            transition: background-color 0.3s; /* Hiệu ứng khi di chuột */
            background-color: white; /* Màu nền mặc định */
            cursor: pointer; /* Thay đổi con trỏ khi di chuột qua nút */
        }

        .pagination button:hover {
            background-color: #ddd; /* Màu nền khi di chuột */
        }

        .pagination button.active {
            background-color: #4CAF50; /* Màu nền khi được chọn */
            color: white; /* Màu chữ khi được chọn */
            border-color: #4CAF50; /* Màu viền khi được chọn */
        }

        .pagination button:focus,
        .pagination button:active {
            background-color: #4CAF50; /* Màu nền khi đang giữ chuột */
            color: white; /* Màu chữ khi đang giữ chuột */
            border-color: #4CAF50; /* Màu viền khi đang giữ chuột */
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .reset-button, .back-button {
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .back-button {
            background-color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Product History</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Action</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody id="historyBody">
                <?php foreach ($historys as $item): ?>
                <tr>
                    <td><?php echo $item->id; ?></td>
                    <td><?php echo $item->action; ?></td>
                    <td><?php echo $item->created; ?></td>
                </tr> 
                <?php endforeach; ?> 
            </tbody>
        </table>
        <div class="button-container">
            <a class="reset-button" href="index.php?page=main&controller=history&action=resetHistory">Reset History</a>
            <a class="back-button" href="index.php?page=main&controller=product&action=index">Back</a>
        </div>
    </div>

    <div class="pagination" id="pagination">
    <?php 
        for ($i = 0; $i < $total_pages; $i++) {
            $page_number = $i + 1;
            $class = ($page_number ==  1) ? 'class="active"' : '';
            echo '<button onclick="loadpage(' . $page_number . ')" ' . $class . '>' . $page_number . '</button>';
        }
    ?>
</div>

<script>
    //! đảm bảo nội dung đã được tải nên khi mà nội dung được tải lên có các hàm trong này thì không 
    //! thể xài được vì trước đó chưa dược định nghĩa
    // document.addEventListener('DOMContentLoaded', function(){
        //! lấy các DOM bằng id
        const history = document.getElementById('historyBody');
        const pagination = document.getElementById('pagination');
        function loadpage(page){
            
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                
                //! kiểm tra trạng thái trả về của request
                if (this.readyState == 4 && this.status == 200) {
                  
                    const response = JSON.parse(this.responseText);//! lấy các key và value của json
                    updateTable(response.items);
                    createdPaginatuion(response.totalPages, page);
                  

                }
            };
            xhttp.open("GET", `views/Pagination.php?page=${page}&model=history`, true);
            xhttp.send();
        }

        function updateTable(items) {
                history.innerHTML = '';
                items.forEach(item => {
                //! Tạo một hàng mới trong bảng
                const row = document.createElement('tr');

                //! Đặt nội dung HTML cho hàng mới bằng cách thêm các ô (td) chứa các giá trị từ phần tử item
                row.innerHTML = `<td>${item.id}</td><td>${item.action}</td><td>${item.created}</td>`;
                //! Thêm hàng mới vào tbody của bảng
                history.appendChild(row);
               });
            }

        function createdPaginatuion(totalPages, currentPage){
            pagination.innerHTML = '';
            //! duyệt qua số lượng trang
            for(let i = 1;i <= totalPages;i++){
                const button = document.createElement('button');
                //! gán nội dung
                button.textContent = i
                if(i === currentPage){
                    //! thêm class đánh dấu đang ở trang hiện tại
                    button.classList.add('active');

                }
                //! Đặt sự kiện click cho thẻ button
                button.addEventListener('click', function() {
                    const pageNumber = parseInt(this.textContent); //! Lấy số trang từ nội dung của nút
                    loadpage(pageNumber);
                });
                pagination.appendChild(button); //! Thêm nút vào phân trang
            }
        }    
        // loadpage(1);
    // });




</script>
</body>
</html>
