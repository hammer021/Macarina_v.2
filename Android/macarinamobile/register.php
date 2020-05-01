<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include 'register.php';

    $con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

    $Email = $_POST['Email'];

    $Password = $_POST['Password'];

    $KonfirmasiPassword = $_POST['KonfirmasiPassword'];

    $Full_Name = $_POST['Nama'];

    $NoTelpon = $_POST['NoTelpon'];

    $CheckSQL = "SELECT * FROM reseller WHERE Email='$Email'";

    $check = mysqli_fetch_array(mysqli_query($con, $CheckSQL));

    if (isset($check)) {

        echo 'Email Already Exist, Please Enter Another Email.';
    } else {
        $Sql_Query = "INSERT INTO reseller (Email,User_Password,KonfirmasiPassword,Nama,NoTelpon) values ('$Email','$Password','$KonfirmasiPassword','$Full_Name','$NoTelpon')";

        if (mysqli_query($con, $Sql_Query)) {
            echo 'User Registration Successfully';
        } else {
            echo 'Something went wrong';
        }
    }
    mysqli_close($con);
}

?>