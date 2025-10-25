<?php

function stmtSQLPrepared($status_panggil)
{
    include "auth/db.php";

    $sql =  "SELECT COUNT(id) FROM tbl_antrian_obat WHERE status_panggil = :status_panggil";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":status_panggil", $status_panggil);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "<h4>" . $res['COUNT(id)'] . "</h4>";
}

if (isset($_SESSION['berhasil_login'])) {
    echo "<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.onmouseenter = Swal.stopTimer;
          toast.onmouseleave = Swal.resumeTimer;
        }
      });
      Toast.fire({
        icon: 'success',
        title: '$_SESSION[berhasil_login]'
      });
    </script>";

    unset($_SESSION['berhasil_login']);
}
?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card text-center mt-5 shadow-sm mb-5 bg-white rounded">
                <div class="card-header p-3 mb-2 bg-success text-white">
                    <i class="bi bi-megaphone-fill mr-2"></i> Total Loket Antrian Terpanggil
                </div>

                <div class="card-body">
                    <?php stmtSQLPrepared("Y"); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card text-center mt-5 shadow-sm mb-5 bg-white rounded">
                <div class="card-header p-3 mb-2 bg-danger text-white">
                    <i class="bi bi-megaphone-fill mr-2"></i> Total Loket Antrian Tidak Terpanggil
                </div>

                <div class="card-body">
                    <?php stmtSQLPrepared("N"); ?>
                </div>
            </div>
        </div>
    </div>
</div>