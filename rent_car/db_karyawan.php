<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","rent_car");
if (isset($_POST["action"])) {
$id_karyawan = $_POST["id_karyawan"];
$nama_karyawan = $_POST["nama_karyawan"];
$alamat_karyawan = $_POST["alamat_karyawan"];
$kontak = $_POST["kontak"];
$username = $_POST["username"];
$password = md5($_POST["password"]);

$action = $_POST["action"];

if ($_POST["action"] == "insert") {
  $path = pathinfo($_FILES["gambar"]["name"]);
  $extensi = $path["extension"];
  $filename = $id_karyawan."-".rand(1,1000).".".$extensi;
  $sql = "insert into karyawan values('$id_karyawan','$nama_karyawan','$alamat_karyawan','$kontak','$username','$password','$filename')";
  if (mysqli_query($koneksi,$sql)) {
    move_uploaded_file($_FILES["gambar"]["tmp_name"],"img_karyawan/$filename");
    $_SESSION["message"] = array(
      "type" => "success",
      "message" => "insert data has been success"
    );
  }else {
    $_SESSION["message"] = array(
      "type" => "danger",
      "message" => mysqli_error($koneksi)
    );
  }
    header("location:template_karyawan.php?page=karyawan");

}elseif ($_POST["action"] == "update") {
  if (!empty($_FILES["gambar"]["name"])) {
    $sql = "select * from karyawan where id_karyawan='$id_karyawan'";
    $result = mysqli_query($koneksi,$sql);
    $hasil = mysqli_fetch_array($result);
    if (file_exists("img_karyawan/".$hasil["gambar"])) {
      unlink("img_karyawan/".$hasil["gambar"]);
  }

  $path = pathinfo($_FILES["gambar"]["name"]);
  $extensi = $path["extension"];
  $filename = $id_karyawan."-".rand(1,1000).".".$extensi;

  $sql = "update karyawan set nama_karyawan='$nama_karyawann',alamat_karyawan='$alamat_karyawan',kontak='$kontak',warna='$warna',username='$username',password='$password',gambar='$filename' where id_karyawan='$id_karyawan' ";

  if (mysqli_query($koneksi,$sql)) {

  move_uploaded_file($_FILES["gambar"]["tmp_name"],"img_karyawan/$filename");
  $_SESSION["message"] == array(
    "type" => "success",
    "message" => "update data has been success"
    );
  }else {

      $_SESSION["message"] == array(
        "type" => "danger",
        "message" => mysqli_error($koneksi)
    );
  }
}else {

$sql = "update karyawan set nama_karyawan='$nama_karyawann',alamat_karyawan='$alamat_karyawan',kontak='$kontak',warna='$warna',username='$username',password='$password' where id_karyawan='$id_karyawan' ";
if (mysqli_query($koneksi,$sql)) {

  $_SESSION["message"] == array(
    "type" => "success",
    "message" => "Update data has been success"
  );

  $_SESSION["message"] == array(
    "type" => "danger",
    "message" => mysqli_error($koneksi)
    );
  }
}
  header("location:template_karyawan.php?page=karyawan");
  }
}
if (isset($_GET["hapus"])) {
        $id_karyawan = $_GET["id_karyawan"];

        $sql = "select * from karyawan where id_karyawan='$id_karyawan'";

        $result = mysqli_query($koneksi,$sql);

        $hasil = mysqli_fetch_array($result);
        if (file_exists("img_karyawan/".$hasil["image"])) {
          unlink("img_karyawan/".$hasil["image"]);

        }
          $sql = "delete from karyawan where id_karyawan='$id_karyawan'";
          if (mysqli_query($koneksi,$sql)) {
            $_SESSION[message] = array(
              "type" => "success",
              "message" => "Delete data has been success"
            );
          }else {
            $_SESSION["message"] == array(
              "type" => "danger",
              "message" => mysqli_error($koneksi)
            );
          }
          header("location:template_karyawan.php?page=karyawan");
          }
 ?>
