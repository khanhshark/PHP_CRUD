<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>categorie List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>

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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        form {
            margin-bottom: 20px;
        }
        form input[type="text"], form input[type="number"], form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #45a049;
        }
        h1 {
        text-align: center; /* Căn giữa nội dung của phần tử h1 */
    }
   
    </style>
</head>
<body>

  
    <div class="container">

   
        <h1 >categorie List</h1>
        <div class="row mb-3">
        <div class="col text-right">
            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addcategorie">Add categorie</button>
            <a href="index.php?page=main&controller=product&action=index" class="btn btn-primary btn-sm">Product</a>
        </div>
     
    </div>
    
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created</th>
                    <th>Modified</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id = "categoryBody">
                <?php foreach ($categories as $categorie): ?>
                    <tr>
                        <td><?php echo $categorie->id; ?></td>
                        <td><?php echo $categorie->name; ?></td>
                        <td><?php echo $categorie->created; ?></td>
                        <td><?php echo $categorie->modified; ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editcategorie" data-categorieid="<?php echo $categorie->id; ?>" data-name="<?php echo $categorie->name; ?>" data-price="<?php echo $categorie->price; ?>" data-description="<?php echo $categorie->description; ?>" data-category="<?php echo $categorie->category_id; ?>">Edit</button>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletecategorie" data-categorieid="<?php echo $categorie->id; ?>">Delete</button>
                            <a class="btn btn-info btn-sm" href="index.php?page=main&controller=category&action=getcategoryid&numberpage=1&categorieid=<?php echo $categorie->id; ?>">Read</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

  
    <div class="pagination" id = "pagination">
    <?php 
    $cur_pages = isset( $_GET['numberpage']) ? $_GET['numberpage']:1;
        for ($i = 0; $i < $total_pages; $i++) {
            $page_number = $i + 1;
            $class = ($page_number == $cur_pages) ? 'class="active"' : '';
            echo '<button onclick="loadpage(' . $page_number . ')" ' . $class . '>' . $page_number . '</button>';
        }
    ?>
</div>



    <!-- Add categorie Modal -->
    <div class="modal fade" id="addcategorie" tabindex="-1" role="dialog" aria-labelledby="addcategorieModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="addcategorieModalLabel">Add categorie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="index.php?page=main&controller=category&action=add" method="post">
                        
                        <div class="form-group">
                            <label for="editName">Name</label>
                            <input type="text" class="form-control" id="addName" name="addName" required>
                        </div>
                        <button type="submit" class="btn btn-warning">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit categorie Modal -->
    <div class="modal fade" id="editcategorie" tabindex="-1" role="dialog" aria-labelledby="editcategorieModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="editcategorieModalLabel">Edit categorie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="index.php?page=main&controller=category&action=edit" method="post">
                        <input type="hidden" id="editcategorieId" name="editcategorieId" >
                        <div class="form-group">
                            <label for="editName">Name</label>
                            <input type="text" class="form-control" id="editName" name="editName" required>
                        </div>
                        <button type="submit" class="btn btn-warning">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete categorie Modal -->
    <div class="modal fade" id="deletecategorie" tabindex="-1" role="dialog" aria-labelledby="deletecategorieModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="deletecategorieModalLabel">Delete categorie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="index.php?page=main&controller=category&action=delete" method="post">
                        <input type="hidden" id="deletecategorieId" name="deletecategorieId">
                        <p>Are you sure you want to delete this categorie?</p>
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $('#editcategorie').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var categorieId = button.data('categorieid');
            var name = button.data('name');

            var modal = $(this);
            modal.find('#editcategorieId').val(categorieId);
            modal.find('#editName').val(name);
        });

        $('#addcategorie').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var name = button.data('name');

            var modal = $(this);
            modal.find('#addName').val(name);
        });


        $('#deletecategorie').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var categorieId = button.data('categorieid');

            var modal = $(this);
            modal.find('#deletecategorieId').val(categorieId);
        });

        const categoryBody = document.getElementById('categoryBody');
        const pagination = document.getElementById('pagination');
        function loadpage(page){
           
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                
                //! kiểm tra trạng thái trả về của request
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const response = JSON.parse(this.responseText);//! lấy các key và value của json
                    updateCategoryTable(response.items,page);
                    createdPaginatuion(response.totalPages, page);
                  

                }
            };
            xhttp.open("GET", `views/Pagination.php?page=${page}&model=category`, true);
            xhttp.send();
        }

    function updateCategoryTable(categories, currentPage) {
  
    categoryBody.innerHTML = ''; // Xóa nội dung hiện tại của bảng

    categories.forEach(category => {
        const row = document.createElement('tr');

        row.innerHTML = `
            <td>${category.id}</td>
            <td>${category.name}</td>
            <td>${category.created}</td>
            <td>${category.modified}</td>
            <td>
                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editcategorie" 
                        data-categorieid="${category.id}" 
                        data-name="${category.name}">
                    Edit
                </button>
                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletecategorie" 
                        data-categorieid="${category.id}">
                    Delete
                </button>
                <a class="btn btn-info btn-sm" 
                   href="index.php?page=main&controller=category&action=getcategoryid&numberpage=${currentPage}&categorieid=${category.id}">
                   Read
                </a>
            </td>
        `;

        categoryBody.appendChild(row);
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



    </script>

   
</body>
</html>