<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $con = mysqli_connect('localhost','root', '', 'macarina');
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = mysqli_query($con,"select * from reseller where email='$email' AND password='$password'");

    $cek = mysqli_fetch_array($sql);
    if(isset($cek)){
        echo "ada";
    }else{
        echo "Masukkan Email dan Password dengan benar!";
    }
    mysqli_close($con);
}

?>