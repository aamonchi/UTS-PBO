<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <tittle><h1>Toko ATK Ajeng</h1></tittle>
    <style>
        table {
            width: 20%;
            border-collapse: collapse;
            margin: 12px auto;
            font-family: Arial, sans-serif;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #c08552; /* Warna latar belakang header */
            color: white; /* Warna teks header */
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; /* Warna latar belakang baris genap */
        }

        tr:hover {
            background-color: #ddd; /* Warna saat mouse hover */
        }

        td {
            background-color: #ffffff; /* Warna latar belakang sel */
        }

        td:nth-child(2) {
            text-align: center; /* Rata tengah untuk kolom usia */
        }

        td:last-child {
            font-weight: bold; /* Membuat teks di kolom terakhir menjadi tebal */
        }
    </style>

</head>
<body>
<table border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th><strong>Id Barang</strong></th>
        <th><strong>Nama Barang</strong></th>
        <th><strong>Stok</strong></th>
        <th><strong>Harga Beli</strong></th>
        <th><strong>Harga Jual</strong></th>
    </tr>
    <tr>
        <td>1</td>
        <td>Penggaris</td>
        <td>10</td>
        <td>3000</td>
        <td>5000</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Pulpen</td>
        <td>15</td>
        <td>5000</td>
        <td>7000</td>  
    </tr>
    <tr>
        <td>3</td>
        <td>Penghapus</td>
        <td>24</td>
        <td>2000</td>
        <td>3000</td>
    </tr>
    <tr>
        <td>4</td>
        <td>Pensil</td>
        <td>30</td>
        <td>4000</td>
        <td>5000</td>
    </tr>
    <tr>
        <td>5</td>
        <td>Tempat Pensil</td>
        <td>10</td>
        <td>15000</td>
        <td>20000</td>
    </tr>
</table>
<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ajengdb";  // Nama database yang sudah Anda buat di phpMyAdmin

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menambahkan data barang
if (isset($_POST['add'])) {
    $nama_barang = $_POST['nama_barang'];
    $stok = $_POST['stok'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    
    $stmt = $conn->prepare("INSERT INTO tbl_ajengstok (nama_barang, stok, harga_beli, harga_jual) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sidd", $nama_barang, $stok, $harga_beli, $harga_jual);
    $stmt->execute();
    header("Location: index.php");
}

// Menghapus data barang
if (isset($_GET['delete'])) {
    $id_barang = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM tbl_ajengstok WHERE id_barang=?");
    $stmt->bind_param("i", $id_barang);
    $stmt->execute();
    header("Location: index.php");
}

// Mengambil data barang untuk ditampilkan
$sql = "SELECT * FROM tbl_ajengstok";
$barang = $conn->query($sql);

// Mengedit data barang
if (isset($_GET['edit'])) {
    $id_barang = $_GET['edit'];
    $result = $conn->query("SELECT * FROM tbl_ajengstok WHERE id_barang=$id_barang");
    $barang_edit = $result->fetch_assoc();
}

if (isset($_POST['edit_data'])) {
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $stok = $_POST['stok'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    
    $stmt = $conn->prepare("UPDATE tbl_ajengstok SET nama_barang=?, stok=?, harga_beli=?, harga_jual=? WHERE id_barang=?");
    $stmt->bind_param("siddi", $nama_barang, $stok, $harga_beli, $harga_jual, $id_barang);
    $stmt->execute();
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Barang - Tabel Stok</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffd662;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #5e3023;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ffbf00;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #895737;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #ffc0bf;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #7f4f24;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        a {
            color: #ebad31;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tabel Stok</h1>

        <!-- Formulir untuk menambah barang -->
        <form method="POST">
            <h2>Tambah Data Barang</h2>
            <input type="text" name="nama_barang" placeholder="Nama Barang" required>
            <input type="number" name="stok" placeholder="Stok" required>
            <input type="number" name="harga_beli" placeholder="Harga Beli" required step="0.01">
            <input type="number" name="harga_jual" placeholder="Harga Jual" required step="0.01">
            <button type="submit" name="add">Tambah Barang</button>
        </form>

        <!-- Tabel untuk menampilkan data barang -->
        <h2>Daftar Barang</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $barang->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_barang']; ?></td>
                    <td><?php echo $row['nama_barang']; ?></td>
                    <td><?php echo $row['stok']; ?></td>
                    <td><?php echo $row['harga_beli']; ?></td>
                    <td><?php echo $row['harga_jual']; ?></td>
                    <td>
                        <a href="?edit=<?php echo $row['id_barang']; ?>">Edit</a> |
                        <a href="?delete=<?php echo $row['id_barang']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <?php if (isset($barang_edit)): ?>
        <!-- Formulir untuk mengedit data barang -->
        <form method="POST">
            <h2>Edit Data Barang</h2>
            <input type="hidden" name="id_barang" value="<?php echo $barang_edit['id_barang']; ?>">
            <input type="text" name="nama_barang" value="<?php echo $barang_edit['nama_barang']; ?>" required>
            <input type="number" name="stok" value="<?php echo $barang_edit['stok']; ?>" required>
            <input type="number" name="harga_beli" value="<?php echo $barang_edit['harga_beli']; ?>" required step="0.01">
            <input type="number" name="harga_jual" value="<?php echo $barang_edit['harga_jual']; ?>" required step="0.01">
            <button type="submit" name="edit_data">Simpan Perubahan</button>
        </form>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
// Menutup koneksi
$conn->close();
?>

</body>
</html>


</html> 