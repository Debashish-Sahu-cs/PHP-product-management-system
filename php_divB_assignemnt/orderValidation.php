<?php
include 'adminconnection.php' ;
$obj = new Admin();
$obj->connection();
session_start();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $prodName = $_POST['prodName'];
        $prodCategory = $_POST['prodCategory'];
        $itemName = $_POST['itemName'];
        $vendorName = $_POST['vendorName'];
        $vendorState = $_POST['vendorState'];
        $vendorCity = $_POST['vendorCity'];
        $vendorContact = $_POST['vendorContact'];
        $itemPrice = $_POST['itemPrice'];
        $itemQty = $_POST['itemQty'];
        $shippingAddress = $_POST['shippingAddress'];
        $orderDate = $_POST['orderDate'];
        $vendorimagepath = '';
        if(!preg_match(" /^[a-zA-Z ]+$/",$vendorName)){
            echo "Invalid Vendor Name!";
            exit;
        }
        if(!preg_match(" /^[a-zA-Z ]+$/",$itemName)){
            echo "invalid item Name!";
            exit;
        }
        if(!preg_match(" /^(?=.*[0-9]).{10,}$/",$vendorContact)){
            echo "Invalid contact!";
            exit;
        }
        
        $_SESSION['vendorContact']=$vendorContact;

        $itemcode = mysqli_fetch_row(mysqli_query($obj->connect,"SELECT itemcode FROM product_details WHERE LOWER(itemname) =LOWER('$itemName')"));
        $adminid = mysqli_fetch_row(mysqli_query($obj->connect,"SELECT adminid FROM ADMIN WHERE LOWER(adminname) =LOWER('$vendorName')"));

        $isInserted = $obj->insertVandor($vendorName,$vendorState,$vendorCity,$vendorContact,$itemcode[0],$vendorimagepath);
        $vendorid = $_SESSION['vendorid'];
        
        if($isInserted){
            $totalamount = $itemPrice * $itemQty;
            if($obj->addOrders($orderDate, $itemcode[0], $itemQty, $itemPrice, $shippingAddress, $totalamount, $adminid[0], $vendorid)){
                $obj->updateProdStock($itemcode[0], ($obj->productStock($itemcode[0])-$itemQty));
            }
        }
        echo "<script> window.location.href='orderSuccess.php?vendorName=$vendorName&itemName=$itemName&itmQnt=$itemQty&shippingAddress=$shippingAddress'</script>";

    }

?>