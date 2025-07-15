<?php
require 'config.php';

// Hapus data 
if (isset($_GET['delete']) && isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
  $id = $_GET['delete'];
  $mysqli->query("DELETE FROM buku WHERE id_buku='$id'");
  header("Location: admin.php");
  exit;
}

// ambil edit  data
$edit_data = null;
$show_edit_modal = false;
$show_delete_modal = false;

if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $result = $mysqli->query("SELECT * FROM buku WHERE id_buku='$id'");
  $edit_data = $result->fetch_assoc();
  $show_edit_modal = true;
}

if (isset($_GET['delete']) && !isset($_GET['confirm'])) {
  $show_delete_modal = true;
}

// simpan perubahan ketika tambah data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id_buku = $_POST['id_buku'];
  $nama = $_POST['nama'];
  $kategori = $_POST['kategori'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok'];
  $id_penerbit = $_POST['id_penerbit'];

  if (!empty($_POST['edit_id'])) {
    $edit_id = $_POST['edit_id'];
    $mysqli->query("UPDATE buku SET id_buku='$id_buku', nama='$nama', kategori='$kategori', harga='$harga', stok='$stok', id_penerbit='$id_penerbit' WHERE id_buku='$edit_id'");
  } else {
    $mysqli->query("INSERT INTO buku (id_buku, kategori, nama, harga, stok, id_penerbit, created_at) VALUES ('$id_buku', '$kategori', '$nama', '$harga', '$stok', '$id_penerbit', NOW())");
  }

  header("Location: admin.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>UNIBOOKSTORE | Admin</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar">
  <div class="navbar-container">
    <div class="navbar-left">Admin</div>
    <ul class="navbar-right">
      <li><a href="home.php">Home</a></li>
      <li><a href="admin.php">Admin</a></li>
      <li><a href="pengadaan.php">Pengadaan</a></li>
    </ul>
  </div>
</nav>

<div class="container">
  <h2>Tambah Buku</h2>
  <form method="POST" class="form-crud">
    <input type="hidden" name="edit_id" value="">
    <input type="text" name="id_buku" placeholder="ID Buku" required>
    <input type="text" name="nama" placeholder="Nama Buku" required>
    <input type="text" name="kategori" placeholder="Kategori" required>
    <input type="number" name="harga" placeholder="Harga" required>
    <input type="number" name="stok" placeholder="Stok" required>
    <select name="id_penerbit" required>
      <option value="">--Pilih Penerbit--</option>
      <?php
      $penerbit_result = $mysqli->query("SELECT * FROM penerbit");
      while ($p = $penerbit_result->fetch_assoc()) {
        echo "<option value='{$p['id_penerbit']}'>{$p['nama']}</option>";
      }
      ?>
    </select>
    <button type="submit" class="btn btn-add">Tambah Buku</button>
  </form>

  <h2>Daftar Buku</h2>
  <table class="styled-table">
    <thead>
      <tr>
        <th>No.</th>
        <th>ID Buku</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Penerbit</th>
        <th>Update</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $result = $mysqli->query("SELECT b.*, p.nama AS penerbit FROM buku b JOIN penerbit p ON b.id_penerbit = p.id_penerbit ORDER BY b.created_at ASC");
      $no = 1;
      while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$no}</td>
                <td>{$row['id_buku']}</td>
                <td>{$row['nama']}</td>
                <td>{$row['kategori']}</td>
                <td>Rp" . number_format($row['harga'], 0, ',', '.') . "</td>
                <td>{$row['stok']}</td>
                <td>{$row['penerbit']}</td>
                <td><a class='btn btn-update' href='?edit={$row['id_buku']}'>Edit</a></td>
                <td><a class='btn btn-delete' href='?delete={$row['id_buku']}'>Delete</a></td>
              </tr>";
        $no++;
      }
      ?>
    </tbody>
  </table>
</div>

<!-- menggunakan modal untuk edit   -->
<?php if ($show_edit_modal && $edit_data): ?>
<div class="modal">
  <div class="modal-content">
    <h3>Edit Buku</h3>
    <form method="POST">
      <input type="hidden" name="edit_id" value="<?= $edit_data['id_buku'] ?>">
      <input type="text" name="id_buku" value="<?= $edit_data['id_buku'] ?>" required>
      <input type="text" name="nama" value="<?= $edit_data['nama'] ?>" required>
      <input type="text" name="kategori" value="<?= $edit_data['kategori'] ?>" required>
      <input type="number" name="harga" value="<?= $edit_data['harga'] ?>" required>
      <input type="number" name="stok" value="<?= $edit_data['stok'] ?>" required>
      <select name="id_penerbit" required>
        <?php
        $penerbit_result = $mysqli->query("SELECT * FROM penerbit");
        while ($p = $penerbit_result->fetch_assoc()) {
          $selected = ($edit_data['id_penerbit'] === $p['id_penerbit']) ? 'selected' : '';
          echo "<option value='{$p['id_penerbit']}' $selected>{$p['nama']}</option>";
        }
        ?>
      </select>
      <div class="modal-actions">
        <button type="submit" class="btn btn-update">Simpan</button>
        <a href="admin.php" class="btn btn-cancel">Batal</a>
      </div>
    </form>
  </div>
</div>
<?php endif; ?>

<!-- menggunakan modal untuk hapus data -->
<?php if ($show_delete_modal): ?>
<div class="modal">
  <div class="modal-content">
    <h3>Hapus Buku</h3>
    <p>Yakin ingin menghapus buku dengan ID <strong><?= $_GET['delete'] ?></strong>?</p>
    <div class="modal-actions">
      <a href="admin.php?delete=<?= $_GET['delete'] ?>&confirm=yes" class="btn btn-delete">Ya, Hapus</a>
      <a href="admin.php" class="btn btn-cancel">Batal</a>
    </div>
  </div>
</div>
<?php endif; ?>
</body>
</html>
