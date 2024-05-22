<?php 
include 'func.php'; 
$karyawan = query('SELECT * FROM karyawan');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dataKaryawan</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <a href="tambah.php" class="tambahBtn">Tambah Data Karyawan</a> <!-- Tombol Tambah Karyawan -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>UID</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Gaji Pokok</th>
                    <th>Transport</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                $i = 1;
                foreach ($karyawan as $row) :
                ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['uid'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['jabatan'] ?></td>
                    <td><?= formatRupiah($row['gaji']) ?></td>
                    <td><?= formatRupiah($row['transport']) ?></td>
                    <td>
                        <a href="ubah_data.php?id=<?= $row['id'] ?>">Ubah</a> /
                        <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Apakah anda ingin menghapus data ini?')" >Hapus</a>
                    </td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
