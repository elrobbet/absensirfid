<?php
include "func.php";
if (isset($_POST["submit"])) {
$uid = $_POST['uid'];
$nama = htmlspecialchars($_POST['nama']);
$jabatan = htmlspecialchars($_POST['jabatan']);
$gaji = htmlspecialchars($_POST['gaji']);
$transport = htmlspecialchars($_POST['transport']);

if (tambahKaryawan($uid, $nama, $jabatan, $gaji, $transport)) {
echo "<script>alert('Data karyawan berhasil ditambahkan!');</script>";
echo "<script>window.location.href = 'dataKaryawan.php';</script>";
    $sqlDeleteUID = "DELETE FROM tmp_uid";
    mysqli_query($conn, $sqlDeleteUID);
} else {
echo "<script>alert('Data karyawan gagal ditambahkan!');</script>";
echo "<script>window.location.href = 'tambah.php';</script>";
    $sqlDeleteUID = "DELETE FROM tmp_uid";
    mysqli_query($conn, $sqlDeleteUID);
}
}
?> 
    <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Karyawan</title>
<link rel="stylesheet" href="css/styles.css">
<script>
    function checkUID() {
        fetch('tambah.php?action=checkUID')
            .then(response => response.json())
            .then(data => {
                if (data.uid !== 'Tidak ada UID') {
                    document.getElementById('uid').value = data.uid;
                }
            })
            .catch(error => console.error('Error fetching UID:', error));
    }

    setInterval(checkUID, 1000); 
</script>
</head>

    <body>
        <div class="tambahForm">
        <h2>Tambah Data Karyawan</h2>
        <form action="" method="post">
        <ul>
            
            <li><label for="uid">UID</label>
            <input type="text" name="uid" id="uid" value="<?php echo getUIDAndTimeFromTemp(); ?>"readonly></li>

            <li><label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" required></li>

            <li><label for="jabatan">Jabatan</label>
            <input type="text" name="jabatan" id="jabatan" required></li>

            <li><label for="gaji">Gaji Pokok</label>
            <input type="text" name="gaji" id="gaji" required></li>

            <li><label for="transport">Transport</label>
            <input type="text" name="transport" id="transport" required></li>
        </ul>
        <button type="submit" name="submit">Tambah Karyawan</button>
        </form>
        </div>
    </body>
    </html>


