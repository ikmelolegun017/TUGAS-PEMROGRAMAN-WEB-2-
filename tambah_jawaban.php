<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Jawaban</title>
    <style>
        /* style.css (tambahan untuk halaman tambah_jawaban.php) */

body {
    background: linear-gradient(to right, #c6ffdd, #fbd786, #f7797d);
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 40px;
    min-height: 100vh;
}

h2 {
    font-size: 2rem;
    margin-bottom: 30px;
    color: #222;
    text-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
}

form {
    background: white;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 550px;
    display: flex;
    flex-direction: column;
    gap: 18px;
}

label {
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
}

input {
    border-radius: 8px; /* ganti dari 20px atau 30px jadi 8px */
    padding: 10px 15px;
    font-size: 16px;
    width: 100%;
    border: 1px solid #ccc;
    box-sizing: border-box;
}


select,
input[type="number"] {
    padding: 12px 15px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 1rem;
    transition: all 0.3s ease;
    width: 100%;
}

select:focus,
input[type="number"]:focus {
    border-color: #74b9ff;
    box-shadow: 0 0 6px rgba(116, 185, 255, 0.5);
    outline: none;
}

button[type="submit"] {
    padding: 12px 20px;
    background: linear-gradient(to right, #2980b9, #6dd5fa);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

button[type="submit"]:hover {
    background: linear-gradient(to right, #2575fc, #6a82fb);
    transform: translateY(-2px);
}

@media (max-width: 600px) {
    form {
        padding: 20px;
    }

    h2 {
        font-size: 1.5rem;
    }
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
    <h2>Input Jawaban Responden</h2>
    <form method="post" action="">
        <label>Responden:</label>
        <select name="responden_id" required>
            <option value="">-- Pilih Responden --</option>
            <?php
            $result = $conn->query("SELECT id, nama FROM responden");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['nama']}</option>";
            }
            ?>
        </select><br><br>

        <label>Parameter:</label>
        <select name="parameter_id" required>
            <option value="">-- Pilih Parameter --</option>
            <?php
            $result = $conn->query("SELECT id, nama_parameter FROM parameter");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['nama_parameter']}</option>";
            }
            ?>
        </select><br><br>

        <input type="number" step="0.01" name="nilai_jawaban" placeholder="Nilai Jawaban" required>
        <button type="submit" name="submit">Simpan</button>

                <br><br>
<div style="text-align: center;">
    <a href="index.php" class="back-button">←  Beranda</a>
</div>


    </form>

<?php
if (isset($_POST['submit'])) {
    $stmt = $conn->prepare("INSERT INTO jawaban (responden_id, parameter_id, nilai_jawaban) VALUES (?, ?, ?)");
    $stmt->bind_param("iid", $_POST['responden_id'], $_POST['parameter_id'], $_POST['nilai_jawaban']);
    if ($stmt->execute()) {
        echo "Jawaban berhasil disimpan.";
    } else {
        echo "Gagal: " . $stmt->error;
    }
}
?>
</body>
</html>
