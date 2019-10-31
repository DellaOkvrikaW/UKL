<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","rent_car");
if (isset($_POST["action"])) {
$id_pelanggan = $_POST["id_pelanggan"];
$nama_pelanggan = $_POST["nama_pelanggan"];
$alamat_pelanggan = $_POST["alamat_pelanggan"];
$kontak = $_POST["kontak"];

$action = $_POST["action"];

if ($_POST["action"] == "insert") {
  $path = pathinfo($_FILES["gambar"]["name"]);
  $extensi = $path["extension"];
  $filename = $id_pelanggan."-".rand(1,1000).".".$extensi;

  $sql = "insert into pelanggan values('$id_pelanggan','$nama_pelanggan','$alamat_pelanggan','$kontak','$filename')";
  if (mysqli_query($koneksi,$sql)) {
    move_uploaded_file($_FILES["gambar"]["tmp_name"],"img_pelanggan/$filename");
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
    header("location:template_karyawan.php?page=pelanggan");

}elseif ($_POST["action"] == "update") {
  if (!empty($_FILES["gambar"]["name"])) {
    $sql = "select * from pelanggan where id_pelanggan='$id_pelanggan'";
    $result = mysqli_query($koneksi,$sql);
    $hasil = mysqli_fetch_array($result);
    if (file_exists("img_pelanggan/".$hasil["gambar"])) {
      unlink("img_pelanggan/".$hasil["gambar"]);
  }

  $path = pathinfo($_FILES["gambar"]["name"]);
  $extensi = $path["extension"];
  $filename = $id_pelanggan."-".rand(1,1000).".".$extensi;

  $sql = "update pelanggan set nama_pelanggan='$nama_pelanggan',alamat_pelanggan='$alamat_pelanggan',kontak='$kontak',gambar='$filename' where id_pelanggan='$id_pelanggan'";

  if (mysqli_query($koneksi,$sql)) {

  move_uploaded_file($_FILES["gambar"]["tmp_name"],"img_pelanggan/$filename");
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

$sql = "update pelanggan set nama_pelanggan='$nama_pelanggan',alamat_pelanggan='$alamat_pelanggan',kontak='$kontak' where id_pelanggan='$id_pelanggan'";
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
  header("location:template_karyawan.php?page=pelanggan");
  }
}
if (isset($_GET["hapus"])) {
        $id_pelanggan = $_GET["id_pelanggan"];

        $sql = "select * from pelanggan where id_pelanggan='$id_pelanggan'";

        $result = mysqli_query($koneksi,$sql);

        $hasil = mysqli_fetch_array($result);
        if (file_exists("img_pelanggan/".$hasil["image"])) {
          unlink("img_pelanggan/".$hasil["image"]);

        }
          $sql = "delete from pelanggan where id_pelanggan='$id_pelanggan'";
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
          header("location:template_karyawan.php?page=pelanggan");
          }
 ?>
