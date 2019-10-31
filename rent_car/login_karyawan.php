<?php session_start();?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script type="text/javascript">

    function Add(){
      document.getElementById('action').value="insert";
      document.getElementById("id_karyawan").value="";
      document.getElementById("nama_karyawan").value="";
      document.getElementById("alamat_karyawan").value="";
      document.getElementById("kontak").value="";
      document.getElementById("username").value = "";
      document.getElementById("password").value="";
      document.getElementById("gambar").value="";
    }
    </script>
    <style media="screen">
      .gambar{
        background-image: url('img/aa.jpg');
        background-size: cover;
      }
      .gambar_login{
        height: 40px;
      }
    </style>
  </head>
  <body class="gambar">
    <div class="container my-5">
      <div class="row justify-content-center align-items-center">
        <div class="col-sm-6 card">
          <div class="text-center card-header">
            <h3>L O G I N</h3>
          </div>
          <div class="card-body">
            <?php if (isset($_SESSION["message"])): ?>
              <div class="alert alert-<?=($_SESSION["message"]["type"])?>">
                <?php echo $_SESSION["message"]["message"]; ?>
                <?php unset($_SESSION["message"]); ?>
              </div>
            <?php endif; ?>
            <form action="proses_login_karyawan.php" method="post" class="text-center mt-3">
              <img src="img/logo.png" align="left" class="gambar_login col-sm-2">
              <input type="text" name="username" class="form-control mb-2 col-sm-10" placeholder="Username" required>
              <img src="img/logo2.png" align="left" class="gambar_login col-sm-2">
              <input type="password" name="password" class="form-control mb-2 col-sm-10" placeholder="Password" required>
              <button type="submit" class="btn btn-info btn-block mt-3">
                Login
              </button>
            </form>
          </div>
          <div class="card-footer bg-white bd-highlight mb-3 py-1">
            <h6>Anda belum mempunyai akun?</h6>
            <button type="button" class="btn btn-info bd-highlight mx-9"
            data-toggle="modal" data-target="#modal" onclick="Add()">
            Registrasi
          </button>
            <i class="fa fa-user btn btn-info"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="db_registrasi.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h4>Buat Akun</h4>
            </div>
            <div class="modal-body">
            <input type="hidden" name="action" id="action">
            <!-- untuk meyimpan aksi yang akan dilakukan entah itu insert/update -->
                ID Karyawan
                <input type="text" name="id_karyawan" id="id_karyawan" class="form-control">
                Nama Karyawan
                <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control">
                Alamat Karyawan
                <input type="text" name="alamat_karyawan" id="alamat_karyawan" class="form-control">
                Kontak
                <input type="text" name="kontak" id="kontak" class="form-control">
                Username
                <input type="text" name="username" id="username" class="form-control">
                Password
                <input type="password" name="password" id="password" class="form-control">
                Gambar
                <input type="file" name="gambar" id="gambar" class="form-control">
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-info btn-block">
                  Save
                </button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
