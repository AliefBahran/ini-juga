<?php
session_start();
include 'koneksipendaftaran.php';

// Cek apakah pengurus sudah login dan memeriksa role
if ($_SESSION['role'] != 'Pengurus UKM') {
    header("Location: login.php"); // jika bukan pengurus, arahkan ke login
    exit();
}

// Ambil id dan status dari parameter GET
$id = $_GET['id'];
$status = $_GET['status'];

// Pastikan status adalah 'accepted' atau 'rejected'
if ($status != 'accepted' && $status != 'rejected') {
    // jika status tidak valid, redirect ke halaman utama
    header("Location: rikues.php");
    exit();
}

// Update status pendaftaran
$sql_update_pendaftaran = "UPDATE pendaftaran_ukm SET status = ? WHERE id = ?";
$stmt = $conn->prepare($sql_update_pendaftaran);
$stmt->bind_param('si', $status, $id);

if ($stmt->execute()) {
    // Jika status berhasil diupdate, update role di tabel users jika status diterima
    if ($status == 'accepted') {
        // Ambil email pengguna dari pendaftaran_ukm
        $sql_get_email = "SELECT email FROM pendaftaran_ukm WHERE id = ?";
        $stmt_get_email = $conn->prepare($sql_get_email);
        $stmt_get_email->bind_param('i', $id);
        $stmt_get_email->execute();
        $result = $stmt_get_email->get_result();
        $user = $result->fetch_assoc();
        $email = $user['email'];

        // Update role di tabel users menjadi 'Anggota UKM'
        $sql_update_role = "UPDATE users SET role = 'Anggota UKM' WHERE email = ?";
        $stmt_update_role = $conn->prepare($sql_update_role);
        $stmt_update_role->bind_param('s', $email);
        $stmt_update_role->execute();
    }

    // Setelah berhasil, arahkan kembali ke halaman pendaftaran
    header("Location: rikues.php");
    exit();
} else {
    // Jika gagal update, tampilkan pesan error
    echo "Error updating record: " . $conn->error;
}
?>
