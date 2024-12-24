<?php
// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Periksa apakah metode yang digunakan adalah POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo '<div class="error">Method Not Allowed</div>';
    exit;
}

// Ambil data dari form menggunakan $_POST
$username = $_POST['username'] ?? '';
$nim = $_POST['nim'] ?? '';
$fakultas = $_POST['fakultas'] ?? '';
$jurusan = $_POST['jurusan'] ?? '';
$email = $_POST['email'] ?? '';
$nohp = $_POST['nohp'] ?? '';
$password = $_POST['password'] ?? '';

// Validasi input
if (empty($username) || empty($nim) || empty($fakultas) || empty($jurusan) || empty($email) || empty($nohp) || empty($password)) {
    echo '<div class="error">Semua data harus diisi.</div>';
    exit;
}

// Koneksi ke database (gunakan informasi koneksi yang sesuai)
$servername = "localhost";
$username_db = "root";  // Ganti dengan username database Anda
$password_db = "";      // Ganti dengan password database Anda
$dbname = "InfoUKMtelkom";  // Ganti dengan nama database Anda

// Membuat koneksi ke MySQL
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    echo '<div class="error">Gagal terhubung ke database: ' . $conn->connect_error . '</div>';
    exit;
}

// Escape input untuk keamanan
$username = $conn->real_escape_string($username);
$nim = $conn->real_escape_string($nim);
$fakultas = $conn->real_escape_string($fakultas);
$jurusan = $conn->real_escape_string($jurusan);
$email = $conn->real_escape_string($email);
$nohp = $conn->real_escape_string($nohp);

// Menyimpan password dalam bentuk teks biasa (tidak disarankan untuk aplikasi nyata)
$plainPassword = $password;  // Password asli tanpa di-hash

// Query untuk menyimpan data pengguna menggunakan prepared statement
$stmt = $conn->prepare("INSERT INTO users (username, password, role, nim, fakultas, jurusan, email, no_telpon) 
                        VALUES (?, ?, 'Pengunjung', ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $username, $plainPassword, $nim, $fakultas, $jurusan, $email, $nohp);

// Eksekusi query untuk memasukkan data ke tabel 'users'
if ($stmt->execute()) {
    // Menampilkan pesan keberhasilan
    echo '<div class="success">Akun berhasil dibuat!<br><a href="Login.php" class="link">Ke Halaman Login</a></div>';
} else {
    echo '<div class="error">Gagal membuat akun: ' . $stmt->error . '</div>';
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>

<!-- CSS Styling -->
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        color: #333;
        padding: 20px;
        margin: 0;
    }

    .error, .success {
        padding: 15px;
        margin: 10px 0;
        border-radius: 5px;
        font-size: 16px;
        text-align: center;
    }

    .error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .link {
        display: inline-block;
        margin-top: 10px;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

    .link:hover {
        background-color: #0056b3;
    }
</style>
