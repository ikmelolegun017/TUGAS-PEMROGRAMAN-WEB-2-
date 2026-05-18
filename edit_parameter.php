<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    echo "ID parameter tidak ditemukan.";
    exit;
}

$id = $_GET['id'];

// Ambil data parameter berdasarkan ID
$query = "SELECT * FROM parameter WHERE id_parameter = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Parameter tidak ditemukan.";
    exit;
}

$data = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama_parameter'];
    $nilai = $_POST['nilai_parameter'];

    $update = $conn->prepare("UPDATE parameter SET nama_parameter = ?, nilai_parameter = ? WHERE id_parameter = ?");
    $update->bind_param("ssi", $nama, $nilai, $id);
    $update->execute();

    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Parameter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4 text-center text-primary">✏️ Edit Parameter</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nama Parameter</label>
            <input type="text" name="nama_parameter" class="form-control" value="<?= htmlspecialchars($data['nama_parameter']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nilai Parameter</label>
            <input type="text" name="nilai_parameter" class="form-control" value="<?= htmlspecialchars($data['nilai_parameter']) ?>" required>
        </div>
        <button type="submit" class="btn btn-success">💾 Simpan Perubahan</button>
        <a href="javascript:history.back()" class="btn btn-secondary">← Kembali</a>
    </form>
</div>
</body>
</html>
