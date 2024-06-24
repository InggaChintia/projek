<?php
include 'koneksi.php';
$sql = "SELECT kategori_id, AVG(average_jawaban) AS avg_jawaban FROM average_jawaban_per_kategori_4 GROUP BY kategori_id";
$result = $conn->query($sql);

$poinKategori = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $poinKategori[] = $row;
    }
} else {
    echo "0 results";
}
function getKategoriName($kategori_id) {
    $kategoriNames = [
        1 => 'Fasilitas',
        2 => 'Akademik',
        3 => 'Pelayanan',
        4 => 'Alumni'
    ];
    return isset($kategoriNames[$kategori_id]) ? $kategoriNames[$kategori_id] : 'Unknown';
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
        .table-container, .table-priority, .table-rank-per-kategori {
            width: 48%;
            margin-bottom: 50px;
        }
        .table-container table, .table-priority table, .table-rank-per-kategori table {
            width: 100%;
            border-collapse: collapse;
        }
        .table-container th, .table-container td, .table-priority th, .table-priority td, .table-rank-per-kategori th, .table-rank-per-kategori td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
            vertical-align: middle;
            margin-right: 20px;
        }
        .table-container th, .table-priority th, .table-rank-per-kategori th {
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
        <a class="nav-link logout" href="../user/user_registrasi.php"><img src="aset/logout.png" alt="Logout Icon">Logout</a>
    </div>
    <div class="content">
        <div class="content-header">
            <h1>  </h1>
            <div class="profile">
                <a class="nav-link" href="#">
                <span>Admin</span></a>
            </div>
        </div>
        <div class="survey-content">
            <h2>Overview</h2>
            <hr class="nav-divider">

            <!-- Wrapper untuk dua tabel -->
            <div class="tables-wrapper">
                <!-- Tabel Poin Kategori -->
                <div class="table-container">
                   
            <h3>Poin Kategori</h3>
            <table>
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th>Average Jawaban</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($poinKategori as $kategori): ?>
                    <tr>
                        <td><?php echo htmlspecialchars(getKategoriName($kategori['kategori_id'])); ?></td>
                        <td><?php echo htmlspecialchars($kategori['avg_jawaban']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

            <!-- Tabel Urutan Prioritas -->
            <div class="table-priority">
            <h3>Urutan Prioritas</h3>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Sort the categories by average score in ascending order
                    usort($poinKategori, function($a, $b) {
                        return $a['avg_jawaban'] <=> $b['avg_jawaban'];
                    });
                    foreach ($poinKategori as $index => $kategori): ?>
                    <tr>
                    <td><?php echo ($index + 1) . '.'; ?></td>
                    <td><?php echo htmlspecialchars(getKategoriName($kategori['kategori_id'])); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
            </div>
        </div>
    </div>
</body>
</html>
