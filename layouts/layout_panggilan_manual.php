 <?php
    include "auth/db.php";

    $sql = "SELECT * FROM tbl_antrian_obat";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $no = 1;
    ?>

 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">Panggilan Manual</h6>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                     <tr>
                         <th>No Antrian</th>
                         <th>Tanggal</th>
                         <th>Jam Ambil</th>
                         <th>Jam Panggil</th>
                         <th>Status</th>
                         <th>Aksi</th>
                     </tr>
                 </thead>

                 <tbody>
                     <?php foreach ($res as $item) { ?>
                         <tr class="text-center">
                             <td><?php echo $item['no_antrian']; ?></td>
                             <td><?php echo $item['tanggal']; ?></td>
                             <td><?php echo $item['jam_ambil']; ?></td>
                             <td><?php echo ($item['jam_panggil'] == "" ? "-" : $item['jam_panggil'])  ?></td>
                             <td><?php echo ($item['status_panggil'] == "Y"
                                        ? "<span class='badge badge-success'>Terpanggil</span>" : "<span class='badge badge-danger'>Belum Terpanggil</span>") ?></td>
                             <td class="text-center">
                                 <a href="panggil_antrian.php?id=<?php echo $item['id']; ?>" class="btn btn-primary">
                                     <i class="bi bi-megaphone-fill"></i>
                                     <?php echo ($item['status_panggil'] == 'Y' ? 'Panggil Ulang' : 'Panggil')  ?>
                                 </a>
                             </td>
                         </tr>
                     <?php } ?>
                 </tbody>
             </table>
         </div>
     </div>
 </div>