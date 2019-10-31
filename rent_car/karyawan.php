<script type="text/javascript">
    function Add(){

      document.getElementById('action').value = "insert";

      document.getElementById("id_karyawan").value = "";
      document.getElementById("nama_karyawan").value = "";
      document.getElementById("alamat_karyawan").value = "";
      document.getElementById("kontak").value = "";
      document.getElementById("username").value = "";
      document.getElementById("password").value = "";
      document.getElementById("gambar").value = "";

    }
    function Edit(index){

      document.getElementById('action').value = "update";

      var table = document.getElementById('table_karyawan')

      var id_karyawan        = table.rows[index].cells[0].innerHTML;
      var nama_karyawan      = table.rows[index].cells[1].innerHTML;
      var alamat_karyawan    = table.rows[index].cells[2].innerHTML;
      var kontak             = table.rows[index].cells[3].innerHTML;
      var username           = table.rows[index].cells[4].innerHTML;
      var password           = table.rows[index].cells[5].innerHTML;


      document.getElementById("id_karyawan").value      = id_karyawan;
      document.getElementById("nama_karyawan").value    = nama_karyawan;
      document.getElementById("alamat_karyawan").value  = alamat_karyawan;
      document.getElementById("kontak").value           = kontak;
      document.getElementById("username").value         = username;
      document.getElementById("password").value         = password;
    }
</script>
  <div class="card col-sm-12 mt-3">
  <div class="card-header text-dark text-center">
      <h4>DAFTAR KARYAWAN</h4>
  </div>
  <div class="card-body" style="overflow:auto">
    <?php if (isset($_SESSION["message"])): ?>
      <div class="alert alert-<?=($_SESSION["message"]["type"])?>">
        <?php echo $_SESSION["message"]["message"]; ?>
        <?php unset($_SESSION["message"]); ?>
      </div>

    <?php endif; ?>
    <?php
    $koneksi = mysqli_connect("localhost","root","","rent_car");
    $sql = "select * from karyawan";
    $result = mysqli_query($koneksi,$sql);
    $count = mysqli_num_rows($result);
     ?>
     <?php if ($count == 0): ?>

       <div class="alert alert-info">
         "Data belum tersedia"
       </div>
     <?php else: ?>

       <table class="table table-responsive text-center" id="table_karyawan">
         <thead>
           <tr>
             <th>ID Karyawan</th>
             <th>Nama Karyawan</th>
             <th>Alamat Karyawan</th>
             <th>Kontak</th>
             <th>Username</th>
             <th>Password</th>
             <th>Gambar</th>
             <th>Opsi</th>
           </tr>
         </thead>
         <tbody>
           <?php foreach ($result as $hasil): ?>
             <tr>

               <td><?php echo $hasil["id_karyawan"]; ?></td>
               <td><?php echo $hasil["nama_karyawan"]; ?></td>
               <td><?php echo $hasil["alamat_karyawan"]; ?></td>
               <td><?php echo $hasil["kontak"]; ?></td>
               <td><?php echo $hasil["username"]; ?></td>
               <td><?php echo $hasil["password"]; ?></td>
               <td>
                 <img src="<?php echo "img_karyawan/".$hasil["gambar"];?>"
                 class="img" width="100">
               </td>
               <td>
                 <button type="button" class="btn btn-primary"
                  data-toggle="modal" data-target="#modal"
                  onclick="Edit(this.parentElement.parentElement.rowIndex);">
                  Edit
                </button>
               <a href="db_karyawan.php?hapus=karyawan&id_karyawan=<?php echo $hasil["id_karyawan"]; ?>"
                 onclick="return confirm('Apkah anda yakin ingin menghapus data ini?')">
                 <button type="button" class="btn btn-warning">
                   Hapus
                 </button>
               </a>
               </td>
             </tr>
           <?php endforeach; ?>
         </tbody>
       </table>
     <?php endif; ?>
  </div>
      <div class="card-footer text-center">
        <button type="button" class="btn btn-info btn-block mt-3"
          data-toggle="modal" data-target="#modal" onclick="Add()">
          Tambah
        </button>
      </div>
    </div>
  </div>

<!-- membuat modal/pop up -->
<div class="modal fade" id="modal">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <form action="db_karyawan.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h4>Form Karyawan</h4>
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
        <button type="submit" class="btn btn-success">
          Simpan
        </button>
      </div>
    </form>
  </div>
</div>
</div>
