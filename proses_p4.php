<?php
require_once 'databasee.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question4 = $_POST['question4'];

    $stmt = $conn->prepare("UPDATE user_answers SET question4 = ? WHERE id = (SELECT MAX(id) FROM user_answers)");
    $stmt->bind_param("s", $question4);

    if ($stmt->execute()) {
        header("Location: p5.html");
        exit();
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
