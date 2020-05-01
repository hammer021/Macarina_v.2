<?php

if($_SERVER['REQUEST_METHOD']=='POST'){

include 'koneksi.php';

$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

$Email = $_POST['Email'];

$Password = $_POST['Password'];

$Sql_Query = "select * from reseller where Email = '$Email' and Password = '$Password' ";

$check = mysqli_fetch_array(mysqli_query($con,$Sql_Query));

if(isset($check)){

     echo "Data Matched";
} else {
      echo "Invalid Username or Password Please Try Again !";
}
mysqli_close($con);
}