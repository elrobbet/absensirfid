<?php 
include 'func.php';
if (isset($_POST["submit"])) {
    // Ambil nilai dari form
    $id_karyawan = $_POST['id'];
    $jenis = $_POST['jenis'];

    //fungsi untuk menambahkan perizinan ke ID karyawan
    if (perizinan($id_karyawan, $jenis)) {
        echo "<script>alert('Data perizinan berhasil ditambahkan!');</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data perizinan!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perizinan</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'navbar.php' ?>

 <div class="perizinan">
    <h2>Form Perizinan</h2>
    <form action="" method="post">
        <label for="id">ID Karyawan:</label>
        <input type="text" id="id" name="id" required><br><br>

        <label for="jenis">Jenis Izin/Sakit:</label>
        <select id="jenis" name="jenis" required>
            <option value="izin">Izin</option>
            <option value="sakit">Sakit</option>
        </select><br><br>

        <input type="submit" name="submit" value="Submit">
    </form>
</div>
</body>
</html>
