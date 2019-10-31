<div class="card col-sm-12 text-center">
  <div class="card-header">
    <h3>Nota Sewa</h3>
  </div>
</div class="card-body">
  <?php
  $koneksi = mysqli_connect("localhost","root","","rent_car");
  $id_sewa = $_GET["id_sewa"];
  $sql = "select s.id_sewa, p.nama_pelanggan, s.tgl_sewa
  from sewa s inner join pelanggan p on
  s.id_pelanggan = p.id_pelanggan where s.id_sewa='$id_sewa'";
  $result = mysqli_query($koneksi,$sql);
  $hasil = mysqli_fetch_array($result);


  // data barang
  $sql2 = "select m.*, ds.jumlah, ds.harga_sewa
   from mobil m inner join detail_sewa ds
   on m.id_mobil = ds.id_mobil where ds.id_sewa='$id_sewa'";
   $result2 = mysqli_query($koneksi,$sql2);
  ?>

  <h4>ID. Sewa             :  <?php echo $hasil["id_sewa"]; ?></h4>
  <h4>Nama Pelanggan       :  <?php echo $hasil["nama_pelanggan"]; ?></h4>
  <h4>Tanggal Penyewaan    :  <?php echo $hasil["tgl_sewa"]; ?></h4>

  <table class="table text-center text-white">
    <thead>
      <tr>
      <th>Id Mobil</th>
      <th>Nomor Mobil</th>
      <th>Merk</th>
      <th>Jenis</th>
      <th>Warna</th>
      <th>Tahun Pembuatan</th>
      <th>Biaya Sewa</th>
      <th>lama Sewa</th>
      <th>Jumlah</th>
      <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <?php $total_bayar = 0; foreach ($result2 as $hasil): ?>
        <tr>
          <td><?php echo $hasil["id_mobil"]; ?></td>
          <td><?php echo $hasil["nomor_mobil"]; ?></td>
          <td><?php echo $hasil["merk"]; ?></td>
          <td><?php echo $hasil["jenis"]; ?></td>
          <td><?php echo $hasil["warna"]; ?></td>
          <td><?php echo $hasil["tahun_pembuatan"]; ?></td>
          <td><?php echo "Rp".number_format($hasil["biaya_sewa_per_hari"]); ?></td>
          <td><?php echo $hasil["lama_sewa"]; ?></td>
          <td><?php echo $hasil["Jumlah"]; ?></td>
          <td><?php echo "Rp".number_format($hasil["lama_sewa"]*$hasil["biaya_sewa_per_hari"]); ?></td>
        </tr>
      <?php
        $total_bayar += $hasil["lama_sewa"]*$hasil["biaya_sewa_per_hari"];
        endforeach; ?>
    </tbody>
  </table>
  <h2 class="text-right text-white">
    <?php echo "Rp ".number_format($total_bayar) ?>
  </h2>
   </div>
  </div>
