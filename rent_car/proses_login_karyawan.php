<?php
session_start();
$username = $_POST["username"];
$password = md5($_POST["password"]);

$koneksi = mysqli_connect("localhost","root","","rent_car");
$sql = "select * from karyawan where username='$username' and password='$password'";
$result = mysqli_query($koneksi,$sql);
$jumlah = mysqli_num_rows($result);

if ($jumlah == 0) {
  $_SESSION["message"] = array(
    "type" => "danger",
    "message" => "Username/password Salah"
  );
  header("location:login_karyawan.php");
}else {
  $_SESSION["session_karyawan"] = mysqli_fetch_array($result);
  $_SESSION["session_sewa"] = array();
  header("location:template_karyawan.php");
}

if (isset($_GET["logout"])) {
  session_destroy();
  header("location:login_karyawan.php");
}
 ?>
