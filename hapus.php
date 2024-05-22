<?php
include("func.php");
$id = $_GET['id'];

if(hapus($id) > 0){
    echo "<script>alert('Data karyawan berhasil dihapus!');</script>";
    echo "<script>window.location.href = 'dataKaryawan.php';</script>";
} else{ 
    echo "<script>alert('Data gagal di hapus')</script>";
    echo "<script>window.location.href = 'dataKaryawan.php';</script>";
}

