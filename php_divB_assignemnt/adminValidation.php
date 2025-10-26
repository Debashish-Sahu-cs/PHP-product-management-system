<?php
include 'adminconnection.php';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!preg_match(" /^[a-zA-Z ]++*$/",$name)){
        echo "invalid name! should be alphabets only.";
        ?>
        <html><a href="adminRegistration.php">Try again.</a></html>
        <?php
        exit;
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "invalid email! Should contain '@' and shold be in proper format.";
           ?>
        <html><a href="adminRegistration.php">Try again.</a></html>
        <?php
        exit;
    }
    if(!preg_match(" /^(?=.*[0-9a-zA-Z]).{6,}$/",$password)){
        echo "Password not strong enough!should be atleast 6character in length.";
        ?>
        <html><a href="adminRegistration.php">Try again.</a></html>
        <?php
        exit;
    }
    if(!(isset($name) && isset($email) && isset($password))){
        echo "fields can't be empty!";
        ?>
        <html><a href="adminRegistration.php">Try again.</a></html>
        <?php
    }else{
        $admin = new Admin();
        $admin->connection();
        $admin->insertAdmin($name, $email, $password);
        echo "<script> window.location.href='adminLogin.php?'</script>";
    }


?>