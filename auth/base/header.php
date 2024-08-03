<?php
ob_start();
session_start();
session_regenerate_id();

include "db.php";
include "../csrf-security/csrf.php";

if (isset($_COOKIE['X-APP-ANTRIAN']) && isset($_COOKIE['X-APP-USERNAME'])) {

    $ambilToken = $_COOKIE['X-APP-ANTRIAN'];
    $sql = "SELECT remember_token FROM tbl_auth WHERE remember_token = :remember_token";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":remember_token", $ambilToken);
    $stmt->execute();
    $checkToken = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($checkToken['remember_token'] == $ambilToken) {
        $_SESSION['login'] = true;
        header("Location: ../index.php");
    } else {
        header('Location: logout.php');
    }
}

if (isset($_SESSION['login'])) {
    header('Location: ../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo (basename($_SERVER['PHP_SELF']) == 'login.php' ? 'Login - Antrian' : 'Error') ?></title>
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.jpg">
    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gradient-primary">