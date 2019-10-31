<script type="text/javascript">
  function Print() {
    var printDocument = document.getElementById("report").innerHTML;
    var originalDocument = document.body.innerHTML;
    document.body.innerHTML = printDocument;
    window.print();
    document.body.innerHTML = originalDocument;
  }
</script>
<div id="report" class="card col-sm-12">
  <div class="card-header">
    <h3>Daftar Penyewaan</h3>
  </div>
  <div class="card-body">
    <?php
    $koneksi = mysqli_connect("localhost","root","","rent_car");
    $sql = "select sewa.*,pelanggan.nama_pelanggan
    from sewa sewa inner join pelanggan pelanggan
    on sewa.id_pelanggan=pelanggan.id_pelanggan";

    $result = mysqli_query($koneksi,$sql);
     ?>
     <table class="table text-center">
       <thead>
         <tr>
           <th>Tanggal Sewa</th>
           <th>Tanggal Kembali</th>
           <th>ID Sewa</th>
           <th>Nama Pelanggan</th>
           <th>Option</th>
         </tr>
       </thead>
       <tbody>
         <?php foreach ($result as $hasil): ?>
           <tr>
             <td><?php echo $hasil["tgl_sewa"]; ?></td>
             <td><?php echo $hasil["tgl_kembali"]; ?></td>
             <td><?php echo $hasil["id_sewa"]; ?></td>
             <td><?php echo $hasil["nama_pelanggan"]; ?></td>
             <td>
               <a href="template_karyawan.php?page=nota&id_sewa=<?php echo $hasil["id_sewa"]; ?>">
               <button type="button" class="btn btn-secondary">
                 Details
               </button>
               </a>
             </td>
           </tr>
         <?php endforeach; ?>
       </tbody>
     </table>

     <button onclick="Print()" type="button" class="btn btn_success">
       Print
     </button>
  </div>
</div>
