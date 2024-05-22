<?php
$conn = mysqli_connect("localhost", "root", "", "datakaryawan");

if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

if (!function_exists('getKaryawanByID')) {
    function getKaryawanByID($id) {
        global $conn;
        $query = "SELECT * FROM karyawan WHERE id = $id";
        $result = mysqli_query($conn, $query);
        return mysqli_fetch_assoc($result);
    }
}

if (!function_exists('query')) {
    function query($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
}

if (!function_exists('formatRupiah')) {
    function formatRupiah($angka) {
        return 'Rp. ' . number_format($angka, 0, ',', '.');
    }
}

if (!function_exists('tambahKaryawan')) {
    function tambahKaryawan($uid, $nama, $jabatan, $gaji, $transport) {
        global $conn;
        $query = "INSERT INTO karyawan (uid, nama, jabatan, gaji, transport) VALUES ('$uid', '$nama', '$jabatan', '$gaji', '$transport')";
        return mysqli_query($conn, $query);
    }
}

if (!function_exists('hapus')) {
    function hapus($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM karyawan WHERE id = $id");
        return mysqli_affected_rows($conn);
    }
}

if (!function_exists('perizinan')) {
    function perizinan($id, $jenis) {
        global $conn;

        $kolom_perizinan = ($jenis == 'izin') ? 'izin' : 'sakit';
        $query = "UPDATE karyawan SET $kolom_perizinan = $kolom_perizinan + 1 WHERE id = '$id'";
        return mysqli_query($conn, $query);
    }
}

if (!function_exists('ubahKaryawan')) {
    function ubahKaryawan($id, $uid, $nama, $jabatan, $gaji, $transport) {
        global $conn;
        $query = "UPDATE karyawan SET uid = '$uid', nama = '$nama', jabatan = '$jabatan', gaji = '$gaji', transport = '$transport' WHERE id = $id";
        return mysqli_query($conn, $query);
    }
}

if (!function_exists('updateJamKeluar')) {
    function updateJamKeluar($uid) {
        global $conn;
        $current_date = date("Y-m-d");
        $query = "UPDATE karyawan SET jamKeluar = (SELECT time2 FROM tmp_uid WHERE uid = '$uid') WHERE uid = '$uid' AND tanggal = '$current_date'";
        if (mysqli_query($conn, $query)) {
            return true;
        } else {
            error_log("updateJamKeluar Error: " . mysqli_error($conn));
            return false;
        }
    }
}

if (!function_exists('updateJamMasuk')) {
    function updateJamMasuk($uid) {
        global $conn;
        $current_date = date("Y-m-d");
        $query = "UPDATE karyawan SET jamMasuk = (SELECT time FROM tmp_uid WHERE uid = '$uid') WHERE uid = '$uid' AND tanggal = '$current_date'";
        if (mysqli_query($conn, $query)) {
            return true;
        } else {
            error_log("updateJamMasuk Error: " . mysqli_error($conn));
            return false;
        }
    }
}

if (!function_exists('getUIDAndTimeFromTemp')) {
    function getUIDAndTimeFromTemp() {
        global $conn;
        $sql = "SELECT uid, time, time2 FROM tmp_uid ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            error_log("Query Error: " . mysqli_error($conn));
            return null;
        }
        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            return null;
        }
    }
}

if(!function_exists('checkUID')){
    function checkUID() {
        global $conn;
        $sql = "SELECT uid FROM tmp_uid LIMIT 1";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo json_encode(array('uid' => $row["uid"]));
        } else {
            echo json_encode(array('uid' => 'tempelkan kartu'));
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'checkUID') {
    checkUID();
    exit();
}

if (!function_exists('tambahKaryawanBaru')) {
    function tambahKaryawanBaru($uid, $time, $tanggal) {
        global $conn;
        $query = "INSERT INTO karyawan (uid, jamMasuk, tanggal) VALUES ('$uid', '$time', '$tanggal')";
        if (mysqli_query($conn, $query)) {
            return true;
        } else {
            error_log("tambahKaryawanBaru Error: " . mysqli_error($conn));
            return false;
        }
    }
}
?>
