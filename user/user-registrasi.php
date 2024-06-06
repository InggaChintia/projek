<?php
ob_start();
session_start();

require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $password = $_POST['password']; // Encrypt the password
    $role = $_POST['role'];

    $sql = "INSERT INTO m_user (username, nama, password, role) VALUES (?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssss", $username, $nama, $password, $role);

        if ($stmt->execute()) {
            header("Location: user-isidatadiri.php?nama=" . urlencode($nama) . "&role=" . urlencode($role));
            exit();
        } else {
            //    echo "Something went wrong. Please try again later.";
        }

        $stmt->close();
    }

    $conn->close();
}

ob_end_flush();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Daftar Akun</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style type="text/css">
        body {
            background-color: #f8f9fa;
        }

        .card {
            margin-top: 100px;
        }

        .btn-custom {
            background-color: #304C65;
            color: white;
            border-radius: 16px;
            width: 90px;
            text-align: center;
        }

        .btn-custom:hover {
            background-color: #203040;
        }

        .btn-secondary-custom {
            border-radius: 16px;
            width: 90px;
            text-align: center;
            background-color: #6c757d;
            color: white;
            border: none;
        }

        .btn-secondary-custom:hover {
            background-color: #5a6268;
        }
    </style>
</head>

<body>
    <div class="min-vh-100">
        <div class="row no-gutters min-vh-100">
            <div class="col-4">
                <div class="w-100 h-100 pl-5 pr-5" style="background-color: #304C65; position: relative;">
                    <div style="height: 150px; width: 70px; background-color: #FCF4E7; float: right; border-bottom-left-radius: 50px; border-bottom-right-radius: 50px; opacity: 0.5;"></div>
                    <div id="p" class="min-vh-100 d-flex flex-column justify-content-center my-auto">
                        <img src="aset/logopolinema.png" alt="img-clock" style="width: 200px">
                        <p style="font-weight: 800; font-size: 28px; margin: 10px 0 0 0; color: white;">SISKEPEL POLINEMA</p>
                        <p style="font-weight: 700; font-size: 18px; margin: 5px 0 0 0; color: white;">A Better Way to Grow</p>
                    </div>
                    <div style="position: absolute; bottom: 0; height: 150px; width: 70px; background-color: #FCF4E7; border-top-left-radius: 50px; border-top-right-radius: 50px; opacity: 0.5;"></div>
                </div>
            </div>
            <div class="col-8">
                <div class="container">
                    <div class="min-vh-100">
                        <div class="p-4">
                            <img src="{{ asset('img/logo_pgb.png') }}" width="50px" style="display: block; margin: 0 0 0 auto;" alt="">
                        </div>
                        <div class="d-flex align-items-center" style="padding-left: 130px; padding-top: 80px;">
                            <form id="registerForm" method="POST" class="user">
                                <input type="hidden" name="_token" value="csrf_token">
                                <p style="font-weight: 800; font-size: 30px; margin: 0; color: #0D2A0D;">Daftar Akun</p>
                                <p class="mb-3" style="font-weight: 500; font-size: 18px; margin: 0; color: #0D2A0D;">Buat Akun Anda</p>
                                <div class="form-group">
                                    <label for="nama" style="font-weight: bold; color: #0D2A0D;">Nama <span style="color: red;">*</span></label>
                                    <input type="text" id="nama" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="nama" placeholder="Masukkan Nama Anda" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="username" style="font-weight: bold; color: #0D2A0D;">Username <span style="color: red;">*</span></label>
                                    <input type="text" id="username" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="username" placeholder="Masukkan Username Anda" required>
                                </div>
                                <div class="form-group">
                                    <label for="password" style="font-weight: bold; color: #0D2A0D;">Password <span style="color: red;">*</span></label>
                                    <input type="password" id="password" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="password" placeholder="Masukkan Password Anda" required>
                                </div>
                                <div class="form-group">
                                    <label for="role" style="font-weight: bold; color: #0D2A0D;">Role <span style="color: red;">*</span></label>
                                    <select id="role" class="form-control form-control-user" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" name="role" required>
                                        <option value="" disabled selected>Pilih Peran Anda</option>
                                        <option value="mahasiswa">Mahasiswa</option>
                                        <option value="dosen">Dosen</option>
                                        <option value="tendik">Tendik</option>
                                        <option value="alumni">Alumni</option>
                                        <option value="ortu">Orang Tua</option>
                                        <option value="industri">Industri</option>
                                    </select>
                                </div>
                                <div class="d-flex align-items-center" style="padding-left: 130px; padding-top: 80px;">
                                    <button type="submit" value="register" class="btn btn-user btn-block mt-3" style="width: 90px; background-color: #304C65; color: white; text-align: center; text-decoration: none;">
                                        Lanjut</button>
                                </div>
                                <div class="d-flex align-items-center" style="padding-left: 130px; padding-top: 30px;">
                                    <a href="user-login.php" class="btn btn-user btn-block" style="width: 90px; background-color: #304C65; color: white; text-align: center; text-decoration: none;">
                                        Masuk</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>