<?php
include "func.php";

if (isset($_POST["submit"])) {
    // Ambil nilai dari formulir
    $uid = htmlspecialchars($_POST['uid']);
    $nama = htmlspecialchars($_POST['nama']);
    $jabatan = htmlspecialchars($_POST['jabatan']);
    $gaji = htmlspecialchars($_POST['gaji']);
    $transport = htmlspecialchars($_POST['transport']);

    $id = $_GET['id'];

    // Panggil fungsi untuk mengubah data karyawan
    if (ubahKaryawan($id, $uid, $nama, $jabatan, $gaji, $transport)) {
        echo "<script>alert('Data karyawan berhasil diubah!');</script>";
        echo "<script>window.location.href = 'dataKaryawan.php';</script>";
    } else {
        echo "<script>alert('Data karyawan gagal diubah!');</script>";
    }
}

// Ambil ID karyawan dari parameter URL
$id = $_GET['id'];

// Panggil fungsi untuk mengambil data karyawan berdasarkan ID
$karyawan = getKaryawanByID($id);

// Periksa apakah data karyawan ditemukan
if ($karyawan) {
    // Jika ditemukan, ambil nilai dari data karyawan
    $uid = $karyawan['uid'];
    $nama = $karyawan['nama'];
    $jabatan = $karyawan['jabatan'];
    $gaji = $karyawan['gaji'];
    $transport = $karyawan['transport'];
} else {
    // Jika data karyawan tidak ditemukan, tampilkan pesan error
    echo "Error: Data karyawan tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Karyawan</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="tambahForm">
    <h2>Ubah Data Karyawan</h2>
    <form action="" method="post">
        <ul>
            <li><label for="uid">UID</label>
            <input type="text" name="uid" id="uid" required value="<?php echo $uid; ?>"></li>

            <li><label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" required value="<?php echo $nama; ?>"></li>

            <li><label for="jabatan">Jabatan</label>
            <input type="text" name="jabatan" id="jabatan" required value="<?php echo $jabatan; ?>"></li>

            <li><label for="gaji">Gaji Pokok</label>
            <input type="text" name="gaji" id="gaji" required value="<?php echo $gaji; ?>"></li> 
            
            <li><label for="transport">Transport</label>
            <input type="text" name="transport" id="transport" required value="<?php echo $transport; ?>"></li>
        </ul>
        <button type="submit" name="submit">Ubah Data Karyawan</button>
    </form>
    </div>
</body>
</html>
