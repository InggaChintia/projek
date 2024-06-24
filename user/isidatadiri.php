<?php
session_start();
include 'connection.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$role = isset($_GET['role']) ? $_GET['role'] : '';
$nama = isset($_GET['nama']) ? $_GET['nama'] : '';

if (!$role && !$nama) {
    die("Invalid role or nama. Please contact the administrator.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];
    $nama = $_POST['nama'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $role = $_POST['role'];
    $nim = $_POST['nim'] ?? "";
    $email = $_POST['email'] ?? "";
    $jurusan = $_POST['jurusan'] ?? "";
    $no_telp = $_POST['no_telp'] ?? "";
    $tahun_masuk = $_POST['tahun_masuk'] ?? "";
    $nip = $_POST['nip'] ?? "";
    $unit = $_POST['unit'] ?? "";
    $no_peg = $_POST['no_peg'] ?? "";
    $jenis_kelamin = $_POST['jenis_kelamin'] ?? "";
    $umur = $_POST['umur'] ?? "";
    $prodi = $_POST['prodi'] ?? "";
    $pekerjaan = $_POST['pekerjaan'] ?? "";
    $penghasilan = $_POST['penghasilan'] ?? "";
    $nim_mahasiswa = $_POST['nim_mahasiswa'] ?? "";
    $nama_mahasiswa = $_POST['nama_mahasiswa'] ?? "";
    $nama_prodi = $_POST['nama_prodi'] ?? "";
    $tahun_lulus = $_POST['tahun_lulus'] ?? "";
    $jabatan = $_POST['jabatan'] ?? "";
    $perusahaan = $_POST['perusahaan'] ?? "";
    $kota = $_POST['kota'] ?? "";


    $sql = "SELECT user_id FROM m_user WHERE nama = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $nama);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $user_id = $row['user_id'];

                $insert_sql = "INSERT INTO m_user_data (user_id, nama, role, nim, email, jurusan, no_telp, tahun_masuk, nip, unit, no_peg, jenis_kelamin, umur, pekerjaan, penghasilan, nim_mahasiswa, nama_mahasiswa, nama_prodi, tahun_lulus, jabatan, perusahaan, kota, prodi ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                if ($insert_stmt = $conn->prepare($insert_sql)) {
                    $insert_stmt->bind_param("issssssssssssssssssssss", $user_id, $nama, $role, $nim, $email, $jurusan, $no_telp, $tahun_masuk, $nip, $unit, $no_peg, $jenis_kelamin, $umur, $pekerjaan, $penghasilan, $nim_mahasiswa, $nama_mahasiswa, $nama_prodi, $tahun_lulus, $jabatan, $perusahaan, $kota, $prodi);

                    if ($insert_stmt->execute()) {
                        header("Location: index.php");
                    } else {
                        echo "Terjadi kesalahan. Silakan coba lagi.";
                    }

                    $insert_stmt->close();
                } else {
                    echo "Terjadi kesalahan. Silakan coba lagi.";
                }
            } else {
                echo "Username tidak ditemukan.";
            }
        } else {
            echo "Terjadi kesalahan. Silakan coba lagi.";
        }

        $stmt->close();
    } else {
        echo "Terjadi kesalahan. Silakan coba lagi.";
    }
    $conn->close();
}

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

        .nav-divider {
            border: none;
            height: 2px;
            background-color: #304C65;
            margin: 15px 0;
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
                        <div class="d-flex align-items-center" style="padding-left: 130px; padding-top: 10px;">
                            <form id="registerForm" method="POST" class="user">

                                <p style="font-weight: 800; font-size: 30px; margin: 0; color: #0D2A0D;">Lengkapi Data Diri</p>
                                <input type="hidden" name="role" value="<?php echo htmlspecialchars($role); ?>">

                                <?php if ($role == 'mahasiswa') { ?>
                                    <div>
                                        <div class="form-group">
                                            <label for="nama" style="font-weight: bold; color: #0D2A0D;">Nama</label>
                                            <input type="text" id="nama" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65; color: black" class="form-control form-control-user" name="nama" required autofocus value="<?php echo htmlspecialchars($nama ?? ''); ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="role" style="font-weight: bold; color: #0D2A0D;">Role</label>
                                            <input type="text" id="role" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65; color: black" class="form-control form-control-user" name="role" required value="Mahasiswa" readonly>
                                        </div>
                                        <hr class="nav-divider" style="margin-top: 30px; margin-bottom: 30px;">

                                        <div class="form-group">
                                            <label for="nim" style="font-weight: bold; color: #0D2A0D;">
                                                NIM <span style="color: red;">*</span>
                                            </label>
                                            <input type="text" id="nim" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="nim" placeholder="Masukkan NIM Anda" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="email" style="font-weight: bold; color: #0D2A0D;">
                                                Email <span style="color: red;">*</span>
                                            </label>
                                            <input type="email" id="email" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="email" placeholder="Masukkan Email Anda" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="jurusan" style="font-weight: bold; color: #0D2A0D;">
                                                Jurusan <span style="color: red;">*</span>
                                            </label>
                                            <select id="jurusan" class="form-control form-control-user" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" name="jurusan" required>
                                                <option value="" disabled selected>Pilih Jurusan Anda</option>
                                                <option value="Jurusan Administrasi Niaga">Jurusan Administrasi Niaga</option>
                                                <option value="Jurusan Akuntansi">Jurusan Akuntansi</option>
                                                <option value="Jurusan Teknik Elektro">Jurusan Teknik Elektro</option>
                                                <option value="Jurusan Teknik Kimia">Jurusan Teknik Kimia</option>
                                                <option value="Jurusan Teknik Mesin">Jurusan Teknik Mesin</option>
                                                <option value="Jurusan Teknik Sipil">Jurusan Teknik Sipil</option>
                                                <option value="Jurusan Teknologi Informasi">Jurusan Teknologi Informasi</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="prodi" style="font-weight: bold; color: #0D2A0D;">
                                                Prodi <span style="color: red;">*</span>
                                            </label>
                                            <input type="tel" id="prodi" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="prodi" placeholder="Masukkan Nomor Telepon Anda" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="no_telp" style="font-weight: bold; color: #0D2A0D;">
                                                Nomor Telepon <span style="color: red;">*</span>
                                            </label>
                                            <input type="tel" id="no_telp" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="no_telp" placeholder="Masukkan Nomor Telepon Anda" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="tahun_masuk" style="font-weight: bold; color: #0D2A0D;">
                                                Tahun Masuk <span style="color: red;">*</span>
                                            </label>
                                            <input type="number" id="tahun_masuk" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="tahun_masuk" placeholder="Masukkan Tahun Masuk Anda" required>
                                        </div>
                                    </div>
                                <?php } elseif ($role == 'dosen') { ?>
                                    <div class="form-group">
                                        <label for="nama" style="font-weight: bold; color: #0D2A0D;">Nama</label>
                                        <input type="text" id="nama" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65; color: black" class="form-control form-control-user" name="nama" required autofocus value="<?php echo htmlspecialchars($nama ?? ''); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="role" style="font-weight: bold; color: #0D2A0D;">Role</label>
                                        <input type="text" id="role" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65; color: black" class="form-control form-control-user" name="role" placeholder="Masukkan Username Anda" required value="dosen" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="nip" style="font-weight: bold; color: #0D2A0D;">
                                            NIDN <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="nip" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="nip" placeholder="Masukkan NIDN Anda" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="unit" style="font-weight: bold; color: #0D2A0D;">
                                            Unit <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="unit" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="unit" placeholder="Masukkan Unit Anda" required>
                                    </div>

                                <?php } elseif ($role == 'tendik') { ?>
                                    <div class="form-group">
                                        <label for="nama" style="font-weight: bold; color: #0D2A0D;">Nama</label>
                                        <input type="text" id="nama" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65; color: black" class="form-control form-control-user" name="nama" required autofocus value="<?php echo htmlspecialchars($nama ?? ''); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="role" style="font-weight: bold; color: #0D2A0D;">Role</label>
                                        <input type="text" id="role" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65; color: black" class="form-control form-control-user" name="role" placeholder="Masukkan Username Anda" required value="tendik" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="no_peg" style="font-weight: bold; color: #0D2A0D;">
                                            NoPeg <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="no_peg" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="no_peg" placeholder="Masukkan NIDN Anda" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="unit" style="font-weight: bold; color: #0D2A0D;">
                                            Unit <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="unit" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="unit" placeholder="Masukkan Unit Anda" required>
                                    </div>
                                <?php } elseif ($role == 'ortu') { ?>
                                    <div class="form-group">
                                        <label for="nama" style="font-weight: bold; color: #0D2A0D;">Nama</label>
                                        <input type="text" id="nama" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65; color: black" class="form-control form-control-user" name="nama" required autofocus value="<?php echo htmlspecialchars($nama ?? ''); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="role" style="font-weight: bold; color: #0D2A0D;">Role</label>
                                        <input type="text" id="role" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65; color: black" class="form-control form-control-user" name="role" placeholder="Masukkan role Anda" required value="Orang Tua" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="jenis_kelamin" style="font-weight: bold; color: #0D2A0D;">
                                            Jenis Kelamin <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="jenis_kelamin" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="jenis_kelamin" placeholder="Masukkan NIDN Anda" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="umur" style="font-weight: bold; color: #0D2A0D;">
                                            Umur <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="umur" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="umur" placeholder="Masukkan Umur Anda" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_telp" style="font-weight: bold; color: #0D2A0D;">
                                            No handphone <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="no_telp" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="no_telp" placeholder="Masukkan No HP Anda" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="pendidikan" style="font-weight: bold; color: #0D2A0D;">
                                            Pendidikan <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="pendidikan" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="pendidikan" placeholder="Masukkan Pendidikan Anda" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="pekerjaan" style="font-weight: bold; color: #0D2A0D;">
                                            Pekerjaan <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="pekerjaan" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="pekerjaan" placeholder="Masukkan Pekerjaan Anda" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="penghasilan" style="font-weight: bold; color: #0D2A0D;">
                                            Penghasilan <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="penghasilan" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="penghasilan" placeholder="Masukkan Penghasilan Anda" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nim_mahasiswa" style="font-weight: bold; color: #0D2A0D;">
                                            Nim Mahasiswa <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="nim_mahasiswa" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="nim_mahasiswa" placeholder="Masukkan Nim Putra/Putri Anda" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_mahasiswa" style="font-weight: bold; color: #0D2A0D;">
                                            Nama Mahasiswa <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="nama_mahasiswa" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="nama_mahasiswa" placeholder="Masukkan Nama Putra/Putri Anda" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_prodi" style="font-weight: bold; color: #0D2A0D;">
                                            Nama Prodi <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="nama_prodi" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="nama_prodi" placeholder="Masukkan Prodi Putra/Putri Anda" required>
                                    </div>
                                <?php } elseif ($role == 'alumni') { ?>
                                    <div class="form-group">
                                        <label for="nama" style="font-weight: bold; color: #0D2A0D;">Nama</label>
                                        <input type="text" id="nama" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65; color: black" class="form-control form-control-user" name="nama" required autofocus value="<?php echo htmlspecialchars($nama ?? ''); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="role" style="font-weight: bold; color: #0D2A0D;">Role</label>
                                        <input type="text" id="role" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65; color: black" class="form-control form-control-user" name="role" placeholder="Masukkan Username Anda" required value="tendik" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="nim" style="font-weight: bold; color: #0D2A0D;">
                                            NIM <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="nim" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="nim" placeholder="Masukkan NIDN Anda" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" style="font-weight: bold; color: #0D2A0D;">
                                            Email <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="email" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="email" placeholder="Masukkan Email Anda" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="prodi" style="font-weight: bold; color: #0D2A0D;">
                                            Prodi <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="prodi" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="prodi" placeholder="Masukkan Prodi Anda" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_telp" style="font-weight: bold; color: #0D2A0D;">
                                            No Handphone <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="no_telp" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="no_telp" placeholder="Masukkan Unit Anda" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun_lulus" style="font-weight: bold; color: #0D2A0D;">
                                            Tahun Lulus <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="tahun_lulus" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="tahun_lulus" placeholder="Masukkan Unit Anda" required>
                                    </div>
                                <?php } elseif ($role == 'industri') { ?>
                                    <div class="form-group">
                                        <label for="nama" style="font-weight: bold; color: #0D2A0D;">Nama</label>
                                        <input type="text" id="nama" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65; color: black" class="form-control form-control-user" name="nama" required autofocus value="<?php echo htmlspecialchars($nama ?? ''); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="industri" style="font-weight: bold; color: #0D2A0D;">Role</label>
                                        <input type="text" id="industri" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65; color: black" class="form-control form-control-user" name="industri" placeholder="Masukkan Username Anda" required value="tendik" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="jabatan" style="font-weight: bold; color: #0D2A0D;">
                                            Jabatan <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="jabatan" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="jabatan" placeholder="Masukkan NIDN Anda" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="perusahaan" style="font-weight: bold; color: #0D2A0D;">
                                            Perusahaan <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="perusahaan" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="perusahaan" placeholder="Masukkan Unit Anda" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" style="font-weight: bold; color: #0D2A0D;">
                                            Email <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="email" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="email" placeholder="Masukkan Unit Anda" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_telp" style="font-weight: bold; color: #0D2A0D;">
                                            No Handphone <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="no_telp" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="no_telp" placeholder="Masukkan Unit Anda" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="kota" style="font-weight: bold; color: #0D2A0D;">
                                            Kota <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" id="kota" style="width: 350px; border-radius: 16px; display: flex; box-sizing: border-box; border:1px solid #304C65" class="form-control form-control-user" name="kota" placeholder="Masukkan Unit Anda" required>
                                    </div>
                                <?php } ?>
                                <div class="d-flex justify-content-between">
                                    <a href="user-register.php" class="btn btn-secondary" style="width: 100px; text-align: center;">Kembali</a>
                                    <button type="submit" class="btn btn-primary" style="width: 100px; background-color: #304C65; border: none;">Daftar</button>
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