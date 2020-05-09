<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $con = mysqli_connect('localhost','root', '', 'macarina');

    $Email = $_POST['email'];

    $Password = $_POST['password'];

    $UlangiPassword = $_POST['ulangi_password'];

    $Nama = $_POST['nama'];

    $Telpon = $_POST['telpon'];

    $CheckSQL = "SELECT * FROM reseller WHERE email='$Email'";

    $check = mysqli_fetch_array(mysqli_query($con, $CheckSQL));

    if (isset($check)) {

        echo 'Email Already Exist, Please Enter Another Email.';
    } else {
        $Sql_Query = "INSERT INTO reseller (email,password,ulangi_password,nama,telpon) values ('$Email','$Password','$UlangiPassword','$Nama','$Telpon')";

        if (mysqli_query($con, $Sql_Query)) {
            echo 'User Registration Successfully';
        } else {
            echo 'Something went wrong';
        }
    }
    mysqli_close($con);
}
