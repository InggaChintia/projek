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

        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            /* z-index: 1000; */
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            color: black;
            text-align: center;
            width: 390px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .popup-button {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .popup-button.confirm {
            background-color: #203040;
            color: white;
        }

        .popup-button.cancel {
            background-color: grey;
        }

        .navbar-vertical .logout {
            position: absolute;
            bottom: 20px;
            left: 20px;
            display: flex;
            align-items: center;
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
            margin-right: 50px;
            width: 1400px;
        }

        .table th,
        .table td {
            text-align: left;
            padding: 12px;
            vertical-align: middle;
            margin-right: 20px;
        }

        .table thead th {
            background-color: #304C65;
            color: white;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
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

        .table .dropdown-menu {
            min-width: 100px;
        }

        .modal-content {
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 700px;
            margin: 0 auto;
        }

        .modal-header {
            border-bottom: none;
            padding-bottom: 0;
        }

        .modal-header h5 {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .modal-body {
            padding: 20px;
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
            flex: 1;
            border-radius: 10px;
            min-width: 50px;
            margin-right: 800px;
            padding: 8px 12px;
        }

        .search-bar button {
            padding: 8px 12px;
            border: none;
            background-color: #304C65;
            color: white;
            border-radius: 10px;
            min-width: 50px;
            margin-right: 200px;
            margin-top: 20px;
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

        /* CSS untuk tombol Edit dan Delete */
        .table .btn-edit,
        .table .btn-delete {
            display: inline-block;
            padding: 6px 12px;
            margin: 2px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .table .btn-edit {
            background-color: #007bff;
        }

        .table .btn-edit:hover {
            background-color: #0056b3;
        }

        .table .btn-delete {
            background-color: #dc3545;
        }

        .table .btn-delete:hover {
            background-color: #c82333;
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
            <a class="nav-link" href="admin_user.php"><img src="aset/users.png" alt="User Icon">User</a>
            <a class="nav-link" href="admin_datasurvei_dashboard.php"><img src="aset/data.png" alt="Data Survei Icon">Data Survei</a>
            <a class="nav-link active" href="admin_survei.php"><img src="aset/survei.png" alt="Survei Icon">Survei</a>
        </nav>
        <a id="logout-link" class="nav-link logout" href="../user/user_registrasi.php">
            <img src="aset/logout.png" alt="Logout Icon">Logout</a>
        </a>
        <div id="logout-popup" class="popup-overlay">
            <div class="popup-content">
                <h2>Konfirmasi Logout</h2>
                <button id="confirm-logout" class="popup-button confirm">Logout</button>
                <button id="cancel-logout" class="popup-button cancel">Cancel</button>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="content-header">
            <h1> </h1>
            <div class="profile">
                <a class="nav-link" href="#">
                    <span>Admin</span></a>
            </div>
        </div>
        <div class="survey-content">
            <h2>Survei Pengguna</h2>
            <hr class="nav-divider">
            <div class="search-bar">
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

                                <label for="survey_kode">Kode Survey:</label>
                                <input type="text" id="survey_kode" name="survey_kode">

                                <label for="survey_deskripsi">Deskripsi Survei:</label><br>
                                <textarea id="survey_deskripsi" name="survey_deskripsi" rows="4" required></textarea><br><br>

                                <label for="survey_tanggal">Tanggal Survei:</label><br>
                                <input type="date" id="survey_tanggal" name="survey_tanggal" required><br><br>

                                <!-- Contoh membuat soal survei -->
                                <label for="survey_deskripsi">Nomor Urut:</label><br>
                                <input type="text" id="nomor_urut_1" name="nomor_urut_1" required><br><br>

                                <label for="soal_1">Pertanyaan 1:</label><br>
                                <input type="text" id="soal_1" name="soal_1" required><br><br>

                                <label for="jenis_soal_1">Jenis Pertanyaan 1:</label><br>
                                <select id="jenis_soal_1" name="jenis_soal_1" required>
                                    <option value="skala">Skala</option>
                                    <option value="isian">Isian</option>
                                    <option value="y/n">Ya/Tidak</option>
                                </select><br><br>

                                <label for="survey_deskripsi">Nomor Urut:</label><br>
                                <input type="text" id="nomor_urut_2" name="nomor_urut_2" required><br><br>

                                <label for="soal_2">Pertanyaan 2:</label><br>
                                <input type="text" id="soal_2" name="soal_2" required><br><br>

                                <label for="jenis_soal_2">Jenis Pertanyaan 2:</label><br>
                                <select id="jenis_soal_2" name="jenis_soal_2" required>
                                    <option value="skala">Skala</option>
                                    <option value="isian">Isian</option>
                                    <option value="y/n">Ya/Tidak</option>
                                </select><br><br>

                                <label for="survey_deskripsi">Nomor Urut:</label><br>
                                <input type="text" id="nomor_urut_3" name="nomor_urut_3" required><br><br>

                                <label for="soal_3">Pertanyaan 3:</label><br>
                                <input type="text" id="soal_3" name="soal_3" required><br><br>

                                <label for="jenis_soal_3">Jenis Pertanyaan 3:</label><br>
                                <select id="jenis_soal_3" name="jenis_soal_3" required>
                                    <option value="skala">Skala</option>
                                    <option value="isian">Isian</option>
                                    <option value="y/n">Ya/Tidak</option>
                                </select><br><br>

                                <label for="survey_deskripsi">Nomor Urut:</label><br>
                                <input type="text" id="nomor_urut_4" name="nomor_urut_4" required><br><br>

                                <label for="soal_4">Pertanyaan 4:</label><br>
                                <input type="text" id="soal_4" name="soal_4" required><br><br>

                                <label for="jenis_soal_4">Jenis Pertanyaan 4:</label><br>
                                <select id="jenis_soal_4" name="jenis_soal_4" required>
                                    <option value="skala">Skala</option>
                                    <option value="isian">Isian</option>
                                    <option value="y/n">Ya/Tidak</option>
                                </select><br><br>

                                <label for="survey_deskripsi">Nomor Urut:</label><br>
                                <input type="text" id="nomor_urut_5" name="nomor_urut_5" required><br><br>

                                <label for="soal_5">Pertanyaan 5:</label><br>
                                <input type="text" id="soal_5" name="soal_5" required><br><br>

                                <label for="jenis_soal_5">Jenis Pertanyaan 5:</label><br>
                                <select id="jenis_soal_5" name="jenis_soal_5" required>
                                    <option value="skala">Skala</option>
                                    <option value="isian">Isian</option>
                                    <option value="y/n">Ya/Tidak</option>
                                </select><br><br>

                                <label for="survey_deskripsi">Nomor Urut:</label><br>
                                <input type="text" id="nomor_urut_6" name="nomor_urut_6" required><br><br>

                                <label for="soal_6">Pertanyaan 6:</label><br>
                                <input type="text" id="soal_6" name="soal_6" required><br><br>

                                <label for="jenis_soal_6">Jenis Pertanyaan 6:</label><br>
                                <select id="jenis_soal_6" name="jenis_soal_6" required>
                                    <option value="skala">Skala</option>
                                    <option value="isian">Isian</option>
                                    <option value="y/n">Ya/Tidak</option>
                                </select><br><br>

                                <label for="survey_deskripsi">Nomor Urut:</label><br>
                                <input type="text" id="nomor_urut_7" name="nomor_urut_7" required><br><br>

                                <label for="soal_7">Pertanyaan 7:</label><br>
                                <input type="text" id="soal_7" name="soal_7" required><br><br>

                                <label for="jenis_soal_7">Jenis Pertanyaan 7:</label><br>
                                <select id="jenis_soal_7" name="jenis_soal_7" required>
                                    <option value="skala">Skala</option>
                                    <option value="isian">Isian</option>
                                    <option value="y/n">Ya/Tidak</option>
                                </select><br><br>

                                <label for="survey_deskripsi">Nomor Urut:</label><br>
                                <input type="text" id="nomor_urut_8" name="nomor_urut_8" required><br><br>

                                <label for="soal_8">Pertanyaan 8:</label><br>
                                <input type="text" id="soal_8" name="soal_8" required><br><br>

                                <label for="jenis_soal_8">Jenis Pertanyaan 8:</label><br>
                                <select id="jenis_soal_8" name="jenis_soal_8" required>
                                    <option value="skala">Skala</option>
                                    <option value="isian">Isian</option>
                                    <option value="y/n">Ya/Tidak</option>
                                </select><br><br>

                                <label for="survey_deskripsi">Nomor Urut:</label><br>
                                <input type="text" id="nomor_urut_9" name="nomor_urut_9" required><br><br>

                                <label for="soal_9">Pertanyaan 9:</label><br>
                                <input type="text" id="soal_9" name="soal_9" required><br><br>

                                <label for="jenis_soal_9">Jenis Pertanyaan 9:</label><br>
                                <select id="jenis_soal_9" name="jenis_soal_9" required>
                                    <option value="skala">Skala</option>
                                    <option value="isian">Isian</option>
                                    <option value="y/n">Ya/Tidak</option>
                                </select><br><br>

                                <label for="survey_deskripsi">Nomor Urut:</label><br>
                                <input type="text" id="nomor_urut_10" name="nomor_urut_10" required><br><br>

                                <label for="soal_10">Pertanyaan 10:</label><br>
                                <input type="text" id="soal_10" name="soal_10" required><br><br>

                                <label for="jenis_soal_10">Jenis Pertanyaan 10:</label><br>
                                <select id="jenis_soal_10" name="jenis_soal_10" required>
                                    <option value="skala">Skala</option>
                                    <option value="isian">Isian</option>
                                    <option value="y/n">Ya/Tidak</option>
                                </select><br><br>

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
                    echo '<a href="edit_survei.php?id=' . $row['survey_id'] . '" class="btn-edit">Edit</a>';
                    echo ' | ';
                    echo '<a href="delete_survei.php?id=' . $row['survey_id'] . '" class="btn-delete" onclick="return confirm(\'Anda yakin ingin menghapus survei ini?\')">Delete</a>';
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
    <script>
        document.getElementById('logout-link').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('logout-popup').style.display = 'flex';
        });

        document.getElementById('cancel-logout').addEventListener('click', function() {
            document.getElementById('logout-popup').style.display = 'none';
        });

        document.getElementById('confirm-logout').addEventListener('click', function() {
            window.location.href = '../user/index.php';
        });
    </script>
</body>

</html>