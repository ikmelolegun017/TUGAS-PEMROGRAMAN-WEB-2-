<?php
include 'koneksi.php';

// Ambil data jawaban berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM jawaban WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
}

// Update jika form disubmit
if (isset($_POST['update'])) {
    $responden_id = $_POST['responden_id'];
    $parameter_id = $_POST['parameter_id'];
    $nilai_jawaban = $_POST['nilai_jawaban'];
    $id = $_POST['id'];

    $stmt = $conn->prepare("UPDATE jawaban SET responden_id=?, parameter_id=?, nilai_jawaban=? WHERE id=?");
    $stmt->bind_param("iidi", $responden_id, $parameter_id, $nilai_jawaban, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui'); window.location.href='view_keputusan.php';</script>";
    } else {
        echo "Gagal update: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Jawaban</title>
    <<style>
        /* Reset dasar */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    background: #f5f7fa;
    padding: 30px;
    color: #333;
}

/* Judul Halaman */
h2 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 20px;
}

/* Form styling */
form {
    max-width: 500px;
    margin: 0 auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

form label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #34495e;
}

form input[type="text"],
form input[type="number"],
form input[type="email"],
form select {
    width: 100%;
    padding: 10px 15px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    transition: border 0.3s ease;
}

form input:focus,
form select:focus {
    border-color: #3498db;
    outline: none;
}

/* Tombol Simpan */
button[type="submit"] {
    background: #3498db;
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s ease;
    font-size: 16px;
}

button[type="submit"]:hover {
    background: #2980b9;
}

.back-button {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #ff0000ff;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.back-button:hover {
    background-color: #7f8c8d;
}


    </style>
</head>
<body>
    <h2>Edit Jawaban Responden</h2>
    
    <form method="post" action="">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <label>Responden:</label>
        <select name="responden_id" required>
            <?php
            $responden = $conn->query("SELECT id, nama FROM responden");
            while ($r = $responden->fetch_assoc()) {
                $selected = ($r['id'] == $data['responden_id']) ? 'selected' : '';
                echo "<option value='{$r['id']}' $selected>{$r['nama']}</option>";
            }
            ?>
        </select><br><br>

        <label>Parameter:</label>
        <select name="parameter_id" required>
            <?php
            $parameter = $conn->query("SELECT id, nama_parameter FROM parameter");
            while ($p = $parameter->fetch_assoc()) {
                $selected = ($p['id'] == $data['parameter_id']) ? 'selected' : '';
                echo "<option value='{$p['id']}' $selected>{$p['nama_parameter']}</option>";
            }
            ?>
        </select><br><br>
        

        <input type="number" step="0.01" name="nilai_jawaban" placeholder="Nilai Jawaban" value="<?= $data['nilai_jawaban'] ?>" required>
        <button type="submit" name="update">Simpan Perubahan</button>
        <br><br>
<div style="text-align: center;">
    <a href="index.php" class="back-button">←  Beranda</a>
</div>

    </form>
</body>
</html>
