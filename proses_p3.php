<?php
require_once 'databasee.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question3 = $_POST['question3'];

    $stmt = $conn->prepare("UPDATE user_answers SET question3 = ? WHERE id = (SELECT MAX(id) FROM user_answers)");
    $stmt->bind_param("s", $question3);

    if ($stmt->execute()) {
        header("Location: p4.html");
        exit();
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
