<?php
session_start();
include 'koneksipendaftaran.php';

// Cek apakah pengurus sudah login dan memeriksa role
if ($_SESSION['role'] != 'Pengurus UKM') {
    header("Location: login.php"); // jika bukan pengurus, arahkan ke login
    exit();
}

// Ambil data pendaftaran yang statusnya pending
$sql = "SELECT * FROM pendaftaran_ukm WHERE status = 'pending'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengurus UKM</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom CSS untuk header dan tombol */
        h1 {
            font-size: 36px;
            font-weight: bold;
            color: #333;
        }

        h3 {
            font-size: 24px;
            color: #555;
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }

        .action-btn {
            width: 40px;
            height: 40px;
            display: inline-block;
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            margin: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .action-btn.accept {
            background-color: #28a745;
            color: white;
        }

        .action-btn.reject {
            background-color: #dc3545;
            color: white;
        }

        .action-btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
    <div class="container mt-5">
        <h1 class="text-center">Dashboard Pengurus UKM</h1>
        <h3 class="text-center my-4">Daftar Pendaftaran yang Pending</h3>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Divisi</th>
                        <th>Email</th>
                        <th>Alasan Bergabung</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['full_name']; ?></td>
                            <td><?php echo $row['division']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['reason']; ?></td>
                            <td>
                                <!-- Tampilkan ikon untuk menerima atau menolak pendaftaran -->
                                <a href="update_role.php?id=<?php echo $row['id']; ?>&status=accepted">
                                    <span class="action-btn accept" title="Terima">
                                        <i class="bi bi-check"></i>
                                    </span>
                                </a>
                                <a href="update_role.php?id=<?php echo $row['id']; ?>&status=rejected">
                                    <span class="action-btn reject" title="Tolak">
                                        <i class="bi bi-x"></i>
                                    </span>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, dan jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- Bootstrap Icons untuk ikon accept dan reject -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.min.js"></script>
</body>
</html>
