<?php
include "auth/db.php";

if (isset($_POST['ganti']) && $_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST['csrf_token']) || !isCSRFTokenValid($_POST['csrf_token'])) {

        die('Invalid CSRF token');
    } else {
        $username = $_SESSION['username'];
        $password_baru = $_POST['password_baru'];
        $konfirmasi_password = $_POST['konfirmasi_password'];
        $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
        $pesan = "";

        if ($password_baru == "" || $konfirmasi_password == "") {
            $pesan .= '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
       Anda harus memasukkan semua kolom inputan password yang tertera.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
        } else if ($password_baru != $konfirmasi_password) {
            $pesan .= '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
        Konfirmasi password tidak sesuai. Coba lagi.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
        } else {
            $sql = "UPDATE tbl_auth SET password = :password WHERE username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":password", $password_hash);
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            $pesan .= '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">
   Password lama berhasil di ganti.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
        }
    }
}
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card mt-5">
                <div class="card-header">
                    Ganti Password
                </div>

                <div class="card-body">

                    <?php if (isset($_POST['ganti'])) {
                        echo $pesan;
                    }
                    ?>

                    <form method="post">
                        <div class="form-group">
                            <label for="password_baru">Password Baru</label>
                            <input type="password" class="form-control" id="password_baru" name="password_baru">
                        </div>

                        <div class="form-group">
                            <label for="konfirmasi_password">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password">
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="lihat_password" name="lihat_password">
                                <label class="custom-control-label" for="lihat_password">Lihat Password</label>
                            </div>
                        </div>

                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generateCSRFToken()); ?>">
                        <button type="submit" class="btn btn-primary" name="ganti">Ganti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>