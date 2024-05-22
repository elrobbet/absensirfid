<?php
$uid = $_GET['uid']; // Ambil UID dari parameter GET

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dataKaryawan";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah UID sudah ada dalam database
$sql_check = "SELECT uid FROM tmp_uid WHERE uid='$uid'";
$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    // UID sudah ada, perbarui time2
    $sql_update = "UPDATE tmp_uid SET time2=CURTIME() WHERE uid='$uid'";
    if ($conn->query($sql_update) === TRUE) {
        echo "Rekam berhasil diperbarui";
    } else {
        echo "Error: " . $sql_update . "<br>" . $conn->error;
    }
} else {
    // UID belum ada, masukkan UID dan time ke dalam tabel
    $sql_insert = "INSERT INTO tmp_uid (uid, time, time2) VALUES ('$uid', CURTIME(), NULL)";
    if ($conn->query($sql_insert) === TRUE) {
        echo "Rekam berhasil ditambahkan";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}

$conn->close();
?>
