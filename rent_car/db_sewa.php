<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","rent_car");
if (isset($_GET["sewa"])) {
  $id_mobil = $_GET["id_mobil"];
  $sql = "select * from mobil where id_mobil='$id_mobil'";
  $result = mysqli_query($koneksi,$sql);
  $hasil = mysqli_fetch_array($result);

  if (!in_array($hasil,$_SESSION["session_sewa"])) {
    array_push($_SESSION["session_sewa"],$hasil);
  }
  header("location:template_karyawan.php?page=list_mobil");
}

if (isset($_GET["checkout"])) {
  $koneksi = mysqli_connect("localhost","root","","rent_car");
  // Siapkan data untuk tabel transaksi
  $id_sewa = rand(1,1000000);
  $id_mobil = null;
  $id_karyawan = null;
  $id_pelanggan =  $_SESSION["session_pelanggan"]["id_pelanggan"];
  $tgl_sewa = date("Y-m-d");
  $tgl_kembali = null;
  $sql = "insert into sewa values('$id_sewa','$id_mobil','$id_karyawan','$id_pelanggan','$tgl_sewa','$tgl_kembali','0')";
  mysqli_query($koneksi,$sql);

      foreach ($_SESSION["session_sewa"] as $hasil) {
      $sql = "insert into detail_sewa values ('$id_sewa','".$hasil["id_mobil"]."')";
      mysqli_query($koneksi,$sql);
      $sql_update = "update mobil set jumlah=jumlah-1 where id_mobil='".$hasil["id_mobil"]."'";
      mysqli_query($koneksi,$sql_update);
      // echo $sql;
      }
      $_SESSION["session_sewa"] = array();
      header("location:template_karyawan.php?page=nota&id_sewa=$id_sewa");
    }

    if (isset ($_GET["hapus"])) {
      $id_mobil = $_GET["id_mobil"];
      $index = array_search($id_mobil,array_column($_SESSION["session_sewa"],"id_mobil"));
      array_splice($_SESSION["session_sewa"],$index,1);
      header("location:template_karyawan.php?page=list_sewa");
    }

    if (isset($_GET["kembali"])) {
      $id_sewa = $_GET["id_sewa"];
      $sql = "select * from detail_sewa where id_sewa='$id_sewa'";
      $result = mysqli_query($koneksi,$sql);

      foreach ($result as $hasil) {
        $sql = "update mobil set jumlah=jumlah+1 where id_mobil='".$hasil["id_mobil"]."'";
        mysqli_query($koneksi,$sql);
        }
        $sql="update sewa set status='1' where id_sewa='$id_sewa'";
        mysqli_query($koneksi,$sql);
        header("location:template_karyawan.php?page=list_mobil");
      }
   ?>
