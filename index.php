<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>UNIBOOKSTORE | Home</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar">
  <div class="navbar-container">
    <div class="navbar-left">UNIBOOKSTORE</div>
    <ul class="navbar-right">
      <li><a href="index.php">Home</a></li>
      <li><a href="admin.php">Admin</a></li>
      <li><a href="pengadaan.php">Pengadaan</a></li>
    </ul>
  </div>
</nav>

<div class="container">
  <h2>Daftar Buku</h2>
  <form method="GET" class="form-crud">
    <input type="text" name="search" placeholder="Cari Nama Buku..." required>
    <button type="submit" class="btn btn-add">Cari</button>
  </form>

  <table class="styled-table">
    <thead>
      <tr>
        <th>ID Buku</th>
        <th>Nama Buku</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Penerbit</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $keyword = isset($_GET['search']) ? $_GET['search'] : '';
        $query = $mysqli->query("SELECT b.*, p.nama AS penerbit FROM buku b 
                                 JOIN penerbit p ON b.id_penerbit=p.id_penerbit 
                                 WHERE b.nama LIKE '%$keyword%' ORDER BY b.id_buku");
        while ($row = $query->fetch_assoc()) {
          echo "<tr>
                  <td>{$row['id_buku']}</td>
                  <td>{$row['nama']}</td>
                  <td>{$row['kategori']}</td>
                  <td>Rp" . number_format($row['harga'], 0, ',', '.') . "</td>
                  <td>{$row['stok']}</td>
                  <td>{$row['penerbit']}</td>
                </tr>";
        }
      ?>
    </tbody>
  </table>
</div>
</body>
</html>
