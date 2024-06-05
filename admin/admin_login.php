<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
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
        <div class="row row no-gutters min-vh-100">
            <div class="col-4">
                <div class="w-100 h-100 pl-5 pr-5" style="background-color: #304C65; position: relative;">
                    <div style="height: 150px; width: 70px; background-color: #FCF4E7; float: right; border-bottom-left-radius: 50px; border-bottom-right-radius: 50px; opacity: 0.5;">
                    </div>
                    <div id="p" class="min-vh-100 d-flex flex-column justify-content-center my-auto">
                        <img src="aset\logopolinema.png" alt="img-clock" style="width: 200px">
                        <p style="font-weight: 800; font-size: 28px; margin: 10px 0 0 0; color: white;">POLITEKNIK NEGRI MALANG</p>
                        <p style="font-weight: 700; font-size: 18px; margin: 5px 0 0 0; color: white;">A better way to grow</p>
                    </div>
                    <div style="position: absolute; bottom: 0; height: 150px; width: 70px; background-color: #FCF4E7; border-top-left-radius: 50px; border-top-right-radius: 50px; opacity: 0.5;">
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="container">
                    <div class="min-vh-100">
                        <div class="p-4">
                            <img src="{{ asset('img/logo_pgb.png') }}" width="50px" style="display: block; margin: 0 0 0 auto;" alt="">
                        </div>
                        <div class="d-flex align-items-center" style="padding-left: 130px; padding-top: 80px;">
                            <form method="POST" action="login" class="user">
                                <input type="hidden" name="_token" value="csrf_token">
                                <p style="font-weight: 800; font-size: 30px; margin: 0; color: #0D2A0D;">Login</p>
                                <p class="mb-3" style="font-weight: 500; font-size: 18px; margin: 0; color: #0D2A0D;">Masuk dengan akun Anda</p>

                                <div class="form-group">
                                    <input type="email" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" 
                                    class="form-control form-control-user" name="email" placeholder="Masukkan Username" value="" required autofocus>
                                    <span></span>
                                </div>


                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" 
                                    name="password" placeholder="Masukkan Password" required>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small ml-2">
                                        <input type="checkbox" class="custom-control-input" name="remember" id="remember">
                                        <label class="custom-control-label" for="remember">Remember Me</label>
                                    </div>
                                </div>
                                <div class="d-flex align-items-left">
                                    <a href="admin_overview.php" class="btn btn-user btn-block mt-3" style="width: 90px; background-color: #304C65; color: white; text-align: center; text-decoration: none;">
                                        Login
                                    </a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


</body>

</html>