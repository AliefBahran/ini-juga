<?php
require_once 'databasee.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question5 = $_POST['question5'];

    $stmt = $conn->prepare("UPDATE user_answers SET question5 = ? WHERE id = (SELECT MAX(id) FROM user_answers)");
    $stmt->bind_param("s", $question5);

    if ($stmt->execute()) {
        header("Location: hasil.php");
        exit();
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
