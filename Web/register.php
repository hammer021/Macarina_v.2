<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $con = mysqli_connect('localhost','root', '', 'macarina');

    $email = $_POST['email'];

    $password = $_POST['password'];

    $ulangi_password = $_POST['ulangi_password'];

    $nama_reseller = $_POST['nama_reseller'];

    $no_tlp = $_POST['no_tlp'];

    $CheckSQL = "SELECT * FROM reseller WHERE email='$Email'";

    $check = mysqli_fetch_array(mysqli_query($con, $CheckSQL));

    if (isset($check)) {

        echo 'Email Already Exist, Please Enter Another Email.';
    } else {
        $Sql_Query = "INSERT INTO reseller (email,password,ulangi_password,nama,no_tlp) values ('$email','$password','$ulangi_password','$nama_reseller','$no_tlp')";

        if (mysqli_query($con, $Sql_Query)) {
            echo 'User Registration Successfully';
        } else {
            echo 'Something went wrong';
        }
    }
    mysqli_close($con);
}
