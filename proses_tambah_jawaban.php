<?php
include 'koneksi.php';

$id_responden = $_POST['id_responden'];
$id_parameter = $_POST['id_parameter'];

mysqli_query($koneksi, "INSERT INTO jawaban_responden (id_responden, id_parameter) VALUES ('$id_responden', '$id_parameter')");

header("Location: view_keputusan.php");
