
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
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

   
        <h1 >Product List</h1>
        <div class="row mb-3">
        <div class="col text-right">
            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addProduct">Add Product</button>
            <a href="index.php?page=main&controller=history&action=index" class="btn btn-primary btn-sm">History</a>
            <a href="index.php?page=main&controller=category&action=index" class="btn btn-primary btn-sm">categorie</a>
        </div>
     
    </div>
    
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Category ID</th>
                    <th>Created</th>
                    <th>Modified</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id ="productBody">
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo $product->id; ?></td>
                        <td><?php echo $product->name; ?></td>
                        <td><?php echo $product->price; ?></td>
                        <td><?php echo $product->description; ?></td>
                        <td><?php echo $product->category_id; ?></td>
                        <td><?php echo $product->created; ?></td>
                        <td><?php echo $product->modified; ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editProduct" data-productid="<?php echo $product->id; ?>" data-name="<?php echo $product->name; ?>" data-price="<?php echo $product->price; ?>" data-description="<?php echo $product->description; ?>" data-category="<?php echo $product->category_id; ?>">Edit</button>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteProduct" data-productid="<?php echo $product->id; ?>">Delete</button>
                            <a class="btn btn-info btn-sm" href="index.php?page=main&controller=product&action=getproductid&numberpage=1&productid=<?php echo $product->id; ?>">Read</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

   <!-- Pagination for product -->
    <div class="pagination" id ="pagination" >
    <?php 
    
        for ($i = 0; $i < $total_pages; $i++) {
            $page_number = $i + 1;
            //! làm dấu để biết đang ở trang nào sẽ nhấn mạnh ô đó
            $class = ($page_number == 1) ? 'class="active"' : '';
            echo '<button onclick="loadpage(' . $page_number . ')" ' . $class . '>' . $page_number . '</button>';
        }
        
    ?>
</div>



    <!-- Add Product Modal -->
    <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="index.php?page=main&controller=product&action=add" method="post">
                        
                        <div class="form-group">
                            <label for="editName">Name</label>
                            <input type="text" class="form-control" id="addName" name="addName" required>
                        </div>
                        <div class="form-group">
                            <label for="editPrice">Price</label>
                            <input type="number" class="form-control" id="addPrice" name="addPrice" required>
                        </div>
                        <div class="form-group">
                            <label for="editDescription">Description</label>
                            <textarea class="form-control" id="addDescription" name="addDescription" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editCategory">Category ID</label>
                            <!-- <input type="number" class="form-control" id="addCategory" name="addCategory" required> -->
                          
                            <select class="form-control" id="addCategory" name="addCategory" required>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category->id; ?>">
                                        <?php echo $category->name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                          
                        </div>
                        <button type="submit" class="btn btn-warning">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProduct" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="index.php?page=main&controller=product&action=edit" method="post">
                        <input type="hidden" id="editProductId" name="editProductId" >
                        <div class="form-group">
                            <label for="editName">Name</label>
                            <input type="text" class="form-control" id="editName" name="editName" required>
                        </div>
                        <div class="form-group">
                            <label for="editPrice">Price</label>
                            <input type="number" class="form-control" id="editPrice" name="editPrice" required>
                        </div>
                        <div class="form-group">
                            <label for="editDescription">Description</label>
                            <textarea class="form-control" id="editDescription" name="editDescription" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editCategory">Category ID</label>
                            <input type="number" class="form-control" id="editCategory" name="editCategory" required>
                        </div>
                        <button type="submit" class="btn btn-warning">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Product Modal -->
    <div class="modal fade" id="deleteProduct" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="deleteProductModalLabel">Delete Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="index.php?page=main&controller=product&action=delete" method="post">
                        <input type="hidden" id="deleteProductId" name="deleteProductId">
                        <p>Are you sure you want to delete this product?</p>
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
        $('#editProduct').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var productId = button.data('productid');
            var name = button.data('name');
            var price = button.data('price');
            var description = button.data('description');
            var category = button.data('category');

            var modal = $(this);
            modal.find('#editProductId').val(productId);
            modal.find('#editName').val(name);
            modal.find('#editPrice').val(price);
            modal.find('#editDescription').val(description);
            modal.find('#editCategory').val(category);
        });

        $('#addProduct').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var name = button.data('name');
            var price = button.data('price');
            var description = button.data('description');
            var category = button.data('category');

            var modal = $(this);
            modal.find('#addName').val(name);
            modal.find('#addPrice').val(price);
            modal.find('#addDescription').val(description);
            modal.find('#addCategory').val(category);
        });


        $('#deleteProduct').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var productId = button.data('productid');

            var modal = $(this);
            modal.find('#deleteProductId').val(productId);
        });


        const productBody = document.getElementById('productBody');
        const pagination = document.getElementById('pagination');
        function loadpage(page){
           
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                
                //! kiểm tra trạng thái trả về của request
                if (this.readyState == 4 && this.status == 200) {
                    const response = JSON.parse(this.responseText);//! lấy các key và value của json
                    updateProductTable(response.items,page);
                    createdPaginatuion(response.totalPages, page);
                  

                }
            };
            xhttp.open("GET", `views/Pagination.php?page=${page}&model=product`, true);
            xhttp.send();
        }

    function updateProductTable(products,currentPage) {
    
    productBody.innerHTML = ''; //! Xóa nội dung hiện tại của bảng

    products.forEach(product => {
        const row = document.createElement('tr');

        row.innerHTML = `
            <td>${product.id}</td>
            <td>${product.name}</td>
            <td>${product.price}</td>
            <td>${product.description}</td>
            <td>${product.category_id}</td>
            <td>${product.created}</td>
            <td>${product.modified}</td>
            <td>
                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editProduct" 
                        data-productid="${product.id}" 
                        data-name="${product.name}" 
                        data-price="${product.price}" 
                        data-description="${product.description}" 
                        data-category="${product.category_id}">
                    Edit
                </button>
                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteProduct" 
                        data-productid="${product.id}">
                    Delete
                </button>
                <a class="btn btn-info btn-sm" 
                   href="index.php?page=main&controller=product&action=getproductid&numberpage=${currentPage}&productid=${product.id}">
                   Read
                </a>
            </td>
        `;

        productBody.appendChild(row);
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