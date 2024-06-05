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
            width: 60px;
            margin-bottom: 10px;
        }
        .navbar-vertical p {
            margin: 0;
            font-weight: bold;
            text-align: center;
            position: relative;
            margin-top: -50px;
            margin-left: 50px;
        }
        .navbar-vertical .nav-link {
            color: #304C65;
            font-weight: 700;
            padding: 10px;
            display: block;
            border-radius: 5px;
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
            padding: 10px 20px;
            color: white;
        }
        .content-header .profile {
            display: flex;
            align-items: center;
        }
        .content-header .profile img {
            width: 40px;
            height: 40px;
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
        }
        .survey-content button {
            background-color: #304C65;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .survey-content button:hover {
            background-color: #203040;
        }
    </style>
</head>
<body>
    <div class="navbar-vertical">
        <img src="aset/logopolinema.png" alt="Polinema Logo">
        <p>Survei Polinema</p>
        <nav class="nav flex-column mt-4">
            <a class="nav-link active" href="#">Overview</a>
            <a class="nav-link" href="#">User</a>
            <a class="nav-link" href="#">Data Survei</a>
            <a class="nav-link" href="#">Laporan Survei</a>
        </nav>
        <a class="nav-link logout" href="#">Logout</a>
    </div>
    <div class="content">
        <div class="content-header">
            <h1>  </h1>
            <div class="profile">
                <img src="aset/profil.jpg" alt="Profile Picture">
                <span>Bayu</span>
            </div>
        </div>
        
        <div class="survey-content">
            <h2>Isi Survei sekarang</h2>
            <button>Lakukan survei</button>
        </div>
    </div>
</body>
</html>