<?php
session_start();
session_unset();
session_destroy();

if (isset($_COOKIE['X-APP-ANTRIAN']) && isset($_COOKIE['X-APP-USERNAME'])) {
    setcookie("X-APP-ANTRIAN", "", time() - 3600, "/");
    setcookie("X-APP-USERNAME", "", time() - 3600, "/");
}

header("Location: login.php?action=logout");
