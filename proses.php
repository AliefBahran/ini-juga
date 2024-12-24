<?php
// Include koneksi database
require_once 'databasee.php';

// Periksa apakah data dikirim melalui POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tangkap jawaban dari form
    $question1 = $_POST['question1']; // Jawaban dari pertanyaan 1

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO user_answers (question1) VALUES (?)");
    $stmt->bind_param("s", $question1);

    if ($stmt->execute()) {
        // Redirect ke halaman berikutnya (p2.html atau PHP berikutnya)
        header("Location: p2.html");
        exit();
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
