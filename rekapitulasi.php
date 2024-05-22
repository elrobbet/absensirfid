<?php
include 'func.php';

// Ambil nilai bulan dan tahun dari input bulan dan tahun
if(isset($_GET['bulan']) && isset($_GET['tahun'])){
    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];
} else {
    // Jika bulan dan tahun tidak diset, maka gunakan bulan dan tahun saat ini
    $bulan = date('m');
    $tahun = date('Y');
}

// Modifikasi query SQL untuk memfilter data berdasarkan bulan dan tahun
$karyawan = query("SELECT * FROM karyawan WHERE MONTH(tanggal) = $bulan AND YEAR(tanggal) = $tahun");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi</title>
</head>
<body>
    <?php include 'navbar.php' ?>

    <div class="container">

    <form>
        <label for="bulan">Pilih Bulan:</label>
        <select id="bulan" name="bulan">
            <?php for($i = 1; $i <= 12; $i++): ?>
                <option value="<?= $i ?>" <?= ($i == $bulan) ? 'selected' : '' ?>><?= date("F", mktime(0, 0, 0, $i, 1)) ?></option>
            <?php endfor; ?>
        </select>
<br>
        <label for="tahun">Pilih Tahun:</label>
        <select id="tahun" name="tahun">
            <?php for($i = date('Y'); $i >= 1970; $i--): ?>
                <option value="<?= $i ?>" <?= ($i == $tahun) ? 'selected' : '' ?>><?= $i ?></option>
            <?php endfor; ?>
        </select>

        <input type="submit" value="Submit">
    </form>
    
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>H</th>
                    <th>I</th>
                    <th>S</th>
                    <th>A</th>
                    <th>T</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                $i = 1;
                foreach ($karyawan as $row) :
                ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['jabatan'] ?></td>
                    <td>30</td>
                    <td><?= $row['izin'] ?></td>
                    <td><?= $row['sakit'] ?></td>
                    <td><?= $row['alfa'] ?></td>
                    <td><?= $row['terlambat'] ?></td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
