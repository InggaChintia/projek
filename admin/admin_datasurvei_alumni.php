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
        .table-responsive {
            margin-top: 20px;
            margin-left: 20px;
        }
        .table th, .table td {
            text-align: left;
            vertical-align: middle;
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
            <a class="nav-link active" href="admin_datasurvei.php"><img src="aset/data.png" alt="Data Survei Icon">Data Survei</a>
            <a class="nav-link" href="admin_survei.php"><img src="aset/survei.png" alt="Survei Icon">Survei</a>
        </nav>
        <a class="nav-link logout" href="#"><img src="aset/logout.png" alt="Logout Icon">Logout</a>
    </div>
    <div class="content">
        <div class="content-header">
            <h1>  </h1>
            <div class="profile">
                <a class="nav-link" href="admin_profile.html"><img src="aset/profil.jpg" alt="Profile Picture">
                    <span>Admin</span></a>
            </div>
        </div>
        <div class="survey-content">
            <h2>Detail Data Survei Alumni</h2>
            <hr class="nav-divider">
            <div class="search-bar">
                <input type="text" placeholder="Cari">
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Jenis Survei</th>
                            <th>Nama Survei</th>
                            <th>Tanggal</th>
                            <th>Poin</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mahasiswa</td>
                            <td></td>
                            <td>25-11-2024</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Dosen</td>
                            <td></td>
                            <td>25-11-2024</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Mahasiswa</td>
                            <td></td>
                            <td>25-11-2024</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Mahasiswa</td>
                            <td></td>
                            <td>25-11-2024</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Dosen</td>
                            <td></td>
                            <td>25-11-2024</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
</body>
</html>