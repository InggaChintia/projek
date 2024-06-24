<?php
require_once 'koneksi.php';

// Updated query to fetch and aggregate data
$sql = "SELECT 
            r.responden_nama, 
            s.survey_nama, 
            r.responden_tanggal, 
            SUM(j.jawaban) as total_points,
            r.responden_tendik_id,
            r.responden_nopeg,
            r.responden_unit
        FROM 
            t_responden_tendik r
        JOIN 
            t_jawaban_tendik j ON r.responden_tendik_id = j.responden_tendik_id
        JOIN 
            m_survey_soal ms ON j.soal_id = ms.soal_id
        JOIN 
            m_survey s ON ms.survey_id = s.survey_id AND r.survey_id = s.survey_id
        GROUP BY 
            r.responden_nama, 
            s.survey_nama, 
            r.responden_tanggal,
            r.responden_tendik_id,
            r.responden_nopeg,
            r.responden_unit";

$result = $conn->query($sql);

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
        .table-responsive {
            margin-top: 20px;
            margin-left: 20px;
            margin-right: 50px;
            width: 1400px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
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
        .search-bar input {
            padding: 8px 12px;
            border-radius: 10px;
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
        .table .dropdown-menu {
            min-width: 100px;
        }
        .table .profile-pic {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .table .user-info {
            display: flex;
            align-items: center;
        }
        .table .user-info span {
            margin-left: 10px;
        }
        .survey-content button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }
        .survey-content button:hover {
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
            <a class="nav-link" href="admin_user.php"><img src="aset/users.png" alt="User Icon">User</a>
            <a class="nav-link active" href="admin_datasurvei_dashboard.php"><img src="aset/data.png" alt="Data Survei Icon">Data Survei</a>
            <a class="nav-link" href="admin_survei.php"><img src="aset/survei.png" alt="Survei Icon">Survei</a>
        </nav>
        <a class="nav-link logout" href="../user/user_registrasi.php"><img src="aset/logout.png" alt="Logout Icon">Logout</a>
    </div>
    <div class="content">
        <div class="content-header">
            <h1></h1>
            <div class="profile">
                <a class="nav-link" href="#"><span>Admin</span></a>
            </div>
        </div>
        <div class="survey-content">
            <h2>Detail Data Survei Tenaga Pendidik</h2>
            <hr class="nav-divider">
            <div class="search-bar">
                <input type="text" placeholder="Cari">
            </div>

            <?php if ($result->num_rows == 0) : ?>
                <div>
                    <h3>Survei belum diisi, Hubungi admin</h3>
                </div>
            <?php else : ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Nama Survei</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                <th>Total Poin</th>
                                <th>Detail Profil</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) : ?>
                                <tr>
                                    <td><?php echo $row["responden_nama"]; ?></td>
                                    <td><?php echo $row["survey_nama"]; ?></td>
                                    <td>Tendik</td>
                                    <td><?php echo $row["responden_tanggal"]; ?></td>
                                    <td><?php echo $row["total_points"]; ?></td>
                                    <td>
                                        <button class="btn btn-info" data-toggle="modal" data-target="#userModal<?php echo $row['responden_tendik_id']; ?>">Lihat Profil</button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="userModal<?php echo $row['responden_tendik_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="userModalLabel">Detail Profil</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Nama:</strong> <?php echo $row['responden_nama']; ?></p>
                                                        <p><strong>No.Pegawai:</strong> <?php echo $row['responden_nopeg']; ?></p>
                                                        <p><strong>Unit:</strong> <?php echo $row['responden_unit']; ?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <button onclick="history.back()">Kembali</button>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>