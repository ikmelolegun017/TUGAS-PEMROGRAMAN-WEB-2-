<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Keputusan</title>
    <style>
        /* style.css - Untuk halaman Data Keputusan */

/* ===== GLOBAL STYLE ===== */
body {
    margin: 0;
    padding: 40px 20px;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to right, #c6ffdd, #fbd786, #f7797d);
    color: #333;
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
}

/* ===== HEADER ===== */
h2 {
    font-size: 2.5rem;
    margin-bottom: 30px;
    color: #2d3436;
    font-weight: 600;
    text-align: center;
}

/* ===== TABLE STYLE ===== */
table {
    width: 100%;
    max-width: 1100px;
    border-collapse: collapse;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    background-color: white;
}

table thead {
    background: linear-gradient(to right, #6366f1, #60a5fa);
    color: #fff;
}

table th, table td {
    padding: 16px 20px;
    text-align: left;
    font-size: 1rem;
    transition: background 0.3s ease;
}

table th {
    font-weight: 600;
}

table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tbody tr:hover {
    background-color: #eef6ff;
}

/* ===== RESPONSIVE DESIGN ===== */
@media screen and (max-width: 768px) {
    table, thead, tbody, th, td, tr {
        display: block;
    }

    table thead {
        display: none;
    }

    table tbody tr {
        margin-bottom: 15px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        background-color: #fff;
        padding: 10px;
    }

    table td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 16px;
        font-size: 0.95rem;
        border-bottom: 1px solid #eee;
    }

    table td::before {
        content: attr(data-label);
        font-weight: 600;
        color: #666;
        width: 40%;
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
.btn {
    display: inline-block;
    padding: 8px 16px;
    margin: 2px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    border-radius: 6px;
    transition: background-color 0.3s ease, transform 0.2s ease;
    color: white;
    text-align: center;
}

.btn:hover {
    transform: scale(1.05);
}

/* Tombol Edit */
.btn-edit {
    background-color: #3498db;
}

.btn-edit:hover {
    background-color: #2980b9;
}

/* Tombol Hapus */
.btn-hapus {
    background-color: #e74c3c;
}

.btn-hapus:hover {
    background-color: #c0392b;
}





    </style>
</head>
<br><br>
<div style="text-align: center;">
    <a href="index.php" class="back-button">← Beranda</a>
</div>

<body>
    <h2>Data Keputusan</h2>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Responden</th>
            <th>NIM</th>
            <th>Jurusan</th>
            <th>Parameter</th>
            <th>Nilai Parameter</th>
            <th>Nilai Jawaban</th>
            <th>Aksi</th>
        </tr>

<?php
$sql = "SELECT j.id AS id_jawaban, r.nama, r.nim, r.jurusan, 
            p.nama_parameter, p.nilai_parameter, j.nilai_jawaban
        FROM jawaban j
        JOIN responden r ON j.responden_id = r.id
        JOIN parameter p ON j.parameter_id = p.id";

$result = $conn->query($sql);
$no = 1;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td data-label='No'>$no</td>
                <td>{$row['nama']}</td>
                <td>{$row['nim']}</td>
                <td>{$row['jurusan']}</td>
                <td>{$row['nama_parameter']}</td>
                <td>{$row['nilai_parameter']}</td>
                <td>{$row['nilai_jawaban']}</td>
                <td>
                    <a class='btn btn-edit' href='edit_jawaban.php?id={$row['id_jawaban']}'>Edit</a>
                    <a class='btn btn-hapus' href='hapus_jawaban.php?id={$row['id_jawaban']}' onclick=\"return confirm('Yakin ingin menghapus data ini?');\">Hapus</a>
                </td>
              </tr>";
        $no++;
    }
} else {
    echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
}
?>
    </table>
    
</body>
</html>
