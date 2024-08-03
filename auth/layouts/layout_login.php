<?php

if (isset($_POST['login']) && $_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST['csrf_token']) || !isCSRFTokenValid($_POST['csrf_token'])) {
        die('Invalid CSRF token');
    } else {

        $username = htmlspecialchars($_POST['username'], ENT_QUOTES);
        $password = htmlspecialchars($_POST['password'], ENT_QUOTES);
        $stmt = $conn->prepare("SELECT * FROM tbl_auth WHERE username = :username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($username == "" || $password == "") {
            echo "<script>
        Swal.fire({
            title: 'Login Error',
            text: 'Username atau password wajib di isi.',
            icon: 'error'
          });
        </script>";
        } else if ($result) {
            if (password_verify($password, $result['password'])) {

                $_SESSION['username'] = $result['username'];
                $username = $_SESSION['username'];
                $parts = explode('_', $username);
                $role = ucfirst($parts[0]);
                $_SESSION['role'] = $role;
                $_SESSION['login'] = true;
                $_SESSION['berhasil_login'] = 'Selamat datang Admin.';

                if (isset($_POST['remember_me'])) {
                    $expire = time() + (2 * 24 * 60 * 60);
                    $secure = true;
                    $httponly = true;
                    $token = bin2hex(random_bytes(50 / 2));
                    setcookie('X-APP-ANTRIAN', $token, $expire, '/', null, $secure, $httponly);
                    setcookie('X-APP-USERNAME', $role, $expire, '/', null, $secure, $httponly);

                    $rememberToken = $conn->prepare("UPDATE tbl_auth SET remember_token = :remember_token WHERE username = :username");
                    $rememberToken->bindParam(":username", $username);
                    $rememberToken->bindParam(":remember_token", $token);
                    $rememberToken->execute();
                }

                header("Location: ../index.php");
            } else {
                echo "<script>
            Swal.fire({
                title: 'Login Error',
                text: 'Login Anda gagal. Silakan coba lagi.',
                icon: 'error'
              });
            </script>";
            }
        } else {
            echo "<script>
        Swal.fire({
            title: 'Login Error',
            text: 'Login Anda gagal. Silakan coba lagi.',
            icon: 'error'
          });
        </script>";
        }
    }
}

if (isset($_SESSION['pesan_pendaftaran'])) {
    echo "<script>
    Swal.fire(
        'Pendaftaran Berhasil',
        '$_SESSION[pesan_pendaftaran]',
        'success'
    )
    </script>";

    unset($_SESSION['pesan_pendaftaran']);
}

if (isset($_GET['action']) && $_GET['action'] == 'logout' && !isset($_SESSION['logout_displayed'])) {

    $_SESSION['logout'] = 'Anda berhasil logout.';
    $_SESSION['logout_displayed'] = true;

    if (isset($_SESSION['logout_displayed'])) {
        if (isset($_SESSION['logout'])) {
            echo "
            <script>
                Swal.fire({
                    title: 'Berhasil',
                    text: '" . $_SESSION['logout'] . "',
                    icon: 'success'
                });
            </script>
            ";

            unset($_SESSION['logout']);
        }
    }
}

?>

<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                </div>
                                <form class="user" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" autocomplete="off" value="<?php echo (isset($_POST['username']) ? htmlspecialchars($_POST['username'], ENT_QUOTES) : '') ?>">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password" placeholder="Password" value="<?php echo (isset($_POST['password']) ? htmlspecialchars($_POST['password'], ENT_QUOTES) : '') ?>">
                                    </div>
                                    <div class="form-group d-flex justify-content-between align-items-center">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="remember_me" name="remember_me" <?php echo (isset($_POST['remember_me']) ? 'checked' : '') ?>>
                                            <label class="custom-control-label" for="remember_me">Ingat Saya</label>
                                        </div>
                                    </div>
                                    <hr>

                                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generateCSRFToken()); ?>">
                                    <button type="submit" class="btn btn-primary btn-user btn-block" name="login">
                                        Login
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>