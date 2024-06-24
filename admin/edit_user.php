<?php
require_once('koneksi.php');

if (!isset($_GET['user_id']) || !is_numeric($_GET['user_id'])) {
    echo "ID pengguna tidak valid.";
    exit;
}

if (isset($_POST['update'])) {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    // Additional fields based on role
    $nama = $_POST['nama'];
    $no_telp = $_POST['no_telp'];

    // Update m_user table
    $sql_update_user = "UPDATE m_user SET username='$username', role='$role' WHERE user_id=$user_id";
    $conn->query($sql_update_user);

    // Update m_user_data table based on role
    $sql_update_user_data = "";
    if ($role == 'dosen') {
        $nip = $_POST['nip'];
        $unit = $_POST['unit'];
        $sql_update_user_data = "UPDATE m_user_data SET nama='$nama', nip='$nip', unit='$unit' WHERE user_id=$user_id";
    } elseif ($role == 'mahasiswa') {
        $nim = $_POST['nim'];
        $jurusan = $_POST['jurusan'];
        $prodi = $_POST['prodi'];
        $email = $_POST['email'];
        $tahun_masuk = $_POST['tahun_masuk'];
        $sql_update_user_data = "UPDATE m_user_data SET nama='$nama', nim='$nim', jurusan='$jurusan', prodi='$prodi', no_telp='$no_telp', email='$email', tahun_masuk='$tahun_masuk' WHERE user_id=$user_id";
    } elseif ($role == 'tendik') {
        $no_peg = $_POST['no_peg'];
        $unit = $_POST['unit'];
        $sql_update_user_data = "UPDATE m_user_data SET nama='$nama', no_peg='$no_peg', unit='$unit' WHERE user_id=$user_id";
    } elseif ($role == 'ortu') {
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $umur = $_POST['umur'];
        $pendidikan = $_POST['pendidikan'];
        $penghasilan = $_POST['penghasilan'];
        $nama_mahasiswa = $_POST['nama_mahasiswa'];
        $nim_mahasiswa = $_POST['nim_mahasiswa'];
        $nama_prodi = $_POST['nama_prodi'];
        $sql_update_user_data = "UPDATE m_user_data SET nama='$nama', no_telp='$no_telp', jenis_kelamin='$jenis_kelamin', umur='$umur', pendidikan='$pendidikan', penghasilan='$penghasilan', nama_mahasiswa='$nama_mahasiswa', nim_mahasiswa='$nim_mahasiswa', nama_prodi='$nama_prodi' WHERE user_id=$user_id";
    } elseif ($role == 'alumni') {
        $nim = $_POST['nim'];
        $prodi = $_POST['prodi'];
        $email = $_POST['email'];
        $tahun_lulus = $_POST['tahun_lulus'];
        $sql_update_user_data = "UPDATE m_user_data SET nama='$nama', nim='$nim', prodi='$prodi', no_telp='$no_telp', email='$email', tahun_lulus='$tahun_lulus' WHERE user_id=$user_id";
    } elseif ($role == 'industri') {
        $email = $_POST['email'];
        $jabatan = $_POST['jabatan'];
        $perusahaan = $_POST['perusahaan'];
        $kota = $_POST['kota'];
        $sql_update_user_data = "UPDATE m_user_data SET nama='$nama', no_telp='$no_telp', email='$email', jabatan='$jabatan', perusahaan='$perusahaan', kota='$kota' WHERE user_id=$user_id";
    }

    if ($sql_update_user_data != "") {
        if ($conn->query($sql_update_user_data) === TRUE) {
            $update_successful = true;
        }
    }
}
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

        .navbar-vertical .logout {
            position: absolute;
            bottom: 20px;
            left: 20px;
        }

        .content {
            margin-left: 250px;
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

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 5px;
            margin-top: 3px;
            margin-bottom: 3px;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #304C65;
            color: white;
            padding: 10px 20px;
            margin: 10px 5px 0 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #203040;
        }

        .buttons {
            display: flex;
            justify-content: flex-end;
        }
    </style>
    <script>
        <?php if ($update_successful) { ?>
            alert('Data pengguna berhasil diperbarui.');
        <?php } ?>
    </script>
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
            <h1> </h1>
            <div class="profile">
                <a class="nav-link" href="#">
                    <span>Admin</span></a>
            </div>
        </div>
        <div class="survey-content">
            <h2>Detail Pengguna</h2>
            <hr class="nav-divider">
            <?php
            if (isset($_GET['user_id'])) {
                $user_id = $_GET['user_id'];

                // Query to get user data from m_user
                $sql_user = "SELECT * FROM m_user WHERE user_id = $user_id";
                $result_user = $conn->query($sql_user);

                if ($result_user->num_rows == 1) {
                    $row_user = $result_user->fetch_assoc();

                    // Query to get additional user data from m_user_data
                    $sql_user_data = "SELECT * FROM m_user_data WHERE user_id = $user_id";
                    $result_user_data = $conn->query($sql_user_data);
                    $row_user_data = $result_user_data->fetch_assoc();
            ?>

                    <form method="post" action="">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <p><strong>Username:</strong> <input type="text" name="username" value="<?php echo $row_user['username']; ?>"></p>
                        <p><strong>Role:</strong>
                            <select name="role">
                                <option value="dosen" <?php if ($row_user['role'] == 'dosen') echo 'selected'; ?>>Dosen</option>
                                <option value="mahasiswa" <?php if ($row_user['role'] == 'mahasiswa') echo 'selected'; ?>>Mahasiswa</option>
                                <option value="tendik" <?php if ($row_user['role'] == 'tendik') echo 'selected'; ?>>Tendik</option>
                                <option value="ortu" <?php if ($row_user['role'] == 'ortu') echo 'selected'; ?>>Ortu</option>
                                <option value="alumni" <?php if ($row_user['role'] == 'alumni') echo 'selected'; ?>>Alumni</option>
                                <option value="industri" <?php if ($row_user['role'] == 'industri') echo 'selected'; ?>>Industri</option>
                            </select>
                        </p>

                        <?php if ($row_user['role'] == 'dosen') { ?>
                            <p><strong>Nama:</strong> <input type="text" name="nama" value="<?php echo $row_user_data['nama']; ?>"></p>
                            <p><strong>NIP:</strong> <input type="text" name="nip" value="<?php echo $row_user_data['nip']; ?>"></p>
                            <p><strong>Unit:</strong> <input type="text" name="unit" value="<?php echo $row_user_data['unit']; ?>"></p>
                        <?php } elseif ($row_user['role'] == 'mahasiswa') { ?>
                            <p><strong>Nama:</strong> <input type="text" name="nama" value="<?php echo $row_user_data['nama']; ?>"></p>
                            <p><strong>NIM:</strong> <input type="text" name="nim" value="<?php echo $row_user_data['nim']; ?>"></p>
                            <p><strong>Jurusan:</strong> <input type="text" name="jurusan" value="<?php echo $row_user_data['jurusan']; ?>"></p>
                            <p><strong>Program Studi:</strong> <input type="text" name="prodi" value="<?php echo $row_user_data['prodi']; ?>"></p>
                            <p><strong>No.Telepon:</strong> <input type="text" name="no_telp" value="<?php echo $row_user_data['no_telp']; ?>"></p>
                            <p><strong>Email:</strong> <input type="text" name="email" value="<?php echo $row_user_data['email']; ?>"></p>
                            <p><strong>Tahun Masuk:</strong> <input type="text" name="tahun_masuk" value="<?php echo $row_user_data['tahun_masuk']; ?>"></p>
                        <?php } elseif ($row_user['role'] == 'tendik') { ?>
                            <p><strong>No. Pegawai:</strong> <input type="text" name="no_peg" value="<?php echo $row_user_data['no_peg']; ?>"></p>
                            <p><strong>Nama:</strong> <input type="text" name="nama" value="<?php echo $row_user_data['nama']; ?>"></p>
                            <p><strong>Unit:</strong> <input type="text" name="unit" value="<?php echo $row_user_data['unit']; ?>"></p>
                        <?php } elseif ($row_user['role'] == 'ortu') { ?>
                            <p><strong>Nama:</strong> <input type="text" name="nama" value="<?php echo $row_user_data['nama']; ?>"></p>
                            <p><strong>No.Telepon:</strong> <input type="text" name="no_telp" value="<?php echo $row_user_data['no_telp']; ?>"></p>
                            <p><strong>Jenis Kelamin:</strong> <input type="text" name="jenis_kelamin" value="<?php echo $row_user_data['jenis_kelamin']; ?>"></p>
                            <p><strong>Umur:</strong> <input type="text" name="umur" value="<?php echo $row_user_data['umur']; ?>"></p>
                            <p><strong>Pendidikan:</strong> <input type="text" name="pendidikan" value="<?php echo $row_user_data['pendidikan']; ?>"></p>
                            <p><strong>Penghasilan:</strong> <input type="text" name="penghasilan" value="<?php echo $row_user_data['penghasilan']; ?>"></p>
                            <p><strong>Nama Mahasiswa:</strong> <input type="text" name="nama_mahasiswa" value="<?php echo $row_user_data['nama_mahasiswa']; ?>"></p>
                            <p><strong>NIM Mahasiswa:</strong> <input type="text" name="nim_mahasiswa" value="<?php echo $row_user_data['nim_mahasiswa']; ?>"></p>
                            <p><strong>Program Studi:</strong> <input type="text" name="nama_prodi" value="<?php echo $row_user_data['nama_prodi']; ?>"></p>
                        <?php } elseif ($row_user['role'] == 'alumni') { ?>
                            <p><strong>Nama:</strong> <input type="text" name="nama" value="<?php echo $row_user_data['nama']; ?>"></p>
                            <p><strong>NIM:</strong> <input type="text" name="nim" value="<?php echo $row_user_data['nim']; ?>"></p>
                            <p><strong>Program Studi:</strong> <input type="text" name="prodi" value="<?php echo $row_user_data['prodi']; ?>"></p>
                            <p><strong>No.Telepon:</strong> <input type="text" name="no_telp" value="<?php echo $row_user_data['no_telp']; ?>"></p>
                            <p><strong>Email:</strong> <input type="text" name="email" value="<?php echo $row_user_data['email']; ?>"></p>
                            <p><strong>Tahun Lulus:</strong> <input type="text" name="tahun_lulus" value="<?php echo $row_user_data['tahun_lulus']; ?>"></p>
                        <?php } elseif ($row_user['role'] == 'industri') { ?>
                            <p><strong>Nama:</strong> <input type="text" name="nama" value="<?php echo $row_user_data['nama']; ?>"></p>
                            <p><strong>No.Telepon:</strong> <input type="text" name="no_telp" value="<?php echo $row_user_data['no_telp']; ?>"></p>
                            <p><strong>Email:</strong> <input type="text" name="email" value="<?php echo $row_user_data['email']; ?>"></p>
                            <p><strong>Jabatan:</strong> <input type="text" name="jabatan" value="<?php echo $row_user_data['jabatan']; ?>"></p>
                            <p><strong>Perusahaan:</strong> <input type="text" name="perusahaan" value="<?php echo $row_user_data['perusahaan']; ?>"></p>
                            <p><strong>Kota:</strong> <input type="text" name="kota" value="<?php echo $row_user_data['kota']; ?>"></p>
                        <?php } ?>


                        <div class="buttons">
                            <button type="button" id="back" class="btn btn-secondary" onclick="history.back();">Kembali</button>
                            <button type="submit" class="btn btn-primary" name="update" value="Update">update</button>
                        </div>
                    </form>

            <?php
                } else {
                    echo "Pengguna tidak ditemukan.";
                }
            } else {
                echo "ID pengguna tidak diberikan.";
            }
            ?>
        </div>

    </div>
</body>

</html>