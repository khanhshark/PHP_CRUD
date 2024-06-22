<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        .detail {
            margin-bottom: 10px;
        }
        .detail label {
            font-weight: bold;
        }
        a {
            display: block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>categories Details</h1>
        <div class="detail">
            <label>ID:</label>
            <?php echo $categories[0]->id; ?>
        </div>
        <div class="detail">
            <label>Name:</label>
            <?php echo $categories[0]->name; ?>
        </div>
        <div class="detail">
            <label>Created:</label>
            <?php echo  $categories[0]->created; ?>
        </div>
        <div class="detail">
            <label>Modified:</label>
            <?php echo  $categories[0]->modified; ?>
        </div>
        <a href="index.php?page=main&controller=category&action=index&numberpage=<?php echo isset($_GET['numberpage']) ? $_GET['numberpage'] : 1; ?>">Back to categorie List</a>
    </div>
</body>
</html>
