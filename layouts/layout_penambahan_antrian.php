<?php
include "auth/db.php";

$stmtAmbilNoAntrian = $conn->prepare("SELECT MAX(no_antrian) AS max_no_antrian FROM tbl_antrian_obat");
$stmtAmbilNoAntrian->execute();
$checkNoAntrian = $stmtAmbilNoAntrian->fetch(PDO::FETCH_ASSOC);
$tambahAntrianBaru = ($checkNoAntrian && isset($checkNoAntrian['max_no_antrian'])) ? $checkNoAntrian['max_no_antrian'] + 1 : 1;

if (isset($_POST['simpan_antrian']) && $_SERVER["REQUEST_METHOD"] == "POST") {

  if (!isset($_POST['csrf_token']) || !isCSRFTokenValid($_POST['csrf_token'])) {

    die('Invalid CSRF token');
  } else {

    $tz = 'Asia/Jakarta';
    $dt = new DateTime("now", new DateTimeZone($tz));
    $tanggal = $dt->format('Y-m-d');
    $jam_sekarang = $dt->format('H:i:s');
    $no_antrian = $_POST['no_antrian'];
    $status_panggil = "N";
    $pesan = "";

    if ($no_antrian == "") {
      $pesan .= '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
    No antrian wajib di isi.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
    } else if ($no_antrian <= 0) {
      $pesan .= '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
    No antrian harus di mulai dari 1.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
    } else {

      if (filter_var($no_antrian, FILTER_VALIDATE_INT) !== false) {

        $sql = "INSERT INTO tbl_antrian_obat (tanggal, no_antrian, jam_ambil, status_panggil) 
      VALUES (:tanggal, :no_antrian, :jam_ambil, :status_panggil)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':tanggal', $tanggal);
        $stmt->bindParam(':no_antrian', $no_antrian, PDO::PARAM_INT);
        $stmt->bindParam(':jam_ambil', $jam_sekarang);
        $stmt->bindParam(':status_panggil', $status_panggil);

        if ($stmt->execute()) {

          $pesan .= '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">
      No antrian berhasil di tambahkan.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
        }
      } else {
        $pesan .= '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
     Harap masukkan no antrian dengan benar.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
      }
    }
  }
}
?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="card mt-5">
        <div class="card-header">
          Penambahan Antrian
        </div>

        <div class="card-body">

          <?php if (isset($_POST['simpan_antrian'])) {
            echo $pesan;
          }
          ?>
          <form method="post">
            <div class="form-group">
              <label for="no_antrian">No Antrian</label>
              <input type="number" class="form-control" id="no_antrian" name="no_antrian" value="<?php echo $tambahAntrianBaru; ?>" readonly>
            </div>

            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generateCSRFToken()); ?>">
            <button type="submit" class="btn btn-primary" name="simpan_antrian">Simpan Antrian</button>
          </form>
        </div>
      </div>
    </div>
  </div>