<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css"/>

    <title>Beranda</title>
    <style>

body {
  background: url('img/ta.jpg') no-repeat center center fixed;
  background-size: cover;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  margin: 0;
  padding: 40px 20px;
  font-family: 'Montserrat', sans-serif;
}


main {
  flex: 1; /* Supaya bagian ini mengisi ruang yang tersedia */
}

  .biodata-button {
  position: absolute;
  top: 20px;
  right: 20px;
  background-color: #6200ea; /* ungu solid */
  color: white;
  border: none;
  padding: 10px 18px;
  font-size: 14px;
  font-weight: bold;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  cursor: pointer;
  transition: background-color 0.2s ease;
  z-index: 10; /* pastikan tampil di atas background/gambar */
}


.main-content {
  text-align: center;
}

.biodata-button:hover {
  background-color: #3700b3; /* ungu lebih gelap saat hover */
}


.menu-container {
    margin-top: +180px; /* geser ke atas, ubah nilainya sesuai kebutuhan */
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}
.menu-link {
    padding: 12px 24px;
    background-color: #7e57c2; /* ungu lembut */
    color: white;
    text-decoration: none;
    border-radius: 12px;
    font-weight: bold;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

.menu-link:hover {
    background-color: #5e35b1; /* ungu gelap saat hover */
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.3);
}
h2 {
  font-size: 2.5rem;
  color: white;
  background: rgba(0, 0, 0, 0.4); /* semi-transparan */
  padding: 16px 32px;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
  margin-bottom: 40px;
  text-align: center;
}


.footer {
  text-align: center;
  color: white;
  margin-top: auto;
  padding: 20px;
  font-weight: bold;
  
}





    </style>
    
</head>
<body>

  <button onclick="window.location.href='logout.php'" class="biodata-button">
    Logout
</button>


  <main class="main-content">
    <h2>Tata Kelola Kebijakan Pangan</h2>
    <div class="menu-container">
        <a href="input_responden.php" class="menu-link">Input Responden</a>
        <a href="parameter.php" class="menu-link">Input Parameter</a>
        <a href="tambah_jawaban.php" class="menu-link">Input Jawaban</a>
        <a href="view_keputusan.php" class="menu-link">Lihat Data Keputusan</a>
    </div>
</main>
    <div class="footer">
        &copy; <?= date("Y") ?> Sistem Responden • Universitas Mandiri
    </div>
</body>
</html>
