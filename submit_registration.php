<?php
// Menyertakan file koneksi
include 'koneksipendaftaran.php';

// Mengecek jika form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menangkap data dari form
    $full_name = $_POST['full_name'];
    $nim = $_POST['nim'];
    $division = $_POST['division'];
    $email = $_POST['email'];
    $reason = $_POST['reason'];

    // Mengecek jika sudah pernah mendaftar sebelumnya
    $sql_check = "SELECT * FROM pendaftaran_ukm WHERE nim = ? LIMIT 1";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $nim);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Jika sudah mendaftar, kirimkan status "already_registered"
        header("Location: daftartjap.php?status=already_registered");
        exit();
    } else {
        // Jika belum mendaftar, proses pendaftaran
        $sql = "INSERT INTO pendaftaran_ukm (full_name, nim, division, email, reason, status) 
                VALUES (?, ?, ?, ?, ?, 'pending')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $full_name, $nim, $division, $email, $reason);

        if ($stmt->execute()) {
            // Redirect ke halaman daftartjap.php dengan query status=success
            header("Location: daftartjap.php?status=success");
            exit();
        } else {
            // Jika terjadi error dalam query
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>
