<div class="card col-sm-12">
  <div class="card-header text-center">
    <h4>Mobil Yang Akan Di Sewa</h4>
  </div>
  <div class="card-body" style="overflow:auto">
    <form action="db_sewa.php?checkout=true" method="post"
    onsubmit="return confirm('Apakah Anda Yakin Penyewaan Ini?')">
    <table class="table table-responsive text-center">
      <thead>
        <tr>
          <th>Id Mobil</th>
          <th>Nomor Mobil</th>
          <th>Merk</th>
          <th>jenis</th>
          <th>Warna</th>
          <th>Tahun Pembuatan</th>
          <th>Biaya Sewa</th>
          <th>Lama Sewa</th>
          <th>Jumlah</th>
          <th>Gambar</th>
          <th>
            Option
          </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($_SESSION["session_sewa"] as $hasil):?>
        <tr>
          <td><?php echo $hasil["id_mobil"]; ?></td>
          <td><?php echo $hasil["nomor_mobil"]; ?></td>
          <td><?php echo $hasil["merk"]; ?></td>
          <td><?php echo $hasil["jenis"]; ?></td>
          <td><?php echo $hasil["warna"]; ?></td>
          <td><?php echo $hasil["tahun_pembuatan"]; ?></td>
          <td><?php echo $hasil["biaya_sewa_per_hari"]; ?></td>
          <td>
            <input type="number" name="lama_sewa<?php echo $hasil["id_mobil"]; ?>" min="1">
          </td>
          <td>
            <input type="number" name="jumlah<?php echo $hasil["id_mobil"];?>" min="1">
          </td>
          <td>
            <img src="img_mobil/<?php echo $hasil["gambar"]; ?>" width="100" height="80" class="img">
          </td>
          <td>
            <a href="db_sewa.php?hapus=true&id_mobil=<?php echo $hasil["id_mobil"]; ?>" onclick="return confirm('Apakan anda yakin ingin menghapus pesanan ini?')">
              <button type="button" class="btn btn-info">Hapus</button>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <button type="submit" class="btn btn-info btn btn-block">Checkout</button>
    </form>
  </div>
</div>
