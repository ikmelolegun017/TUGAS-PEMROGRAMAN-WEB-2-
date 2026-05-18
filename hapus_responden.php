<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data parameter yang terkait (jika pakai relasi manual)
    $conn->query("DELETE FROM parameter WHERE id_responden = '$id'");

    // Hapus data responden
    $conn->query("DELETE FROM responden WHERE id_responden = '$id'");
    

    header("Location: view_keputusan.php");
    exit();
} else {
    echo "ID tidak ditemukan.";
}

?>
