<?php
session_start();
require_once '../admin/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM m_user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if ($password == $row["password"]) { 
            $_SESSION["username"] = $row["username"];
            $_SESSION["user_id"] = $row["user_id"];
            $role = $row["role"]; 
            
            if ($role === "admin") {
                header("Location: ../admin/admin_overview.php?username=" . urlencode($username) . "&role=" . urlencode($role));
            } else {
                header("Location: user-dashboard.php?username=" . urlencode($username) . "&role=" . urlencode($role));
            }
            exit();
        } else {
            $error = "Password tidak valid.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }

    $stmt->close();
    $conn->close();
}

ob_end_flush();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Masuk</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style type="text/css">
        body {
            background-color: #f8f9fa;
        }

        .card {
            margin-top: 100px;
        }
    </style>
</head>

<body>
    <div class="min-vh-100">
        <div class="row no-gutters min-vh-100">
            <div class="col-4">
                <div class="w-100 h-100 pl-5 pr-5" style="background-color: #304C65; position: relative;">
                    <div style="height: 150px; width: 70px; background-color: #FCF4E7; float: right; border-bottom-left-radius: 50px; border-bottom-right-radius: 50px; opacity: 0.5;">
                    </div>
                    <div id="p" class="min-vh-100 d-flex flex-column justify-content-center my-auto">
                        <img src="aset/logopolinema.png" alt="img-clock" style="width: 200px">
                        <p style="font-weight: 800; font-size: 28px; margin: 10px 0 0 0; color: white;">SISKEPEL POLINEMA</p>
                        <p style="font-weight: 700; font-size: 18px; margin: 5px 0 0 0; color: white;">A Better Way to Grow</p>
                    </div>
                    <div style="position: absolute; bottom: 0; height: 150px; width: 70px; background-color: #FCF4E7; border-top-left-radius: 50px; border-top-right-radius: 50px; opacity: 0.5;">
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="container">
                    <div class="min-vh-100">
                        <div class="p-4">
                            <img src="aset/logo_pgb.png" width="50px" style="display: block; margin: 0 0 0 auto;" alt="">
                        </div>
                        <div class="d-flex align-items-center" style="padding-left: 130px; padding-top: 80px;">
                            <form id="loginForm" method="POST" class="user">
                                <input type="hidden" name="_token" value="csrf_token">
                                <p style="font-weight: 800; font-size: 30px; margin: 0; color: #0D2A0D;">Masuk</p>
                                <p class="mb-3" style="font-weight: 500; font-size: 18px; margin: 0; color: #0D2A0D;">Masuk dengan akun Anda</p>

                                <div class="form-group">
                                    <input type="text" id="username" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="username" placeholder="Masukkan Username Anda" required autofocus>
                                    <span></span>
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" name="password" placeholder="Masukkan Password Anda" required>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small ml-2">
                                        <input type="checkbox" class="custom-control-input" name="remember" id="remember">
                                        <label class="custom-control-label" for="remember">Ingat Saya</label>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center" style="padding-left: 130px; padding-top: 80px;">
                                    <button type="submit" value="register" class="btn btn-user btn-block mt-3" style="width: 90px; background-color: #304C65; color: white; text-align: center; text-decoration: none;">
                                        Lanjut</button>
                                </div>
                                <div class="d-flex align-items-center" style="padding-left: 130px; padding-top: 30px;">
                                    <a href="user_registrasi.php" class="btn btn-user btn-block" style="width: 90px; background-color: #304C65; color: white; text-align: center; text-decoration: none;">
                                        Daftar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal: Username Tidak Terdaftar -->
    <div class="modal fade" id="usernameNotFoundModal" tabindex="-1" role="dialog" aria-labelledby="usernameNotFoundModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="usernameNotFoundModalLabel">Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Username atau Password Anda salah.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal: Password Salah -->
    <div class="modal fade" id="wrongPasswordModal" tabindex="-1" role="dialog" aria-labelledby="wrongPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wrongPasswordModalLabel">Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Password tidak valid.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            <?php if ($error == "Username tidak ditemukan."): ?>
                console.log("Username tidak ditemukan modal dipanggil");
                $('#usernameNotFoundModal').modal('show');
            <?php elseif ($error == "Password tidak valid."): ?>
                console.log("Password tidak valid modal dipanggil");
                $('#wrongPasswordModal').modal('show');
            <?php endif; ?>
        });
    </script>

</body>

</html>
