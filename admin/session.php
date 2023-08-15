<?php
session_start();
if ($_SESSION['role'] == "admin") {
	include "../conn.php";
} else if ($_SESSION['role'] == "karyawan") {
	include "../conn.php";
}  else {
    header('location:../index.php');
}
?>