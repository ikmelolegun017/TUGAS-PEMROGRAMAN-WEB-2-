<?php
include 'koneksi.php';

// Tambah atau Update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $fakultas = $_POST['fakultas'];
    $angkatan = $_POST['angkatan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $email = $_POST['email'];

    if (isset($_POST['id_responden']) && $_POST['id_responden'] != '') {
        // Update data
        $id = $_POST['id_responden'];
        $stmt = $conn->prepare("UPDATE responden SET nama=?, nim=?, jurusan=?, fakultas=?, angkatan=?, jenis_kelamin=?, email=? WHERE id_responden=?");
        $stmt->bind_param("ssssissi", $nama, $nim, $jurusan, $fakultas, $angkatan, $jenis_kelamin, $email, $id);
    } else {
        // Insert data
        $stmt = $conn->prepare("INSERT INTO responden (nama, nim, jurusan, fakultas, angkatan, jenis_kelamin, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssiss", $nama, $nim, $jurusan, $fakultas, $angkatan, $jenis_kelamin, $email);
    }
    $stmt->execute();
    $stmt->close();
    header("Location: responden.php");
    exit();
}

// Hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM responden WHERE id_responden=$id");
    header("Location: responden.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Responden</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold">Daftar Responden</h2>
      <div>
          <a href="index.php" class="btn btn-secondary me-2">← Beranda</a>
          <button class="btn btn-success" data-bs-toggle="modal" data-bs-     target="#formModal">+ Tambahkan Responden</button>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Jurusan</th>
            <th>Fakultas</th>
            <th>Angkatan</th>
            <th>Jenis Kelamin</th>
            <th>Email</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $result = $conn->query("SELECT * FROM responden");
          if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                          <td>{$row['id_responden']}</td>
                          <td>{$row['nama']}</td>
                          <td>{$row['nim']}</td>
                          <td>{$row['jurusan']}</td>
                          <td>{$row['fakultas']}</td>
                          <td>{$row['angkatan']}</td>
                          <td>{$row['jenis_kelamin']}</td>
                          <td>{$row['email']}</td>
                          <td>
                            <button class='btn btn-sm btn-warning btn-edit' 
                              data-id='{$row['id_responden']}'
                              data-nama='{$row['nama']}'
                              data-nim='{$row['nim']}'
                              data-jurusan='{$row['jurusan']}'
                              data-fakultas='{$row['fakultas']}'
                              data-angkatan='{$row['angkatan']}'
                              data-jenis_kelamin='{$row['jenis_kelamin']}'
                              data-email='{$row['email']}'
                              data-bs-toggle='modal' data-bs-target='#formModal'>Edit</button>
                            <a href='?hapus={$row['id_responden']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Yakin hapus data?\")'>Hapus</a>
                          </td>
                        </tr>";
              }
          } else {
              echo "<tr><td colspan='9' class='text-center text-muted'>Belum ada data responden.</td></tr>";
          }

          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Form Tambah/Edit -->
  <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form method="POST" class="modal-content">
        <input type="hidden" name="id_responden" id="id_responden">
        <div class="modal-header">
          <h5 class="modal-title" id="formModalLabel">Form Responden</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <input type="text" name="nama" id="nama" class="form-control mb-2" placeholder="Nama" required>
          <input type="text" name="nim" id="nim" class="form-control mb-2" placeholder="NIM" required>
          <input type="text" name="jurusan" id="jurusan" class="form-control mb-2" placeholder="Jurusan" required>
          <input type="text" name="fakultas" id="fakultas" class="form-control mb-2" placeholder="Fakultas" required>
          <input type="number" name="angkatan" id="angkatan" class="form-control mb-2" placeholder="Angkatan" required>
          <select name="jenis_kelamin" id="jenis_kelamin" class="form-control mb-2" required>
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
          <input type="email" name="email" id="email" class="form-control mb-2" placeholder="Email" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>

           <br><br>
<div style="text-align: center;">
    <a href="index.php" class="back-button">←  Beranda</a>
</div>

      </form>
    </div>
  </div>

  <!-- Script Bootstrap dan Isi Modal Edit -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.querySelectorAll('.btn-edit').forEach(button => {
      button.addEventListener('click', () => {
        document.getElementById('id_responden').value = button.dataset.id;
        document.getElementById('nama').value = button.dataset.nama;
        document.getElementById('nim').value = button.dataset.nim;
        document.getElementById('jurusan').value = button.dataset.jurusan;
        document.getElementById('fakultas').value = button.dataset.fakultas;
        document.getElementById('angkatan').value = button.dataset.angkatan;
        document.getElementById('jenis_kelamin').value = button.dataset.jenis_kelamin;
        document.getElementById('email').value = button.dataset.email;
      });
    });
  </script>
</body>
</html>
