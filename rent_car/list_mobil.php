<?php
$koneksi = mysqli_connect("localhost","root","","rent_car");
$sql = "select * from mobil";
$result = mysqli_query($koneksi,$sql);
?>
<div class="row">
  <?php foreach ($result as $hasil): ?>
    <div class="card col-sm-4">
      <div class="card-body">
        <img src="img_mobil/<?php echo $hasil["gambar"] ?>" class="img" width="100%" height="auto">
      </div>
      <div class="card-footer">
        <h4 class="text-center">Nomor     : <?php echo $hasil["nomor_mobil"]; ?></h4>
        <h5 class="text-center">Merk      : <?php echo $hasil["merk"]; ?></h5>
        <h6 class="text-center">Jenis     : <?php echo $hasil["jenis"]; ?></h6>
        <h6 class="text-center">Warna     : <?php echo $hasil["warna"]; ?></h6>
        <h6 class="text-center">Tahun     : <?php echo $hasil["tahun_pembuatan"]; ?></h6>
        <h6 class="text-center">Harga     : Rp. <?php echo $hasil["biaya_sewa_per_hari"]; ?></h6>
        <h6 class="text-center">Lama Sewa : <?php echo $hasil["lama_sewa"]; ?></h6>
        <h6 class="text-center">Jumlah    : <?php echo $hasil["jumlah"]; ?></h6>        
        <a href="db_sewa.php?sewa=true&id_mobil=<?php echo $hasil["id_mobil"]; ?>">
        <button type="button" class="btn btn-info btn-block">
          Sewa
        </button>
        </a>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<h5>
  <a class="fa fa-shopping-cart text-white mx-3 mt-3"></a>
</h5>
<a href="template_karyawan.php?page=list_sewa">
  <b class="text-white">Sewa : <?php echo count ($_SESSION["session_sewa"]); ?></b>
</a>
