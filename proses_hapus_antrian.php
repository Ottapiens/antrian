<?php
session_start();

include "auth/db.php";

$id = $_GET['id'];

$ambilNoAntrian = "SELECT no_antrian FROM tbl_antrian_obat WHERE id = :id";
$ambilData = $conn->prepare($ambilNoAntrian);
$ambilData->bindParam(":id", $id, PDO::PARAM_INT);
$ambilData->execute();
$noAntrian = $ambilData->fetch(PDO::FETCH_ASSOC);

$deleteAntrian = "DELETE FROM tbl_antrian_obat WHERE id = :id";
$stmt = $conn->prepare($deleteAntrian);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    $_SESSION['berhasil_hapus'] = 'No antrian ke ' . $noAntrian['no_antrian'] . ' berhasil di hapus.';
    header("Location: hapus_antrian.php");
}
