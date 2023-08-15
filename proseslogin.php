<?php
include ("conn.php");
date_default_timezone_set('Asia/Jakarta');

session_start();

$username2 = $_POST['username'];
$password1 = $_POST['password'];
$password2 = sha1($password1);

$username = mysqli_real_escape_string($koneksi, $username2);
$password = mysqli_real_escape_string($koneksi, $password2);

if (empty($username) && empty($password)) {
	header('location:index.php?error=Username dan Password Kosong!');
} else if (empty($username)) {
	header('location:index.php?error=Username Kosong!');
} else if (empty($password)) {
	header('location:index.php?error=Password Kosong!');
}

$q = mysqli_query($koneksi, "select * from users where username='$username' and password='$password'");
$row = mysqli_fetch_array ($q);

if (mysqli_num_rows($q) == 1) {
    $_SESSION['id']         = $row['id'];
	$_SESSION['username']   = $username;
    $_SESSION['nama']       = $row['nama'];
    $_SESSION['role']       = $row['role'];
    $_SESSION['id_produk']  = $row['id_produk'];
    $_SESSION['id_supplier']= $row['id_supplier'];
    
    if ($_SESSION['role'] == 'admin'){
        header('location:admin/index.php');
    } else if ($_SESSION['role'] == 'karyawan'){
        header('location:admin/index1.php');
    }

	
} else {
	header('location:index.php?error=Anda Belum Terdaftar!');
}
?>