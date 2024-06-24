<?php
include 'koneksi.php';
$total_bobot = 0;
// Retrieve user input weights or set default values
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai bobot dari form
    $bobot_tangibles = isset($_POST['bobot_tangibles']) ? $_POST['bobot_tangibles'] : 0;
    $bobot_reliability = isset($_POST['bobot_reliability']) ? $_POST['bobot_reliability'] : 0;
    $bobot_responsiveness = isset($_POST['bobot_responsiveness']) ? $_POST['bobot_responsiveness'] : 0;
    $bobot_assurance = isset($_POST['bobot_assurance']) ? $_POST['bobot_assurance'] : 0;
    $bobot_empathy = isset($_POST['bobot_empathy']) ? $_POST['bobot_empathy'] : 0;

    // Validasi bobot (pastikan jumlah bobot total = 1)
    $total_bobot = $bobot_tangibles + $bobot_reliability + $bobot_responsiveness + $bobot_assurance + $bobot_empathy;

    if ($total_bobot != 1) {
        echo "
        <script>
        document.addEventListener('DOMContentLoaded', function() {
        $('#errorModal').modal('show');
        });
        </script>
        ";
    } else {
        // Ambil data poin kategori dari database
        $sql = "SELECT kategori_id, AVG(average_jawaban) AS avg_jawaban FROM average_jawaban_per_kategori_4 GROUP BY kategori_id";
        $result = $conn->query($sql);

        $poinKategori = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $poinKategori[] = $row;
            }
        } else {
            echo "0 results";
        }

        // Fungsi untuk mendapatkan nama kategori berdasarkan ID
        function getKategoriName($kategori_id)
        {
            $kategoriNames = [
                1 => 'Fasilitas',
                2 => 'Akademik',
                3 => 'Pelayanan',
                4 => 'Alumni'
            ];
            return isset($kategoriNames[$kategori_id]) ? $kategoriNames[$kategori_id] : 'Unknown';
        }

        $sql = "SELECT * FROM average_jawaban_per_kategori_4";
        $result = $conn->query($sql);

        // Inisialisasi matriks keputusan

        $matriks_keputusan = [
            'fasilitas' => [],
            'akademik' => [],
            'pelayanan' => [],
            'alumni' => []
        ];

        // Memproses hasil query menjadi matriks keputusan
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Isi matriks keputusan berdasarkan kategori_id dan no_urut
                switch ($row['kategori_id']) {
                    case 1: // fasilitas
                        if ($row['no_urut'] >= 1 && $row['no_urut'] <= 2) {
                            $matriks_keputusan['fasilitas'][0] = $row['average_jawaban'];
                        } elseif ($row['no_urut'] >= 3 && $row['no_urut'] <= 4) {
                            $matriks_keputusan['fasilitas'][1] = $row['average_jawaban'];
                        } elseif ($row['no_urut'] >= 5 && $row['no_urut'] <= 6) {
                            $matriks_keputusan['fasilitas'][2] = $row['average_jawaban'];
                        } elseif ($row['no_urut'] >= 7 && $row['no_urut'] <= 8) {
                            $matriks_keputusan['fasilitas'][3] = $row['average_jawaban'];
                        } elseif ($row['no_urut'] >= 9 && $row['no_urut'] <= 10) {
                            $matriks_keputusan['fasilitas'][4] = $row['average_jawaban'];
                        }
                        break;
                    case 2: // akademik
                        if ($row['no_urut'] >= 1 && $row['no_urut'] <= 2) {
                            $matriks_keputusan['akademik'][0] = $row['average_jawaban'];
                        } elseif ($row['no_urut'] >= 3 && $row['no_urut'] <= 4) {
                            $matriks_keputusan['akademik'][1] = $row['average_jawaban'];
                        } elseif ($row['no_urut'] >= 5 && $row['no_urut'] <= 6) {
                            $matriks_keputusan['akademik'][2] = $row['average_jawaban'];
                        } elseif ($row['no_urut'] >= 7 && $row['no_urut'] <= 8) {
                            $matriks_keputusan['akademik'][3] = $row['average_jawaban'];
                        } elseif ($row['no_urut'] >= 9 && $row['no_urut'] <= 10) {
                            $matriks_keputusan['akademik'][4] = $row['average_jawaban'];
                        }
                        break;
                    case 3: // pelayanan
                        if ($row['no_urut'] >= 1 && $row['no_urut'] <= 2) {
                            $matriks_keputusan['pelayanan'][0] = $row['average_jawaban'];
                        } elseif ($row['no_urut'] >= 3 && $row['no_urut'] <= 4) {
                            $matriks_keputusan['pelayanan'][1] = $row['average_jawaban'];
                        } elseif ($row['no_urut'] >= 5 && $row['no_urut'] <= 6) {
                            $matriks_keputusan['pelayanan'][2] = $row['average_jawaban'];
                        } elseif ($row['no_urut'] >= 7 && $row['no_urut'] <= 8) {
                            $matriks_keputusan['pelayanan'][3] = $row['average_jawaban'];
                        } elseif ($row['no_urut'] >= 9 && $row['no_urut'] <= 10) {
                            $matriks_keputusan['pelayanan'][4] = $row['average_jawaban'];
                        }
                        break;
                    case 4: // alumni
                        if ($row['no_urut'] >= 1 && $row['no_urut'] <= 2) {
                            $matriks_keputusan['alumni'][0] = $row['average_jawaban'];
                        } elseif ($row['no_urut'] >= 3 && $row['no_urut'] <= 4) {
                            $matriks_keputusan['alumni'][1] = $row['average_jawaban'];
                        } elseif ($row['no_urut'] >= 5 && $row['no_urut'] <= 6) {
                            $matriks_keputusan['alumni'][2] = $row['average_jawaban'];
                        } elseif ($row['no_urut'] >= 7 && $row['no_urut'] <= 8) {
                            $matriks_keputusan['alumni'][3] = $row['average_jawaban'];
                        } elseif ($row['no_urut'] >= 9 && $row['no_urut'] <= 10) {
                            $matriks_keputusan['alumni'][4] = $row['average_jawaban'];
                        }
                        break;
                    default:
                        break;
                }
            }
        }

        // Fungsi untuk menghitung ranking
        function hitungRanking($kategori_id, $bobot)
        {
            global $conn;
            // Kriteria dan range nomor urut
            $kriteria = [
                'Tangible' => [1, 2],
                'Reliability' => [3, 4],
                'Responsiveness' => [5, 6],
                'Assurance' => [7, 8],
                'Empathy' => [9, 10]
            ];

            // Hitung rata-rata jawaban untuk setiap kriteria
            $average_rank = [];

            foreach ($kriteria as $kriteria_nama => $range_urut) {
                $sql = "SELECT AVG(average_jawaban) AS rata_rata
                        FROM average_jawaban_per_kategori_4
                        WHERE kategori_id = $kategori_id
                        AND no_urut BETWEEN $range_urut[0] AND $range_urut[1]";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $average_jawaban = $row['rata_rata'];
                        $average_rank[$kriteria_nama] = $average_jawaban * $bobot[$kriteria_nama];
                    }
                } else {
                    $average_rank[$kriteria_nama] = 0;
                }
            }

            // Hitung total rank
            $total_rank = array_sum($average_rank);

            return $total_rank;
        }

        // Proses untuk setiap kategori
        $kategoris = [1, 2, 3, 4];
        $rankedKategori = [];
        foreach ($kategoris as $kategori_id) {
            $bobot = [
                'Tangible' => $bobot_tangibles,
                'Reliability' => $bobot_reliability,
                'Responsiveness' => $bobot_responsiveness,
                'Assurance' => $bobot_assurance,
                'Empathy' => $bobot_empathy
            ];
            $ranking = hitungRanking($kategori_id, $bobot);
            $rankedKategori[$kategori_id] = $ranking;
        }
        asort($rankedKategori);
    }
}
?>

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

        .content-header .profile img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
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

        .table-container,
        .table-priority,
        .table-rank-per-kategori {
            width: 48%;
            margin-bottom: 50px;
        }

        .table-container table,
        .table-priority table,
        .table-rank-per-kategori table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th,
        .table-container td,
        .table-priority th,
        .table-priority td,
        .table-rank-per-kategori th,
        .table-rank-per-kategori td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
            vertical-align: middle;
            margin-right: 20px;
        }

        .table-container th,
        .table-priority th,
        .table-rank-per-kategori th {
            background-color: #f2f2f2;
        }

        .tables-wrapper {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top: 20px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="navbar-vertical">
        <img src="aset/logopolinema.png" alt="Polinema Logo">
        <p>Survei Polinema</p>
        <hr class="nav-divider">
        <nav class="nav flex-column mt-4">
            <a class="nav-link active" href="#"><img src="aset/overview.png" alt="Overview Icon">Overview</a>
            <a class="nav-link" href="admin_user.php"><img src="aset/users.png" alt="User Icon">User</a>
            <a class="nav-link" href="admin_datasurvei_dashboard.php"><img src="aset/data.png" alt="Data Survei Icon">Data Survei</a>
            <a class="nav-link" href="admin_survei.php"><img src="aset/survei.png" alt="Survei Icon">Survei</a>
        </nav>
        <a id="logout-link" class="nav-link logout" href="../user/index.php">
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
            <h1></h1>
            <div class="profile">
                <a class="nav-link" href="#">
                    <span>Admin</span></a>
            </div>
        </div>
        <div class="survey-content">
            <h2>Overview</h2>
            <hr class="nav-divider">
            <br>
            <!-- Weight Input Form -->
            <form method="POST" action="">
                <div class="form-group">
                    <label for="bobot_tangibles">Weight for Tangibles:</label>
                    <input type="number" class="form-control" id="bobot_tangibles" name="bobot_tangibles" value="<?php echo htmlspecialchars($bobot_tangibles ?? '0.2'); ?>" step="0.01" min="0" max="1" required>
                </div>
                <div class="form-group">
                    <label for="bobot_reliability">Weight for Reliability:</label>
                    <input type="number" class="form-control" id="bobot_reliability" name="bobot_reliability" value="<?php echo htmlspecialchars($bobot_reliability ?? '0.25'); ?>" step="0.01" min="0" max="1" required>
                </div>
                <div class="form-group">
                    <label for="bobot_responsiveness">Weight for Responsiveness:</label>
                    <input type="number" class="form-control" id="bobot_responsiveness" name="bobot_responsiveness" value="<?php echo htmlspecialchars($bobot_responsiveness ?? '0.2'); ?>" step="0.01" min="0" max="1" required>
                </div>
                <div class="form-group">
                    <label for="bobot_assurance">Weight for Assurance:</label>
                    <input type="number" class="form-control" id="bobot_assurance" name="bobot_assurance" value="<?php echo htmlspecialchars($bobot_assurance ?? '0.2'); ?>" step="0.01" min="0" max="1" required>
                </div>
                <div class="form-group">
                    <label for="bobot_empathy">Weight for Empathy:</label>
                    <input type="number" class="form-control" id="bobot_empathy" name="bobot_empathy" value="<?php echo htmlspecialchars($bobot_empathy ?? '0.15'); ?>" step="0.01" min="0" max="1" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit Weights</button>
            </form>

            <hr class="nav-divider">

            <!-- Wrapper for tables -->
            <div class="tables-wrapper">
                <?php
                if ($total_bobot == 1) {
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Display Matriks Keputusan
                        echo '<div class="table-priority">';
                        echo '<h3>Matriks Keputusan</h3>';
                        echo '<table>';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>kategori</th><th>Tangibles</th><th>Reliability</th><th>Responsiveness</th><th>Assurance</th><th>Empathy</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        foreach ($matriks_keputusan as $kategori => $data) {
                            echo '<tr>';
                            echo "<td>$kategori</td>";
                            foreach ($data as $nilai) {
                                echo "<td>" . number_format($nilai, 3, '.', '') . "</td>";
                            }
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
                        echo '</div>';

                        // Display Urutan Prioritas
                        echo '<div class="table-priority">';
                        echo '<h3>Urutan Prioritas</h3>';
                        echo '<table>';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>No</th>';
                        echo '<th>Kategori</th>';
                        echo '<th>Score</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        $i = 1;
                        foreach ($rankedKategori as $kategori_id => $score) {
                            echo '<tr>';
                            echo '<td>' . $i . '</td>';
                            echo '<td>' . htmlspecialchars(getKategoriName($kategori_id)) . '</td>';
                            echo '<td>' . number_format($score, 2, '.', '') . '</td>';
                            echo '</tr>';
                            $i++;
                        }
                        echo '</tbody>';
                        echo '</table>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Total bobot harus sama dengan 1.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
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