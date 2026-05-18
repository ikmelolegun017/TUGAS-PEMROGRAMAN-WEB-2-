<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Data Parameter</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header>
    <h1>Data Parameter</h1>
  </header>

  <main>
    <table>
      <thead>
        <tr>
          <th>Nama Parameter</th>
          <th>Deskripsi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $data = mysqli_query($conn, "SELECT * FROM parameter");
        while ($d = mysqli_fetch_assoc($data)) {
          echo "<tr>
            <td>{$d['nama_parameter']}</td>
            <td>{$d['deskripsi']}</td>
          </tr>";
        }
        ?>
      </tbody>
    </table>
  </main>
</body>
</html>
