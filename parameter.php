


<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Parameter</title>
    <style>
        /* style.css (lanjutan jika sudah ada) */

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
    max-width: 500px;
    display: flex;
    flex-direction: column;
    gap: 18px;
}

input[type="text"],
input[type="number"] {
    padding: 12px 15px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 1rem;
    transition: all 0.3s ease;
}

input[type="text"]:focus,
input[type="number"]:focus {
    border-color: #ff7e5f;
    box-shadow: 0 0 6px rgba(255, 126, 95, 0.4);
    outline: none;
}

button[type="submit"] {
    padding: 12px 20px;
    background: linear-gradient(to right, #f76b1c, #ffb347);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

button[type="submit"]:hover {
    background: linear-gradient(to right, #ff7e5f, #feb47b);
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
    background-color: #ff5e00ff;
}


    </style>
</head>
<body>
    <h2>Input Parameter</h2>
    <form method="post" action="">
        <input type="text" name="nama_parameter" placeholder="Nama Parameter" required>
        <input type="number" step="0.01" name="nilai_parameter" placeholder="Nilai Parameter" required>
        <button type="submit" name="simpan">Simpan</button>

        <br><br>
<div style="text-align: center;">
    <a href="index.php" class="back-button">←  Beranda</a>
</div>


    </form>

<?php
if (isset($_POST['simpan'])) {
    $stmt = $conn->prepare("INSERT INTO parameter (nama_parameter, nilai_parameter) VALUES (?, ?)");
    $stmt->bind_param("sd", $_POST['nama_parameter'], $_POST['nilai_parameter']);
    if ($stmt->execute()) {
        echo "Parameter berhasil disimpan.";
    } else {
        echo "Gagal menyimpan: " . $stmt->error;
    }
}
?>
</body>
</html>
