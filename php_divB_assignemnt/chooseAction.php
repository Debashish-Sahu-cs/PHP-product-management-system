<?php
// actions.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Actions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .button-container {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        .button-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .btn {
            display: block;
            width: 200px;
            margin: 10px auto;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-add {
            background: #28a745;
            color: #fff;
        }
        .btn-add:hover {
            background: #218838;
        }
        .btn-order {
            background: #007bff;
            color: #fff;
        }
        .btn-order:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="button-container">
    <h2>Select an Action</h2>
    
    <form action="productDetails.php" method="get">
        <button type="submit" class="btn btn-add">Add Your Product</button>
    </form>
    
    <form action="placeOrder.php" method="get">
        <button type="submit" class="btn btn-order">Place Order</button>
    </form>
</div>

</body>
</html>
