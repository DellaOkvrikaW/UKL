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
        $pathinfo=pathinfo($_FILES["gambar"]["name"]);
        $extensi=$path["extension"];
        $filename=$id_karyawan."-".rand(1,1000).".".$extensi;
        $id_karyawan= rand(10000,1000000);
        $sql = "insert into karyawan values('$id_karyawan','$nama_karyawan','$alamat_karyawan','$kontak','$username','$password','$filename')";
        if(mysqli_query($koneksi,$sql)){
            move_uploaded_file($_FILES["gambar"]["tmp_name"],"img_karyawan/$filename");
            $_SESSION["message"] = array(
                "type" => "success",
                "message" => "Account created successfully"
            );
        }else{
            $_SESSION["message"] = array(
                "type" => "danger",
                "message" => mysqli_error($koneksi)
            );
        }
        header("location:login_karyawan.php");
      }
    }
 ?>
