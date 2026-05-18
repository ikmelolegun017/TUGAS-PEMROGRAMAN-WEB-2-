<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus 1 parameter berdasarkan ID-nya
    $query = "DELETE FROM parameter WHERE id_parameter = '$id'";
    $result = $conn->query($query);

    if ($result) {
        header("Location: view_keputusan.php");
        exit();
    } else {
        echo "Gagal menghapus parameter.";
    }
} else {
    echo "ID parameter tidak ditemukan.";
}
?>
