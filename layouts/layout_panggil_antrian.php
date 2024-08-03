<?php
include "auth/db.php";

$id = $_GET['id'];

$sql = "SELECT id, status_panggil, no_antrian FROM tbl_antrian_obat WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();
$res = $stmt->fetch(PDO::FETCH_ASSOC);

$tz = 'Asia/Jakarta';
$dt = new DateTime("now", new DateTimeZone($tz));
$jam_sekarang = $dt->format('H:i:s');

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card text-center mt-5 shadow-sm bg-white rounded">
                <div class="card-header">
                    Antrian Loket
                </div>

                <audio id="bel_antrian" src="assets/bel_antrian.mp3"></audio>

                <?php if ($res['status_panggil'] == "N") { ?>
                    <form method="post" class="form_panggil_antrian">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generateCSRFToken()); ?>">
                        <input type="hidden" value="<?php echo $res['id']; ?>" name="id">
                        <div class="card-body">
                            <?php if ($res) { ?>
                                <h3 class="card-title mb-3 no_antrian"><?php echo $res['no_antrian']; ?></h3>
                            <?php } ?>
                            <button type="button" class="btn btn-primary btnPanggil mb-3"><i class="bi bi-megaphone-fill"></i> Panggil</button>
                        </div>

                        <div class="card-footer text-muted">
                            <a href="panggilan_manual.php">Kembali</a>
                        </div>
                    </form>
                <?php } else { ?>
                    <div class="card-body">
                        <?php if ($res) { ?>
                            <h3 class="card-title mb-3 no_antrian"><?php echo $res['no_antrian']; ?></h3>
                        <?php } ?>
                        <button type="button" class="btn btn-primary btnPanggilUlang mb-3"><i class="bi bi-megaphone-fill"></i> Panggil Ulang</button>
                    </div>

                    <div class="card-footer text-muted">
                        <a href="panggilan_manual.php">Kembali</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>