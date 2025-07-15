<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>UNIBOOKSTORE | Pengadaan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-left">Pengadaan Buku</div>
            <ul class="navbar-right">
                <li><a href="index.php">Home</a></li>
                <li><a href="admin.php">Admin</a></li>
                <li><a href="pengadaan.php">Pengadaan</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2>Daftar Stok Buku</h2>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Nama Buku</th>
                    <th>Penerbit</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php
      $query = $mysqli->query("SELECT b.nama, p.nama AS penerbit, b.stok 
                               FROM buku b JOIN penerbit p ON b.id_penerbit = p.id_penerbit 
                               WHERE b.stok <= 15 ORDER BY b.stok ASC");
      while ($row = $query->fetch_assoc()) {
        echo "<tr>
                <td>{$row['nama']}</td>
                <td>{$row['penerbit']}</td>
                <td>{$row['stok']}</td>
              </tr>";
      }
      ?>
            </tbody>
        </table>
    </div>
</body>

</html>