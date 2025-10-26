<?php
include 'adminconnection.php';
if(isset($_POST['submit'])){
    $productid = $_POST['productid'];
    $category = $_POST['category'];
    $itemname = $_POST['itemname'];
    $itemprice = $_POST['itemprice'];
    $itemstocks = $_POST['itemstocks'];

    $obj = new Admin();
    $obj->connection();
    if($obj->prodExist($category, $itemname)){
        $obj->updateProduct($category, $itemname, $itemprice, $itemstocks);
        echo "<script> window.location.href='chooseAction.php' </script>";
    }else{
        $added = $obj->addProducts($productid, $category, $itemname, $itemprice, $itemstocks);
        if($added){
            echo "<script> window.location.href='chooseAction.php' </script>";
        }
    }
    
}



?>