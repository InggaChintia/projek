<?php
require_once 'koneksi.php';

if (!isset($_GET['id'])) {
    echo "ID survei tidak ditemukan.";
    exit();
}

$id = $_GET['id']; // id_survey

$sql = "SELECT * FROM m_survey WHERE survey_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Survei tidak ditemukan.";
    exit();
}

$row = $result->fetch_assoc();
$survey_jenis = $row['survey_jenis'];
$survey_nama = $row['survey_nama'];
$survey_deskripsi = $row['survey_deskripsi'];
$survey_tanggal = $row['survey_tanggal'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $survey_jenis_baru = $_POST['survey_jenis'];
    $survey_nama_baru = $_POST['survey_nama'];
    $survey_deskripsi_baru = $_POST['survey_deskripsi'];
    $survey_tanggal_baru = $_POST['survey_tanggal'];

    $update_sql = "UPDATE m_survey SET survey_jenis = ?, survey_nama = ?, survey_deskripsi = ?, survey_tanggal = ? WHERE survey_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssssi", $survey_jenis_baru, $survey_nama_baru, $survey_deskripsi_baru, $survey_tanggal_baru, $id);

    if ($update_stmt->execute()) {
        // Process survey questions
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'soal_nama_') !== false) {
                $index = str_replace('soal_nama_', '', $key);
                $soal_nama = $value;
                $soal_id = $_POST['soal_id_' . $index];

                if ($soal_id === 'new') {
                    // Insert new question
                    $insert_sql = "INSERT INTO m_survey_soal (survey_id, soal_nama) VALUES (?, ?)";
                    $insert_stmt = $conn->prepare($insert_sql);
                    $insert_stmt->bind_param("is", $id, $soal_nama);
                    $insert_stmt->execute();
                    $insert_stmt->close();
                } else {
                    // Update existing question
                    $update_sql = "UPDATE m_survey_soal SET soal_nama = ? WHERE soal_id = ?";
                    $update_stmt = $conn->prepare($update_sql);
                    $update_stmt->bind_param("si", $soal_nama, $soal_id);
                    $update_stmt->execute();
                    $update_stmt->close();
                }
            }
        }
        header("Location: admin_survei.php");
    } else {
        echo "Gagal memperbarui survei. Silakan coba lagi.";
    }

    $update_stmt->close();
}

// newww
// data yang diperlukan kategori, survey soal
// ambil data survey soal dan kategori
$query = "SELECT * FROM detail_survey_dan_soal WHERE survey_id = $id";

// Execute the query
$query_data_soal_dan_kategori = mysqli_query($conn, $query);

$data_soal_dan_kategori = [];
while ($row = mysqli_fetch_assoc($query_data_soal_dan_kategori)) {
    $data_soal_dan_kategori[] = $row;
}
// var_dump($data_soal_dan_kategori);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survei Polinema</title>
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
            padding: 13px 20px;
            color: white;
        }
        .content-header .profile {
            display: flex;
            align-items: center;
            font-size: 14px;
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
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: black;
            margin-left: 20px;
            font-size: 16px;
        }

        select, input[type="text"],
        input[type="datetime-local"],
        textarea {
            width: 70%;
            padding: 5px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-left: 20px;
        }
        textarea {
            resize: vertical;
            min-height: 30px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 14px;
            margin-left: 20px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        button[type="back"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }
        button[type="back"]:hover {
            background-color: #0056b3;
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
            <a class="nav-link" href="admin_datasurvei_dashboard.php"><img src="aset/data.png" alt="Data Survei Icon">Data Survei</a>
            <a class="nav-link active" href="admin_survei.php"><img src="aset/survei.png" alt="Survei Icon">Survei</a>
        </nav>
        <a class="nav-link logout" href="#"><img src="aset/logout.png" alt="Logout Icon">Logout</a>
    </div>
    <div class="content">
        <div class="content-header">
            <h1>  </h1>
            <div class="profile">
                <a class="nav-link" href="admin_profile.html"><span>Admin</span></a>
            </div>
        </div>
        <div class="survey-content">
            <h2>Edit Survei</h2>
            <hr class="nav-divider">
        
            <form method="post">
                <label for="survey_jenis">Jenis Survei:</label>
                <select id="survey_jenis" name="survey_jenis">
                    <?php 
                    $selected_survey_jenis = htmlspecialchars($data_soal_dan_kategori[0]['survey_jenis']);
                    $options = [
                        'ortu' => 'Orang Tua',
                        'mahasiswa' => 'Mahasiswa',
                        'tendik' => 'Tenaga Pendidik',
                        'dosen' => 'Dosen',
                        'alumni' => 'Alumni',
                        'industri' => 'Industri'
                    ];
                    foreach ($options as $value => $label) {
                        $selected = ($value == $selected_survey_jenis) ? 'selected' : '';
                        echo "<option value=\"$value\" $selected>$label</option>";
                    }
                    ?>
                </select>
                <br><br>

                <label for="kategori_id">Kategori:</label>
                <select id="kategori_id" name="kategori_id">
                    <?php 
                    $selected_kategori_id = htmlspecialchars($data_soal_dan_kategori[0]['kategori_id']);
                    $options = [
                        1 => 'Fasilitas',
                        2 => 'Akademik',
                        3 => 'Pelayanan',
                        4 => 'Alumni'
                    ];
                    foreach ($options as $value => $label) {
                        $selected = ($value == $selected_kategori_id) ? 'selected' : '';
                        echo "<option value=\"$value\" $selected>$label</option>";
                    }?>
                </select>
                <br><br>
                
                <label for="survey_nama">Nama Survei:</label>
                <input type="text" id="survey_nama" name="survey_nama" value="<?php echo htmlspecialchars($data_soal_dan_kategori[0]['survey_nama']); ?>"><br><br>

                <label for="survey_deskripsi">Deskripsi Survei:</label>
                <textarea id="survey_deskripsi" name="survey_deskripsi"><?php echo htmlspecialchars($data_soal_dan_kategori[0]['survey_deskripsi']); ?></textarea><br><br>

                <label for="survey_tanggal">Tanggal Survei:</label>
                <input type="datetime-local" id="survey_tanggal" name="survey_tanggal" value="<?php echo date('Y-m-d\TH:i', strtotime($data_soal_dan_kategori[0]['survey_tanggal'])); ?>"><br><br>

                <label for="survey_soal">Pertanyaan Survei:</label>
                <ol>
                <?php foreach ($data_soal_dan_kategori as $index => $soal) { ?>
                    <li>
                        <input type="text" id="soal_nama_<?php echo $index; ?>" name="soal_nama_<?php echo $index; ?>" value="<?php echo htmlspecialchars($soal['soal_nama']); ?>">
                        <input type="hidden" name="soal_id_<?php echo $index; ?>" value="<?php echo htmlspecialchars($soal['soal_id']); ?>">
                    </li>
                <?php } ?>
                </ol>
                <br>
                
                <input type="submit" value="Simpan">

                <button type="back" id="back">kembali</button>
            </form>
</html>