<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Data Responden</title>
  <link rel="stylesheet" href="style.css"/>
</head>
<body>
  <header>
    <h1>Data Responden</h1>
  </header>

  <main>
    <table>
      <thead>
        <tr>
          <th>Nama</th>
          <th>NIM</th>
          <th>Jurusan</th>
          <th>Fakultas</th>
          <th>Angkatan</th>
          <th>Jenis Kelamin</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $data = mysqli_query($conn, "SELECT * FROM responden");
        while ($d = mysqli_fetch_assoc($data)) {
          echo "<tr>
            <td>{$d['nama']}</td>
            <td>{$d['nim']}</td>
            <td>{$d['jurusan']}</td>
            <td>{$d['fakultas']}</td>
            <td>{$d['angkatan']}</td>
            <td>{$d['jenis_kelamin']}</td>
            <td>{$d['email']}</td>
          </tr>";
        }
        ?>
      </tbody>
    </table>
  </main>
</body>
</html>
