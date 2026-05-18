<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Input Responden</title>
    <style>
     /* style.css (lanjutan atau sama dengan yang digunakan sebelumnya) */

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
    color: #333;
}

form {
    background: white;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 500px;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

input[type="text"],
input[type="email"],
select {
    padding: 12px 15px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 1rem;
    width: 100%;
    transition: border 0.3s, box-shadow 0.3s;
}

input[type="text"]:focus,
input[type="email"]:focus,
select:focus {
    border-color: #8e2de2;
    box-shadow: 0 0 5px rgba(142, 45, 226, 0.4);
    outline: none;
}

button[type="submit"] {
    padding: 12px 20px;
    background: linear-gradient(to right, #8e2de2, #4a00e0);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 1rem;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s;
}

button[type="submit"]:hover {
    background: linear-gradient(to right, #7b1fa2, #3700b3);
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
form {
    width: 100%;
    max-width: 600px; /* batas lebar form */
    margin: auto;
    background: #fff;
    padding: 30px;
    border-radius: 15px; /* tidak terlalu bulat */
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

input, select, textarea {
    width: 100%;
    padding: 12px 15px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 8px; /* sudut lebih lembut */
    font-size: 16px;
    box-sizing: border-box;
}

input:focus, select:focus {
    outline: none;
    border-color: #6c63ff;
    box-shadow: 0 0 5px rgba(108, 99, 255, 0.5);
}



     </style>
</head>
<body>
    <h2>Form Tambah Responden</h2>
    <form method="post" action="">
        <input type="text" name="nama" placeholder="Nama" required><br>
        <input type="text" name="nim" placeholder="NIM" required><br>
        <input type="text" name="jurusan" placeholder="Jurusan" required><br>
        <input type="text" name="fakultas" placeholder="Fakultas" required><br>
        <input type="text" name="angkatan" placeholder="Angkatan" required><br>
        <select name="jenis_kelamin" required>
            <option value="">Pilih Jenis Kelamin</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <button type="submit" name="submit">Simpan</button>

         <br><br>
<div style="text-align: center;">
    <a href="index.php" class="back-button">←  Beranda</a>
</div>

    </form>

<?php
if (isset($_POST['submit'])) {
    $stmt = $conn->prepare("INSERT INTO responden (nama, nim, jurusan, fakultas, angkatan, jenis_kelamin, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $_POST['nama'], $_POST['nim'], $_POST['jurusan'], $_POST['fakultas'], $_POST['angkatan'], $_POST['jenis_kelamin'], $_POST['email']);
    if ($stmt->execute()) {
        echo "Data responden berhasil disimpan.";
    } else {
        echo "Gagal menyimpan: " . $stmt->error;
    }
}
?>
</body>
</html>
