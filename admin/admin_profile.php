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
        .navbar-vertical .nav-link img {
            width: 20px;
            height: 20px;
            margin-top: 10px;
            padding: 3px;
            margin-right: 10px;
            margin-bottom: 10px;
        }
        .navbar-vertical p {
            margin: 0;
            font-weight: bold;
            text-align: center;
            position: relative;
            margin-top: -5px;
            font-size: 20px;
        }
        .navbar-vertical .nav-link {
            color: #304C65;
            font-weight: 700;
            padding: 0px;
            display: flex;
            align-items: center;
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
            background-color: white;
        }
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            padding: 8px 20px;
            color: white;
        }
        .content-header .profile {
            display: flex;
            align-items: center;
            color: black;
            font-size: 14px;
        }
        .content-header .profile img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .survey-content {
            padding: 32px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .survey-content h2 {
            margin-bottom: 20px;
            margin-left: 50px;
            font-weight: bold;
            font-size: 20px;
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
        <!-- <img src="aset/logopolinema.png" alt="Polinema Logo"> -->
        <p>Data Survei Polinema</p>
        <hr class="nav-divider">
        <nav class="nav flex-column mt-4">
            <a class="nav-link" href="admin_overview.html"><img src="aset/overview.png" alt="Overview Icon">Overview</a>
            <a class="nav-link" href="admin_user_dashboard.php"><img src="aset/users.png" alt="User Icon">User</a>
            <a class="nav-link" href="admin_datasurvei_dashboard.php"><img src="aset/data.png" alt="Data Survei Icon">Data Survei</a>
            <a class="nav-link" href="admin_survei.html"><img src="aset/survei.png" alt="Survei Icon">Survei</a>
        </nav>
        <a class="nav-link logout" href="#"><img src="aset/logout.png" alt="Logout Icon">Logout</a>
    </div>
    <div class="content">
        <div class="content-header">
            <h1>  </h1>
            <div class="profile">
                <a class="nav-link active" href="#"><img src="aset/profil.jpg" alt="Profile Picture">Admin</a>
            </div>
        </div>
        <div class="survey-content">
            <h2>Detail Data Admin</h2>
            <section class="detail">
                <div class="form-section">
                    <div class="form-group">
                        <label for="nama">Nama Admin</label>
                        <input type="text" id="nama" value="Admin 1" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" value="Admin1@gmail.com" readonly>
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor handphone</label>
                        <input type="text" id="phone" value="08981313335" readonly>
                    </div>
                    <div class="form-group">
                        <label for="gender">Jenis kelamin</label>
                        <input type="text" id="gender" value="Pria" readonly>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat rumah</label>
                        <input type="text" id="address" value="Jl Sidomulyo No 8, Manukan, Condongcatur, Sleman" readonly>
                    </div>
                </div>
                <div class="profile-section">
                    <img src="aset/profil.jpg" alt="Admin Profile Picture">
                    <label for="uploadFoto">Edit Foto</label>
                    <input type="file" id="uploadFoto" style="display: none;">
                </div>                
            </section>
        </div>
        
    </div>
</body>
</html>