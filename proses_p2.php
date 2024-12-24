<?php
// Include koneksi database
require_once 'databasee.php';

// Periksa apakah data dikirim melalui POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question2 = $_POST['question2']; // Jawaban dari pertanyaan 2

    // Simpan jawaban ke database
    $stmt = $conn->prepare("UPDATE user_answers SET question2 = ? WHERE id = (SELECT MAX(id) FROM user_answers)");
    $stmt->bind_param("s", $question2);

    if ($stmt->execute()) {
        // Redirect ke halaman berikutnya (p3.html)
        header("Location: p3.html");
        exit();
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
