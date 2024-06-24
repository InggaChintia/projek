<?php
require_once 'koneksi.php';

// Tentukan default query
$sql = "SELECT * FROM m_user";
// Tambahkan filter berdasarkan role jika dipilih
if (isset($_GET['role']) && !empty($_GET['role'])) {
    $role = $_GET['role'];
    $sql .= " WHERE role = '$role'";
}

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin User Management</title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            margin-left: 20px;
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

        .detail {
            display: flex;
            flex-direction: column;
            margin-left: 50px;
            margin-top: 30px;
            justify-content: space-between;
        }

        .form-section {
            flex: 2;
            margin-right: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .form-group input {
            width: 50%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .profile-section {
            flex: 0 0 150px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-section img {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 500px;
            margin-left: 500px;
            margin-top: -400px;
        }

        .profile-section label {
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
            margin-left: 500px;
            margin-top: -480px;
        }

        .profile-section a:hover {
            text-decoration: underline;
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
            <a class="nav-link active" href="admin_user.php"><img src="aset/users.png" alt="User Icon">User</a>
            <a class="nav-link" href="admin_datasurvei_dashboard.php"><img src="aset/data.png" alt="Data Survei Icon">Data Survei</a>
            <a class="nav-link" href="admin_survei.php"><img src="aset/survei.png" alt="Survei Icon">Survei</a>
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
            <h2>Detail Pengguna</h2>
            <hr class="nav-divider">
            <div class="filter-section">
                <form action="" method="GET">
                    <div class="form-group">
                        <label for="roleFilter">Filter berdasarkan Role:</label>
                        <select class="form-control" id="roleFilter" name="role">
                            <option value="">Semua Role</option>
                            <option value="mahasiswa">Mahasiswa</option>
                            <option value="ortu">Orang Tua</option>
                            <option value="tendik">Tendik</option>
                            <option value="dosen">Dosen</option>
                            <option value="alumni">Alumni</option>
                            <option value="industri">Industri</option>
                        </select>
                    </div>

                </form>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                if ($row['role'] == "admin") {
                                    continue;
                                }
                                echo "<tr>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['role'] . "</td>";
                                echo "<td>";
                                echo '<button type="button" class="btn btn-info btn-sm detail-btn" data-id="' . $row['user_id'] . '">Detail</button>';
                                echo ' | ';
                                echo '<a href="edit_user.php?user_id=' . $row['user_id'] . '" class="btn btn-primary btn-sm">Edit</a>';
                                echo ' | ';
                                echo '<a href="delete_user.php?user_id=' . $row['user_id'] . '" class="btn btn-danger btn-sm"onclick="return confirm(\'Anda yakin ingin menghapus Data ini?\')">Hapus</a>';
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>Tidak ada data pengguna</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="detailModalBody">
                    <!-- Data detail pengguna akan dimuat di sini -->
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.detail-btn', function() {
                var userId = $(this).data('id'); // Mengambil 'data-id' dari tombol
                $('#detailModalBody').load('detail_user.php?user_id=' + userId, function() {
                    $('#detailModal').modal('show');
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#roleFilter').change(function() {
                var role = $(this).val();
                var url = 'admin_user.php';
                if (role) {
                    url += '?role=' + role;
                }
                window.location.href = url;
            });
        });
    </script>
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