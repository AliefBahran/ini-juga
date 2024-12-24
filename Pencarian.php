<?php
// Koneksi ke database
$host = 'localhost'; // Ganti dengan host database Anda
$user = 'root'; // Ganti dengan username Anda
$password = ''; // Ganti dengan password Anda
$dbname = 'infoukmtelkom'; // Nama database Anda

$conn = new mysqli($host, $user, $password, $dbname);

// Cek apakah koneksi berhasil
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan input dari form
$query = isset($_GET['query']) ? $_GET['query'] : '';
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

// Menyiapkan query pencarian
$sql = "SELECT * FROM ukm WHERE nama_ukm LIKE ?";

// Menambahkan filter kategori jika kategori dipilih
if ($kategori != '') {
    $sql .= " AND kategori = ?";
}

// Menyiapkan statement
$stmt = $conn->prepare($sql);

// Bind parameter
if ($kategori != '') {
    $stmt->bind_param("ss", $searchTerm, $kategori);
} else {
    $stmt->bind_param("s", $searchTerm);
}

$searchTerm = "%$query%";  // Menambahkan wildcard (%) untuk pencarian yang lebih fleksibel

// Eksekusi query
$stmt->execute();
$result = $stmt->get_result();

// Array untuk menyimpan nama UKM dan URL gambar manual
$ukm_images = array(
    'Unit Kebudayaan Mahasiswa Aceh (UKMA)' => 'aceh.png',
    'AVI Pictures' => 'avi.png',
    'Balon Kata' => 'bata.png',
    'Band' => 'musik.jpg',
    'Betawie' => 'betawi.jpg',
    'Dhawa Tjap Parabola' => 'daftar.jpg',
    'Eka Sanvadita Orkestra (ESO)' => 'orkestra.png',
    'Bengkel Seni Embun' => 'beni.png',
    'Fotografi Telkom' => 'foto.png',
    'Kalimantan' => 'kali.png',
    'Keluarga Besar Mahasiswa Sulawesi (KBMS)' => 'sula.png',
    'Kesenian Bali Widyacana Murti' => 'bali.png',
    'Nippon Bunka - BU' => 'nibu.png',
    'Telkom University Choir (Paduan Suara)' => 'padus.png',
    'Persatuan Mahasiswa Lampung (PERMALA)' => 'lampung.png',
    'Rumah Gadang' => 'rg.png',
    'Samalowa Lombok Sumbawa' => 'lomb.png',
    'Sariksa Wiwaha Sunda (SAWANDA)' => 'sunda.png',
    'Teater Titik' => 'teater.png',
    'Ikatan Keluarga Anak Riau dan Kepulauan Riau (IKRAR)' => 'riau.png',
    'Ikatan Mahasiswa Maluku dan Papua (IMMAPA)' => 'maluku.png',
    'Academy Archery of Telkom (ARCHATEL)' => 'panah.png',
    'Telkom University Badminton Club (TUBC)' => 'minto.png',
    'Bola' => 'bola.png',
    'Basket' => 'bask.png',
    'Capoeira Brazil Telkom University' => 'capo.png',
    'Persatuan Catur Mahasiswa (PCM)' => 'ctr.png',
    'Karate' => 'krt.png',
    'Riverside Softball - Baseball' => 'bsb.png',
    'Taekwondo' => 'tkd.png',
    'Tenis Lapangan' => 'olahraga.jpg',
    'Perguruan Pencak Silat Bela Diri Tangan Kosong (PPS BETAKO) Merpati Putih' => 'mrpt.png',
    'Telkom University Esport' => 'esp.png',
    'Telkom University Volley Ball Club (TUVBC)' => 'vly.png',
    'Aksara Jurnalistik' => 'jrnl.png',
    'Central Computer Improvement (CCI)' => 'cpu.png',
    'Himpunan Pengusaha Muda Indonesia Perguruan Tinggi (HIPMI PT)' => 'pmd.png',
    'Indonesia Marketing Association Student Chapter (IMA SC)' => 'mkrt.png',
    'Institute of Electrical and Electronics Engineers (IEEE)' => 'eng.png',
    'Koperasi Mahasiswa (KOPMA) TelU' => 'kopr.png',
    'Student Activity for Research and Competition Handling (SEARCH)' => 'rsr.png',
    'Student English Society (SES)' => 'egls.png',
    'Lembaga Dakwah Kampus' => 'dkwh.png',
    'Keluarga Mahasiswa Hindu (KMH)' => 'hnd.png',
    'Persekutuan Mahasiswa Kristen (PMK)' => 'grj.png',
    'Keluarga Mahasiswa Pecinta Alam (KMPA)' => 'mapala.png',
    'Korps Suka Rela Palang Merah Indonesia (KSR PMI)' => 'pmi.png',
    'Korps Protokoler Mahasiswa (KPM)' => 'klr.png',
    'Pramuka' => 'prmk.png',
    'Paskibra' => 'pskb.png',
    'Telkom University Education Movement (TEAM)' => 'cpu.png',
);

// HTML dan Styling
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pencarian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styling */
        .search-bar {
            background-color: #f8f9fa;
            border-radius: 30px;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .search-bar input {
            border: 2px solid #ced4da;
            border-radius: 20px;
            padding: 8px 15px;
            flex: 1;
            margin-right: 10px;
        }

        .search-bar button {
            border-radius: 20px;
            padding: 8px 15px;
        }

        .category-card {
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            color: white;
            height: 200px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 20px;
        }

        .category-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .category-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .category-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .category-title {
            font-size: 1.5rem;
            text-align: center;
            text-transform: uppercase;
            font-weight: bold;
        }

        .category-filter {
            margin-bottom: 30px;
        }

        .category-filter select,
        .category-filter button {
            border-radius: 20px;
        }

        .category-card,
        .category-card:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .no-results {
            text-align: center;
            font-size: 1.2rem;
            color: #6c757d;
        }

        a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <div class="container mt-5">
        <!-- Search Bar -->
        <div class="row mb-4">
            <div class="col">
                <div class="search-bar">
                    <form action="pencarian.php" method="GET" class="d-flex w-100">
                        <input type="text" name="query" class="form-control" placeholder="Cari UKM..." value="<?php echo isset($_GET['query']) ? $_GET['query'] : ''; ?>" required>
                        <button type="submit" class="btn btn-primary ms-2"><i class="bi bi-search"></i> Cari</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Filter by Category -->
        <div class="row mb-4">
            <div class="col">
                <div class="category-filter">
                    <form action="pencarian.php" method="GET" class="d-flex align-items-center">
                        <select name="kategori" class="form-select me-2" aria-label="Pilih Kategori">
                            <option value="">Pilih Kategori</option>
                            <option value="Budaya" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'Budaya') ? 'selected' : ''; ?>>Budaya</option>
                            <option value="Seni" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'Seni') ? 'selected' : ''; ?>>Seni</option>
                            <option value="Musik" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'Musik') ? 'selected' : ''; ?>>Musik</option>
                            <option value="Olahraga" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'Olahraga') ? 'selected' : ''; ?>>Olahraga</option>
                            <option value="Organisasi" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'Organisasi') ? 'selected' : ''; ?>>Organisasi</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Display Search Results -->
        <div class="row">
            <?php
            // Menampilkan hasil pencarian
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Membuat link ke halaman detail berdasarkan nama UKM
                    $ukm_nama = $row['nama_ukm'];
                    $ukm_id = $row['id_ukm'];

                    // Menentukan URL gambar dari array
                    $image_url = isset($ukm_images[$ukm_nama]) ? $ukm_images[$ukm_nama] : 'images/default.jpg';
                    if ($ukm_nama == 'Dhawa Tjap Parabola') {
                        $detail_url = 'DhawaTjapParabola.php'; // URL khusus untuk "Dhawa Tjap Parabola"
                    } else {
                        $detail_url = "detail_ukm.php?id_ukm=$ukm_id"; // URL umum untuk UKM lain
                    }

                    echo "<div class='col-md-4 mb-3'>";
                    echo "<a href='$detail_url' class='text-decoration-none'>"; // Membungkus seluruh kategori dengan link
                    echo "<div class='category-card'>";
                    echo "<img src='$image_url' alt='Image'>"; // Gambar berdasarkan array
                    echo "<div class='category-overlay'>";
                    echo "<div class='category-title'>" . $row['nama_ukm'] . "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</a>";
                    echo "</div>";
                }
            } else {
                echo "<div class='col-12'><p class='no-results'>Tidak ada UKM yang ditemukan dengan kriteria pencarian Anda.</p></div>";
            }

            // Tutup koneksi
            $stmt->close();
            $conn->close();
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
