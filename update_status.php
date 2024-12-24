<?php
session_start();
include 'koneksipendaftaran.php';

// Cek apakah pengurus sudah login
if ($_SESSION['role'] != 'Pengurus UKM') {
    header("Location: login.php"); // jika bukan pengurus, arahkan ke login
    exit();
}

// Ambil id pendaftaran dan status yang akan diubah
$id = $_GET['id'];
$status = $_GET['status']; // Bisa "accepted" atau "rejected"

// Perbarui status pendaftaran di database
$sql = "UPDATE pendaftaran_ukm SET status = '$status' WHERE id = $id";

// Cek apakah query berhasil
if ($conn->query($sql) === TRUE) {
    // Setelah berhasil mengubah status, kembalikan ke dashboard pengurus
    header("Location: aa.php"); // Redirect ke halaman dashboard pengurus
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>
