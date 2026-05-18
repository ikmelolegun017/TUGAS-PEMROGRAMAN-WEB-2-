<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM jawaban WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil dihapus'); window.location.href='view_keputusan.php';</script>";
    } else {
        echo "Gagal menghapus: " . $stmt->error;
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
