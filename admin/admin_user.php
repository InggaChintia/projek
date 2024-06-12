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
            font-weight: bold;
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
            font-weight: 700px;
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
        }
        /* Styling untuk tabel */
        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }
        .table th, .table td {
            padding: 12px 15px;
            text-align: left;
            vertical-align: middle;
            border-bottom: 1px solid #ddd;
            max-width: 100%;
        }
        /* Header tabel */
        .table thead th {
            background-color: #304C65;
            color: white;
            letter-spacing: 0.1em;
            font-size: 14px;
            padding: 15px;
            width: 800px;
        }
        /* Ukuran kolom header */
        .table thead th:first-child {
            width: 50%;
        }

        .table thead th:nth-child(2) {
            width: 50%;
        }

        /* Body tabel */
        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Hover efek pada baris tabel */
        .table tbody tr:hover {
            background-color: #e0e0e0;
        }
        /* Tombol */
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
        /* Bar pencarian */
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
        /* Informasi pengguna dalam tabel */
        .table .user-info {
            display: flex;
            align-items: center;
        }
        .table .user-info span {
            margin-left: 10px;
        }
        /* Bagian filter */
        .filter-section {
            padding: 20px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .filter-section h3 {
            margin-top: 10px;
            font-size: 20px;
            font-weight: bold;
            margin-left: 20px;
        }
        .filter-group {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        .filter-group label {
            margin-right: 10px;
            margin-left: 20px;
            font-size: 16px;
        }
        .filter-group select {
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #ccc;
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
        <a class="nav-link logout" href="../user/user_registrasi.php"><img src="aset/logout.png" alt="Logout Icon">Logout</a>
    </div>
    <div class="content">
        <div class="content-header">
            <h1>  </h1>
            <div class="profile">
                <a class="nav-link" href="admin_profile.html"><span>Admin</span></a>
            </div>
        </div>
        <div class="survey-content">
            <h2>Detail Pengguna</h2>
            <hr class="nav-divider">
            <div class="filter-section">
            <div>
                <h3>Filter</h3><br>
                <div class="filter-group">
                    <label for="role">Role:</label>
                    <select id="role" name="role">
                        <option value="" disabled selected>Pilih</option>
                        <option value="mahasiswa">Mahasiswa</option>
                        <option value="Dosen">Dosen</option>
                        <option value="Tendik">Tendik</option>
                        <option value="Alumni">Alumni</option>
                        <option value="ortu">OrangTua/Wali Mahasiswa</option>
                        <option value="Industri">Industri</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        require_once 'koneksi.php';

                        // Query untuk mengambil data dari m_user_data
                        $query = "SELECT nama, role FROM m_user_data WHERE role= role";
                        $result = $conn->query($query);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='user-info'><span>" . $row["nama"] . "</span></td>";
                                echo "<td>" . $row["role"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>Tidak ada data ditemukan</td></tr>";
                        }

                        $conn->close();
                    ?>
                    </tbody>
                </table>
            </div>            
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#role').on('change', function(){
                var selectedRole = $(this).val();
                
                // Tampilkan nilai role yang dipilih
                console.log("Role yang dipilih: " + selectedRole);

                $.ajax({
                    url: 'tampil_data_user.php',
                    type: 'POST',
                    data: {role: selectedRole},
                    success: function(data){
                        $('tbody').html(data);
                    }
                });
            });
        });
    </script>
</body>
</html>