<?php
include 'adminconnection.php';
$obj=new Admin();
$obj->connection();  
$prodId = $obj->productId() ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Details Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: #fff;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 350px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            border: none;
            border-radius: 6px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Product Details</h2>
    <form action="productValidation.php" method="POST">
        <label for="productid">Product ID</label>
    
        <input type="text" id="productid" name="productid" value="<?php echo $prodId[0]+1 ;  ?>" readonly>

        <label for="category">Product Category</label>
        <select id="category" name="category" required>
            <option name="category" value="">--Select Category--</option>
            <option name="category" value="Electronics">Electronics</option>
            <option name="category" value="Clothing">Clothing</option>
            <option name="category" value="HomeCare">Home & care</option>
            <option name="category" value="Books">Books</option>
            <option name="category" value="Beauty">Beauty</option>
            <option name="category" value="other">Other</option>
        </select>

        <label for="itemname">Item Name</label>
        <input type="text" id="itemname" name="itemname" required>

        <label for="itemprice">Item Price</label>
        <input type="number" step="0.01" id="itemprice" name="itemprice" required>

        <label for="itemstocks">Item Stocks</label>
        <input type="number" id="itemstocks" name="itemstocks" required>

        <button type="submit" name ="submit" value="add" >Add Product</button>
    </form>
</div>

</body>
</html>
