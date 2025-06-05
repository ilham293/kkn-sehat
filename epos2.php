<?php
session_start();
include "konek.php";

// Proses simpan data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $tinggi = $_POST['tinggi'];
    $berat = $_POST['berat'];
    $tensi = $_POST['tensi'];
    $lingkar_perut = $_POST['lingkar_perut'];
    $lingkar_lengan = $_POST['lingkar_lengan'];

    $sql = "INSERT INTO epos (nama, tinggi, berat, tensi, lingkar_perut, lingkar_lengan)
            VALUES ('$nama', '$tinggi', '$berat', '$tensi', '$lingkar_perut', '$lingkar_lengan')";
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil disimpan ke database.');</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kalkulator IMT</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      max-width: 500px;
      margin: auto;
      background-color: #f4f4f4;
    }
    h2 {
      text-align: center;
    }
    input, button {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
      box-sizing: border-box;
    }
    .output {
      margin-top: 20px;
      font-weight: bold;
      background-color: #e0ffe0;
      padding: 10px;
      border: 1px solid #ccc;
    }
  </style>
</head>
<body>
  <h2>Kalkulator IMT (Indeks Massa Tubuh)</h2>

  <!-- Form Input -->
  <form method="post">
    <label>Nama:</label>
    <input type="text" name="nama" id="nama" required>

    <label>Berat Badan (kg):</label>
    <input type="number" name="berat" id="berat" step="0.1" required>

    <label>Tinggi Badan (m):</label>
    <input type="number" name="tinggi" id="tinggi" step="0.01" required>

    <label>Tensi:</label>
    <input type="text" name="tensi" id="tensi" required>

    <label>Lingkar Perut (cm):</label>
    <input type="text" name="lingkar_perut" id="lingkar_perut" required>

    <label>Lingkar Lengan (cm):</label>
    <input type="text" name="lingkar_lengan" id="lingkar_lengan" required>

    <button type="button" onclick="hitungIMT()">Hitung IMT</button>
    <button type="submit">Simpan ke Database</button>
  </form>

  <div class="output" id="hasil"></div>

  <script>
    function hitungIMT() {
      const nama = document.getElementById("nama").value.trim();
      const berat = parseFloat(document.getElementById("berat").value);
      const tinggi = parseFloat(document.getElementById("tinggi").value);
      const hasil = document.getElementById("hasil");

      if (nama === "" || isNaN(berat) || isNaN(tinggi) || berat <= 0 || tinggi <= 0) {
        hasil.innerText = "Silakan isi nama, berat, dan tinggi dengan benar.";
        return;
      }

      const imt = berat / (tinggi * tinggi);
      let kategori = "";

      if (imt < 18.5) {
        kategori = "Kurus";
      } else if (imt < 25) {
        kategori = "Normal / Ideal";
      } else if (imt < 30) {
        kategori = "Gemuk";
      } else {
        kategori = "Obesitas";
      }

      hasil.innerText = `Halo, ${nama}! IMT Anda: ${imt.toFixed(2)} – ${kategori}`;
    }
  </script>
</body>
</html>
