<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <!-- Link ke Font Awesome untuk ikon profesional -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="sidebar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<style>
    .modal-dialog {
        position: fixed;
        bottom: 100px;
        left: 60px;
        max-width: 550px;
        width: 550px;
        height: auto;
        margin: 0;
        z-index: 1050;
    }

    #profileButton {
        margin-top: auto;
        position: fixed;
        bottom: 20px;
        left: 20px;
        z-index: 1050;
        border: none;
        background: none;
    }

    .btn-logout {
        background-color: white;
        color: #A14043;
        border: #555;
        border-radius: 25px;
        font-weight: bold;
    }

    .modal-content {
        background-color: #D9D9D9;
        border-radius: 25px;
        height: 100%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        color: black;
        justify-content: center;
        align-items: center;
        display: flex;
        position: relative;
        padding: 20px;
    }

    .btn-close {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
    }

    .profile-image {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
    }

    .datadiri {
        background-color: #A14043;
        color: white;
        padding: 15px;
        border-radius: 25px;
        margin-bottom: 20px;
    }

    .mb-3.deskripsi {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        width: 450px;
        height: 150px;
        padding: 10px;
        background-color: #f8f8f8;
        border-radius: 15px;
    }

    .info-container {
        background-color: #A14043;
        color: white;
        padding: 15px;
        border-radius: 15px;
        margin-bottom: 20px;
    }

    .info-container p {
        margin: 10px 0;
    }

    .info-container .badge {
        font-size: 14px;
    }

    .modal-title {
        font-weight: bold;
    }

    .modal-body {
        font-size: 14px;
        padding: 30px;
        overflow-y: auto;
    }

    .modal-footer {
        border-top: none;
        display: flex;
        justify-content: center;
        align-items: center;
        padding-top: 20px;
    }

    .badge {
        background-color: #A84343;
    }

    img {
        width: 80px;
        height: 80px;
        object-fit: cover;
    }

    .see-more {
        color: red !important;
    }

    .daftar-ukm {
        color: red !important;
        text-decoration: none;
    }

    .card {
        border: none;
        border-radius: 10px;
        background-color: #fff;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 0.9rem;
        color: #555;
    }

    .bi-heart {
        color: #d63031;
        cursor: pointer;
    }

    .card-body {
        text-align: left;
    }

    .image-container {
        width: 100%;
        height: 200px;
        overflow: hidden;
        border: 1px solid #ccc;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .row {
        margin-right: 0;
        margin-left: 0;
    }

    .fas.fa-user-circle:hover {
        color: #ffeb3b;
        background-color: rgba(255, 255, 255, 0.1);
        transform: translateX(5px);
        transition: all 0.3s ease;
    }
</style>

<body>
    <?php
    // Simulasi data pengguna
    $user_name = "Muhammad Raul";
    $user_nim = "607012330144";
    $user_joined = "December 17, 2024";
    $user_role = "Member";
    $user_image = "https://via.placeholder.com/80";
    $user_membership = "ukmbolatelkomuniversity";
    ?>
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column align-items-center">
        <a href="Beranda.php"><i class="icon fas fa-home"></i></a>
        <a href="Pencarian.php"><i class="icon fas fa-search"></i></a>
        <button type="button" id="profileButton" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#dashboardModal">
            <i class="fas fa-user-circle fa-2x text-white"></i>
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="dashboardModal" tabindex="-1" aria-labelledby="dashboardModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dashboardModalLabel">Dashboard Personal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="info-container d-flex align-items-center mb-3">
                        <img src="<?php echo $user_image; ?>" class="profile-image me-3" alt="User Photo">
                        <div>
                            <p><strong>Nama:</strong> <?php echo $user_name; ?></p>
                            <p class="fw-bold mb-0">NIM: <?php echo $user_nim; ?></p>
                            <p class="fw-bold mb-0">Member of:</p>
                            <p><span class="badge bg-secondary"><?php echo $user_membership; ?></span></p>
                        </div>
                    </div>

                    <div class="mb-3 datadiri">
                        <p class="fw-bold mb-0">Joined since: <?php echo $user_joined; ?></p>
                    </div>

                    <div class="mb-3 datadiri">
                        <p class="fw-bold mb-0">Role: <?php echo $user_role; ?></p>
                    </div>

                    <div class="mb-3 datadiri">
                        <p class="fw-bold mb-0">Change user role:</p>
                        <select class="form-select">
                            <option selected>Member</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="mb-3 deskripsi">
                        <p><span class="fw-bold teks">Ada</span><br>1 Apr 2024</p>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <!-- Tombol Close untuk menutup modal -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    <!-- Tombol Log Out -->
                    <button type="button" class="btn btn-primary btn-logout" id="logoutButton">Log out</button>
                </div>

                <!-- JavaScript untuk mengarahkan ke Login.php saat tombol Log out diklik -->
                <script>
                    // Mendapatkan elemen tombol logout
                    const logoutButton = document.getElementById('logoutButton');

                    // Menambahkan event listener untuk klik tombol logout
                    logoutButton.addEventListener('click', function() {
                        // Redirect ke halaman Login.php
                        window.location.href = 'Login.php';
                    });
                </script>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>