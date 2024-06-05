<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survei Polinema</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-vertical {
            background-color: #f0f2f5;
            color: #304C65;
            height: 100vh;
            padding: 20px;
            position: fixed;
            width: 250px;
        }

        .navbar-vertical img {
            width: 45px;
            margin-bottom: 15px;
            margin-top: -10px;
        }

        .navbar-vertical .nav-link img {
            width: 20px;
            height: 20px;
            margin-top: 10px;
            padding: 3px;
            margin-right: 10px;
        }

        .navbar-vertical p {
            margin: 0;
            font-weight: bold;
            text-align: center;
            position: relative;
            margin-top: -50px;
            margin-left: 54px;
            font-size: 20px;
        }

        .navbar-vertical .nav-link {
            color: #304C65;
            font-weight: 700;
            padding: 0px;
            display: block;
            border-radius: 5px;
            font-size: 14px;
        }

        .navbar-vertical .nav-link:hover {
            background-color: #e0e0e0;
        }

        .navbar-vertical .nav-link.active {
            background-color: #e0e0e0;
        }

        .navbar-vertical .logout {
            position: absolute;
            bottom: 20px;
            left: 20px;
        }

        .content {
            margin-left: 240px;
            padding: 0px;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #304C65;
            padding: 8px 20px;
            color: white;
        }

        .content-header .profile {
            display: flex;
            align-items: center;
            font-size: 14px;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .survey-content {
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .survey-content h2 {
            margin-bottom: 20px;
            margin-left: 20px;
            font-weight: bold;
            font-size: 20px;
        }

        .nav-divider {
            border: none;
            height: 2px;
            background-color: #304C65;
            margin: 10px 0;
        }

        .filter-section {
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .filter-section h3 {
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 14px;
        }
        .filter-section .filter-group {
            margin-bottom: 20px;
            font-size: 14px;
        }
        .filter-section .filter-group select {
            width: 150px;
            padding: 10px;
            border-radius: 20px;
            border: 1px solid #ccc;
        }
        .table-responsive {
            margin-top: 20px;
            margin-left: 20px;
        }
        .table th,
        .table td {
            text-align: left;
        }
        .btn-add {
            display: inline-block;
            padding: 10px 20px;
            margin-bottom: 10px;
            background-color: #304C65;
            color: white;
            border-radius: 20px;
            text-decoration: none;
            font-size: 14px;
        }
        .btn-add:hover {
            background-color: #273c4e;
            color: white;
        }
        .search-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            margin-left: 20px;
        }
        .search-bar input {
            padding: 8px 12px;
            border-radius: 20px;
            border: 1px solid #ccc;
            width: 300px;
        }
        .search-bar button {
            padding: 8px 12px;
            border: none;
            background-color: #304C65;
            color: white;
            border-radius: 20px;
        }
        .table-responsive {
            margin-top: 20px;
            margin-left: 20px;
        }
        .table th,
        .table td {
            text-align: left;
        }
        .table .dropdown-menu {
            min-width: 100px;
        }
        .modal-content {
            border-radius: 10px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .modal-header {
            border-bottom: none;
            padding-bottom: 0;
        }
        .modal-header h5 {
            font-weight: bold;
        }
        .modal-body {
            padding-top: 0;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            border-radius: 20px;
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
        }
        .btn-primary {
            background-color: #304C65;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
        }
        .btn-secondary {
            background-color: #273c4e;
            border: none;
            border-radius: 50px;
            padding: 5px 10px;
            font-size: 14px;
        }
        .search-bar input[type="text"] {
            width: auto; /* Menggunakan lebar otomatis */
            flex: 1; /* Menggunakan fleksibilitas untuk menyesuaikan ukuran */
            border-radius: 10px;
        }
        .search-bar button {
            padding: 8px 12px;
            border: none; 
            background-color: #304C65;
            color: white;
            border-radius: 10px;
            min-width: 50px; /* Menetapkan lebar minimum untuk tombol */
            margin-right: 200px;
        }
        /* CSS untuk tampilan modal */
        .modal-content {
            border-radius: 10px;
        }
        .modal-title {
            font-size: 1.5rem;
        }
        .modal-body {
            padding: 20px;
        }

        /* CSS untuk label dan input */
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg fill="%23333" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>');
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 20px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="navbar-vertical">
        <img src="aset/logopolinema.png" alt="Polinema Logo">
        <p>Survei Polinema</p>
        <hr class="nav-divider">
        <nav class="nav flex-column mt-4">
            <a class="nav-link" href="admin_overview.php"><img src="aset/overview.png" alt="Overview Icon">Overview</a>
            <a class="nav-link" href="admin_user_dashboard.php"><img src="aset/users.png" alt="User Icon">User</a>
            <a class="nav-link" href="admin_datasurvei_dashboard.php"><img src="aset/data.png" alt="Data Survei Icon">Data Survei</a>
            <a class="nav-link active" href="admin_survei.php"><img src="aset/survei.png" alt="Survei Icon">Survei</a>
        </nav>
        <a class="nav-link logout" href="#"><img src="aset/logout.png" alt="Logout Icon">Logout</a>
    </div>
    <div class="content">
        <div class="content-header">
            <h1> </h1>
            <div class="profile">
                <a class="nav-link" href="admin_profile.php">
                    <span>Admin</span></a>
            </div>
        </div>
        <div class="survey-content">
            <h2>Survei Pengguna</h2>
            <hr class="nav-divider">
            <div class="search-bar">
                <input type="text" placeholder="Cari">
                <button class="btn-add" data-toggle="modal" data-target="#addSurveyModal">tambahkan survei</button>
            </div>
            <!-- Tambah Survei -->
            <div class="modal fade" id="addSurveyModal" tabindex="-1" aria-labelledby="addSurveyModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addSurveyModalLabel">Tambah Data Survei</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form action="proses_buat_survei.php" method="post">
    <label for="survey_nama">Nama Survei:</label><br>
    <input type="text" id="survey_nama" name="survey_nama" required><br><br>

    <label for="kategori_id">Kategori:</label><br>
    <select id="kategori_id" name="kategori_id">
        <option value="1">Fasilitas</option>
        <option value="2">Akademik</option>
        <option value="3">Pelayanan</option>
        <option value="4">Alumni</option>
    </select><br><br>

    <label for="survey_jenis">Jenis Survei:</label><br>
    <select id="survey_jenis" name="survey_jenis" required>
        <option value="ortu">Orang Tua</option>
        <option value="mahasiswa">Mahasiswa</option>
        <option value="tendik">Tenaga Pendidik</option>
        <option value="dosen">Dosen</option>
        <option value="alumni">Alumni</option>
        <option value="industri">Industri</option>
    </select><br><br>

    <label for="survey_deskripsi">Deskripsi Survei:</label><br>
    <textarea id="survey_deskripsi" name="survey_deskripsi" rows="4" required></textarea><br><br>

    <label for="survey_tanggal">Tanggal Survei:</label><br>
    <input type="date" id="survey_tanggal" name="survey_tanggal" required><br><br>

    <!-- Contoh membuat soal survei -->
    <label for="soal_1">Pertanyaan 1:</label><br>
    <input type="text" id="soal_1" name="soal_1" required><br><br>

    <label for="jenis_soal_1">Jenis Pertanyaan 1:</label><br>
    <select id="jenis_soal_1" name="jenis_soal_1" required>
        <option value="skala">Skala</option>
        <option value="isian">Isian</option>
        <option value="y/n">Ya/Tidak</option>
    </select><br><br>
    <label for="soal_2">Pertanyaan 2:</label><br>
    <input type="text" id="soal_2" name="soal_2" required><br><br>

    <label for="jenis_soal_2">Jenis Pertanyaan 2:</label><br>
    <select id="jenis_soal_2" name="jenis_soal_2" required>
        <option value="skala">Skala</option>
        <option value="isian">Isian</option>
        <option value="y/n">Ya/Tidak</option>
    </select><br><br>

    <!-- Dan seterusnya sesuai dengan jumlah pertanyaan yang ingin dibuat -->

    <input type="submit" value="Buat Survei">
</form>


                        </div>
                    </div>
                </div>
            </div>
            
            <?php
            require_once 'koneksi.php';

            $sql = "SELECT * FROM m_survey";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<div class="table-responsive">';
                echo '<table class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Jenis Soal</th>';
                echo '<th>Nama Soal</th>';
                echo '<th>Operasi</th>'; 
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['survey_jenis']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['survey_nama']) . '</td>';
                    echo '<td>';
                    echo '<a href="edit_survei.php?id=' . $row['survey_id'] . '">Edit</a>'; 
                    echo ' | ';
                    echo '<a href="delete_survei.php?id=' . $row['survey_id'] . '" onclick="return confirm(\'Anda yakin ingin menghapus survei ini?\')">Delete</a>'; 
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
                
            } else {
                echo "Tidak ada survei yang tersedia.";
            }

            // Tutup koneksi
            $conn->close();
            ?>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>