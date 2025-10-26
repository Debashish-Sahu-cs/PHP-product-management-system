<?php
    session_start();
    $vendorName = $_GET['vendorName'];
    $itemName = $_GET['itemName'];
    $itemQuantity = $_GET['itmQnt'];
    $cont = $_SESSION['vendorContact'];
    $shippingAddress = $_GET['shippingAddress'];

    // echo "<strong>Order Placed .</strong>";
    // echo "$vendorName your order of $itemQuantity $itemName is placed.";
    // echo "Will be dilivered at $city.";
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .success-box {
            background: #ffffff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
            text-align: center;
            width: 450px;
        }
        .success-box h2 {
            color: #28a745;
            margin-bottom: 20px;
        }
        .success-box p {
            font-size: 18px;
            color: #333333;
            margin-bottom: 30px;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }
        .btn {
            flex: 1;
            padding: 10px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 15px;
            transition: background 0.3s ease;
            text-align: center;
        }
        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="success-box">
        <h2>Order Placed Successfully</h2>
        <p>
            <?php echo "$vendorName, your order of $itemQuantity $itemName has been placed successfully.  
            It will be delivered to $shippingAddress."; ?>
        </p>

        <div class="btn-container">
            <a href="adminRegistration.php" class="btn">Registration</a>
            <a href="adminLogin.php" class="btn">Login</a>
            <a href="placeOrder.php" class="btn">Place Order</a>
            <a href="productDetails.php" class="btn">Add Product</a>
        </div>
    </div>
</body>
</html>