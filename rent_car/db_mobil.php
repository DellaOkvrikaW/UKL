<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","rent_car");
if (isset($_POST["action"])) {
$id_mobil = $_POST["id_mobil"];
$nomor_mobil = $_POST["nomor_mobil"];
$merk = $_POST["merk"];
$jenis = $_POST["jenis"];
$warna = $_POST["warna"];
$tahun_pembuatan = $_POST["tahun_pembuatan"];
$biaya_sewa_per_hari = $_POST["biaya_sewa_per_hari"];
$lama_sewa = $_POST["lama_sewa"];
$jumlah = $_POST["jumlah"];

$action = $_POST["action"];

if ($_POST["action"] == "insert") {
  $path = pathinfo($_FILES["gambar"]["name"]);
  $extensi = $path["extension"];
  $filename = $id_mobil."-".rand(1,1000).".".$extensi;

  $sql = "insert into mobil values('$id_mobil','$nomor_mobil','$merk','$jenis','$warna','$tahun_pembuatan','$biaya_sewa_per_hari','$lama_sewa','$jumlah','$filename')";
  if (mysqli_query($koneksi,$sql)) {
    move_uploaded_file($_FILES["gambar"]["tmp_name"],"img_mobil/$filename");
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
    header("location:template_karyawan.php?page=mobil");

}elseif ($_POST["action"] == "update") {
  if (!empty($_FILES["gambar"]["name"])) {
    $sql = "select * from mobil where id_mobil='$id_mobil'";
    $result = mysqli_query($koneksi,$sql);
    $hasil = mysqli_fetch_array($result);
    if (file_exists("img_mobil/".$hasil["gambar"])) {
      unlink("img_mobil/".$hasil["gambar"]);
  }

  $path = pathinfo($_FILES["gambar"]["name"]);
  $extensi = $path["extension"];
  $filename = $id_mobil."-".rand(1,1000).".".$extensi;

  $sql = "update mobil set nomor_mobil='$nomor_mobil',merk='$merk',jenis='$jenis',warna='$warna',tahun_pembuatan='$tahun_pembuatan',biaya_sewa_per_hari='$biaya_sewa_per_hari',lama_sewa='$lama_sewa',jumlah='$jumlah',gambar='$filename' where id_mobil='$id_mobil' ";

  if (mysqli_query($koneksi,$sql)) {

  move_uploaded_file($_FILES["gambar"]["tmp_name"],"img_mobil/$filename");
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

$sql = "update mobil set nomor_mobil='$nomor_mobil',merk='$merk',jenis='$jenis',warna='$warna',tahun_pembuatan='$tahun_pembuatan',biaya_sewa_per_hari='$biaya_sewa_per_hari',lama_sewa='$lama_sewa',jumlah='$jumlah' where id_mobil='$id_mobil' ";
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
  header("location:template_karyawan.php?page=mobil");
  }
}
if (isset($_GET["hapus"])) {
        $id_mobil = $_GET["id_mobil"];

        $sql = "select * from mobil where id_mobil='$id_mobil'";

        $result = mysqli_query($koneksi,$sql);

        $hasil = mysqli_fetch_array($result);
        if (file_exists("img_mobil/".$hasil["image"])) {
          unlink("img_mobil/".$hasil["image"]);

        }
          $sql = "delete from mobil where id_mobil='$id_mobil'";
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
          header("location:template_karyawan.php?page=mobil");
          }
 ?>
