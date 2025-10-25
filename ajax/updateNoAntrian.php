<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../auth/db.php';
    include_once '../csrf-security/csrf.php';

    $csrf_token = $_POST['csrf_token'];

    if (!isset($csrf_token) || !isCSRFTokenValid($csrf_token)) {
        echo json_encode(['status' => false, 'message' => 'Invalid CSRF token']);
    } else {

        $tz = 'Asia/Jakarta';
        $dt = new DateTime("now", new DateTimeZone($tz));
        $jam_panggil_sekarang = $dt->format('H:i:s');
        $id = $_POST['id'];
        $status_panggil = "Y";

        $sql = "UPDATE tbl_antrian_obat SET jam_panggil = :jam_panggil, status_panggil = :status_panggil WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":jam_panggil", $jam_panggil_sekarang);
        $stmt->bindParam(":status_panggil", $status_panggil);
        $stmt->execute();

        echo json_encode(['status' => true, 'message' => 'CSRF token valid']);
    }
}
