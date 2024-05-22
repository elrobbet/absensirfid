<?php
include 'func.php';

$current_date = date("Y-m-d");

// Ambil UID dan waktu dari tmp_uid
$data = getUIDAndTimeFromTemp();
if ($data) {
    $uid = $data['uid'];
    $time = $data['time'];
    $time2 = $data['time2'];

    // Perbarui jamMasuk atau jamKeluar di tabel karyawan
    $karyawan = query("SELECT * FROM karyawan WHERE uid='$uid' AND tanggal='$current_date'");
    if (!empty($karyawan)) {
        if (empty($karyawan[0]['jamMasuk'])) {
            updateJamMasuk($uid);
        } elseif (empty($karyawan[0]['jamKeluar']) && !empty($time2)) {
            updateJamKeluar($uid);
        }
    } else {
        tambahKaryawanBaru($uid, $time, $current_date);
    }
}

// Ambil karyawan dengan tanggal hari ini, termasuk yang baru ditambahkan
$karyawan = query("SELECT * FROM karyawan WHERE tanggal='$current_date'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hari Ini</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>id</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                $i = 1;
                foreach ($karyawan as $row) :
                ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td><?php echo date('H:i:s', strtotime($row['jamMasuk'])); ?></td>
                    <td><?php echo date('H:i:s', strtotime($row['jamKeluar'])); ?></td>
                </tr>
                <?php $i++ ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
