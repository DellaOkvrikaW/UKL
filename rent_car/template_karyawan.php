<?php session_start(); ?>
<?php if (isset($_SESSION["session_karyawan"])): ?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Daftar Menu</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</head>
<style media="screen">
  .gambar{
    background-image: url('img/aa.jpg');
  }
</style>

<body class="gambar">
  <nav class= "navbar navbar-expand-md bg-info navbar-dark sticky-top px-4">
    <h5>
      <a class="fa fa-car text-white mx-2"></a>
    </h5>
  <a href="#" class="text-white">
     <h3>Rental Mobil DOW</h3>
  </a>
  <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
    <span class="navbar navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="menu">
    <ul class="navbar-nav">
      <li class="nav-item"><a href="template_karyawan.php?page=pelanggan" class="nav-link"></a></li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle btn btn-info text-white mx-4" data-toggle="dropdown">Daftar Menu</a>
          <div class="dropdown-menu">
            <a href="template_karyawan.php?page=karyawan" class="dropdown-item">Karyawan</a>
            <a href="template_karyawan.php?page=mobil" class="dropdown-item">Mobil</a>
            <a href="template_karyawan.php?page=pelanggan" class="dropdown-item">Pelanggan</a>
            <a href="template_karyawan.php?page=daftar_sewa" class="dropdown-item">Daftar Sewa</a>
            <a href="template_karyawan.php?page=list_mobil" class="dropdown-item">Menu Mobil</a>
            <a href="proses_login_karyawan.php?page=logout" class="dropdown-item">Logout</a>
        </div>
      </li>
    </ul>
    <form class="form-inline mx-4 my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
  <a href="template_karyawan.php?page=list_sewa">
    <b class=" btn btn-info text-white">Sewa: <?php echo count($_SESSION["session_sewa"]); ?></b>
  </a>
</nav>
<div class="container my-2">
  <?php if (isset($_GET["page"])): ?>
    <?php if ((@include $_GET["page"].".php") === true): ?>
      <?php include $_GET["page"].".php";?>
    <?php endif; ?>
  <?php endif; ?>
</div>
</body>
</html>
<?php else: ?>
  <?php echo "Anda belum login!"; ?>
  <br>
  <a href="login_karyawan.php">
    Loginnya disini
  </a>
<?php endif; ?>
