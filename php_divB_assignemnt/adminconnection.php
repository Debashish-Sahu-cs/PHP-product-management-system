<?php

    class Admin{
        public $host;
        public $username;
        public $password;
        public $databasename;
        public $connect;
        function __construct(){
            $this->host = 'localhost';
            $this->username = 'root';
            $this->password = '';
            $this->databasename = 'product_database';
        }

        function connection(){
            $this->connect = new mysqli($this->host, $this->username, $this->password, $this->databasename);
            return $this->connect;
        }

        function insertAdmin($name, $email, $password){
            $sql = "INSERT INTO ADMIN VALUES('','$name','$email','$password')";
            $data = mysqli_query($this->connect,$sql);
            return $data;
        }
        function checkAdmin($email, $password){
            $query = "SELECT * FROM ADMIN WHERE adminemail='$email' AND adminpassword='$password'";
            $data = mysqli_query($this->connect,$query);
            if($data){
                return $data;
            }else{
                return FALSE;
            }
            return FALSE;
            
        }
        function addProducts($productId, $prodcategory, $itemname, $itemprice, $itemstocks){
            $insert = "INSERT INTO product_details VALUES('$productId', '$prodcategory','', '$itemname', '$itemprice', '$itemstocks')";
            $response  = mysqli_query($this->connect,$insert);
            return $response;
        }
        
        function productId(){
            $qry = "SELECT MAX(productid) FROM product_details";
            $result = mysqli_query($this->connect, $qry);
            $data = mysqli_fetch_row($result);
            return $data ;
        }

        function itemCode($productid){
            $qry = "SELECT itemcode FROM product_details WHERE productid='$productid'";
            $result = mysqli_query($this->connect, $qry);
            $data = mysqli_fetch_row($result);
            return $data ;
        }

        function addOrders($orderdate, $itemcode, $orderquantity, $orderprice, $shippingadd, $totalamount, $adminid, $vendorid){
            $insert = "INSERT INTO order_details VALUES('','$orderdate', '$itemcode', '$orderquantity', '$orderprice', '$shippingadd', '$totalamount', '$adminid', '$vendorid')";
            $response = mysqli_query($this->connect, $insert);
            return $response;
        }

        function insertVandor($vendorname,$vendorstate,$vendorcity,$vendorcontact,$itemcode,$vendorimagepath){
            $insert = "INSERT INTO vendor VALUES('','$vendorname','$vendorstate','$vendorcity','$vendorcontact','$itemcode','$vendorimagepath')";
            $response = mysqli_query($this->connect, $insert);
            $vendorid = $this->connect->insert_id;                  // returns the recently increamented id in vendor table
            session_start();
            $_SESSION['vendorid'] = $vendorid ;                     // to use it in orderValidation table
            return $response;
        }

        function prodExist($category, $itemname){
            $getProd = "SELECT * FROM product_details WHERE LOWER(prodcategory) =LOWER('$category') AND LOWER(itemname) = LOWER('$itemname')";
            $response = mysqli_query($this->connect, $getProd);
            if($response){
                return $response;
            }else{
                return FALSE;
            }
            return FALSE;
        }
        
        function updateProduct($category, $itemname, $itemprice, $itemstocks){
            $updateProd = "UPDATE product_details
                           SET itemprice = '$itemprice', itemstock = '$itemstocks'
                           WHERE prodcategory = '$category' AND itemname = '$itemname' ";
            $response = mysqli_query($this->connect, $updateProd);                           
            return $response;
            
        }

        function productStock($itemcode){
            $fetchStock = "SELECT itemstock FROM product_details WHERE itemcode = '$itemcode'";
            $response = mysqli_query($this->connect, $fetchStock);
            $stock = mysqli_fetch_row($response);
            return $stock[0];
        }

        function updateProdStock($itemcode, $updatedStock){
            $updateProd = "UPDATE product_details
                            SET itemstock = '$updatedStock'
                            WHERE itemcode = '$itemcode'";
            $response = mysqli_query($this->connect, $updateProd);
            return $response;
        }
    }



?>
