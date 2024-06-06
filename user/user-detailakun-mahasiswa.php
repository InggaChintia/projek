<?php
session_start();
require_once 'connection.php'; // Pastikan ini adalah file koneksi yang benar

if (!isset($_GET['username']) || !isset($_GET['role'])) {
    die("Invalid access. Username or role not provided.");
}

$username = $_GET['username'];
$role = $_GET['role'];

// Query untuk mengambil data user
$sql = "SELECT * FROM m_user WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $nama = $row['nama'];
    $role = $row['role'];
    $user_id = $row['user_id'];
} else {
    die("Username tidak ditemukan.");
}

$stmt->close();
// Query untuk mengambil data tambahan dari m_user_data
$sql_data = "SELECT * FROM m_user_data WHERE user_id = ?";
$stmt_data = $conn->prepare($sql_data);
$stmt_data->bind_param("i", $user_id);
$stmt_data->execute();
$result_data = $stmt_data->get_result();

if ($result_data->num_rows == 1) {
    $row_data = $result_data->fetch_assoc();
    $nim = $row_data['nim'] ?? "";
    $prodi = $row_data['prodi'] ?? "";
    $email = $row_data['email'] ?? "";
    $jurusan = $row_data['jurusan'] ?? "";
    $no_telp = $row_data['no_telp'] ?? "";
    $tahun_masuk = $row_data['tahun_masuk'] ?? "";
    $nip = $row_data['nip'] ?? "";
    $unit = $row_data['unit'] ?? "";
    $no_peg = $row_data['no_peg'] ?? "";
    $tahun_lulus = $row_data['tahun_lulus'] ?? "";
    $jenis_kelamin = $row_data['jenis_kelamin'] ?? "";
    $umur = $row_data['umur'] ?? "";
    $pendidikan = $row_data['pendidikan'] ?? "";
    $penghasilan = $row_data['penghasilan'] ?? "";
    $jabatan = $row_data['jabatan'] ?? "";
    $perusahaan = $row_data['perusahaan'] ?? "";
    $kota = $row_data['kota'] ?? "";
    $nim_mahasiswa = $row_data['nim_mahasiswa'] ?? "";
    $nama_mahasiswa = $row_data['nama_mahasiswa'] ?? "";
    $nama_prodi = $row_data['nama_prodi'] ?? "";
} else {
    die("User data tidak ditemukan.");
}

$stmt_data->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Survei</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">
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
            margin-bottom: 10px;
            margin-top: -10px;
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
            padding: 10px;
            display: block;
            border-radius: 5px;
            margin-top: 10px;
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
            padding: 0px;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #304C65;
            padding: 20px 20px;
            color: white;
        }

        .content-header .profile {
            display: flex;
            align-items: center;
        }

        .content-header .profile-info {
            text-align: left;
            display: flex;
            align-items: center;
        }

        .content-header .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .account-detail {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            display: flex;
            flex-direction: column;
        }

        .account-detail h2 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .account-detail .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .account-detail .account-info {
            margin-bottom: 20px;
        }

        .account-detail .edit-photo {
            display: block;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
            cursor: pointer;
        }

        .table th,
        .table td {
            vertical-align: middle;
            padding: 8px 15px;
        }

        .table th {
            width: 20%;
        }

        .account-detail .change-password {
            background-color: #304C65;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            align-self: flex-start;
            margin-top: 20px;
        }

        .account-detail .change-password:hover {
            background-color: #203040;
        }

        .nav-divider {
            border: none;
            height: 2px;
            background-color: #304C65;
            margin: 15px 0;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .upload-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .upload-section input[type="file"] {
            display: none;
        }

        .upload-section label {
            background-color: #304C65;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .upload-section label:hover {
            background-color: #203040;
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
    <div class="navbar-vertical">
        <img src="aset/logopolinema.png" alt="Polinema Logo">
        <p>Survei Polinema</p>
        <hr class="nav-divider">
        <nav class="nav flex-column mt-4">
            <a class="nav-link" href="user-dashboard.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?>">
                <i class="bi bi-speedometer2"></i> Overview
            </a>
            <a class="nav-link active" href="user-detailakun-mahasiswa.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?>">
                <i class="bi bi-person"></i> User
            </a>
        </nav>
        <a class="nav-link logout" href="user-login.php">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
    <div class="content">
        <div class="content-header">
            <h1></h1>
            <div class="profile">
                <div class="profile-info">
                    <a href="user-detailakun-mahasiswa.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?>">
                        <?php echo htmlspecialchars($username); ?>
                    </a>
                    <span style="margin-left: 10px; margin-right: 10px"> | </span>
                    <span id="profileRole"><?php echo htmlspecialchars($role); ?></span>
                </div>
            </div>
        </div>
        <div class="account-detail">
            <h2>Detail User</h2>
            <?php if ($role === 'mahasiswa') : ?>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row">Nama</th>
                            <td><?php echo htmlspecialchars($nama); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td><?php echo htmlspecialchars($email); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Nomor handphone</th>
                            <td><?php echo htmlspecialchars($no_telp); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">NIM</th>
                            <td><?php echo htmlspecialchars($nim); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Jurusan</th>
                            <td><?php echo htmlspecialchars($jurusan); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Prodi</th>
                            <td><?php echo htmlspecialchars($prodi); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Tahun Masuk</th>
                            <td><?php echo htmlspecialchars($tahun_masuk); ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php elseif ($role === 'dosen') : ?>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row">Nama</th>
                            <td><?php echo htmlspecialchars($nama); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td><?php echo htmlspecialchars($email); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">NIP/NIDN</th>
                            <td><?php echo htmlspecialchars($nip); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Unit</th>
                            <td><?php echo htmlspecialchars($unit); ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php elseif ($role === 'tendik') : ?>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row">Nama</th>
                            <td><?php echo htmlspecialchars($nama); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">No Pegawai</th>
                            <td><?php echo htmlspecialchars($no_peg); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Unit</th>
                            <td><?php echo htmlspecialchars($unit); ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php elseif ($role === 'ortu') : ?>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row">Nama</th>
                            <td><?php echo htmlspecialchars($nama); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Jenis Kelamin</th>
                            <td><?php echo htmlspecialchars($jenis_kelamin); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Umur</th>
                            <td><?php echo htmlspecialchars($umur); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Nomor handphone</th>
                            <td><?php echo htmlspecialchars($no_telp); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Pendidikan</th>
                            <td><?php echo htmlspecialchars($pendidikan); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Penghasilan</th>
                            <td><?php echo htmlspecialchars($penghasilan); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">NIM Mahasiswa</th>
                            <td><?php echo htmlspecialchars($nim_mahasiswa); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Nama Mahasiswa</th>
                            <td><?php echo htmlspecialchars($nama_mahasiswa); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Nama Prodi</th>
                            <td><?php echo htmlspecialchars($nama_prodi); ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php elseif ($role === 'alumni') : ?>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row">Nama</th>
                            <td><?php echo htmlspecialchars($nama); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td><?php echo htmlspecialchars($email); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">NIM</th>
                            <td><?php echo htmlspecialchars($nim); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Prodi</th>
                            <td><?php echo htmlspecialchars($prodi); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Nomor handphone</th>
                            <td><?php echo htmlspecialchars($no_telp); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Tahun Lulus</th>
                            <td><?php echo htmlspecialchars($tahun_lulus); ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php elseif ($role === 'industri') : ?>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row">Nama</th>
                            <td><?php echo htmlspecialchars($nama); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Jabatan</th>
                            <td><?php echo htmlspecialchars($jabatan); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Perusahaan</th>
                            <td><?php echo htmlspecialchars($perusahaan); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td><?php echo htmlspecialchars($email); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Kota</th>
                            <td><?php echo htmlspecialchars($kota); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Nomor handphone</th>
                            <td><?php echo htmlspecialchars($no_telp); ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php endif; ?>
            <div class="upload-section">
                <button class="change-password" onclick="window.location.href='user-detailakun-gantipass.php'">Ganti password</button>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('file-upload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-picture').src = e.target.result;
                    document.getElementById('profile-picture-header').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>
