<?php
require_once '../admin/koneksi.php';
session_start();

if (isset($_POST['role'])) {
    $role = htmlspecialchars($_POST['role'], ENT_QUOTES, 'UTF-8');
} else {
    die("Role is not set.");
}

echo '<pre>';
print_r($_SESSION);
echo '</pre>';

if (!isset($_SESSION['role']) || !isset($_SESSION['user_id']) || !isset($_SESSION['survey_id'])) {
    die("Invalid access. Role, User ID, or Survey ID not provided.");
}

$role = $_SESSION['role'];
$user_id = $_SESSION['user_id'];
$survey_id = $_SESSION['survey_id'];

$responden_id = null; // Inisialisasi variabel responden_id

// Check and set the SQL query based on role
$sql = "";
if ($role === 'mahasiswa') {
    $responden_id = $_SESSION['responden_mahasiswa_id'] = $_SESSION['user_id'];
    $sql = "INSERT INTO t_responden_mahasiswa (responden_mahasiswa_id, survey_id, responden_tanggal, responden_nim, responden_nama, responden_prodi, responden_email, responden_hp, tahun_masuk)
    SELECT ?, ?, NOW(), nim, nama, prodi, email, no_telp, tahun_masuk
    FROM m_user_data
    WHERE user_id = ?";
} else if ($role === 'dosen') {
    $responden_id = $_SESSION['responden_dosen_id'] = $_SESSION['user_id'];
    $sql = "INSERT INTO t_responden_dosen (responden_dosen_id, survey_id, responden_tanggal, responden_nip, responden_nama, responden_unit)
    SELECT ?, ?, NOW(), nip, nama, unit
    FROM m_user_data
    WHERE user_id = ?";
} else if ($role === 'tendik') {
    $responden_id = $_SESSION['responden_tendik_id'] = $_SESSION['user_id'];
    $sql = "INSERT INTO t_responden_tendik (responden_tendik_id, survey_id, responden_tanggal, responden_nopeg, responden_nama, responden_unit)
    SELECT ?, ?, NOW(), no_peg, nama, unit
    FROM m_user_data
    WHERE user_id = ?";
} else if ($role === 'ortu') {
    $responden_id = $_SESSION['responden_ortu_id'] = $_SESSION['user_id'];
    $sql = "INSERT INTO t_responden_ortu (responden_ortu_id, survey_id, responden_tanggal, responden_jk, responden_umur, responden_hp, responden_pendidikan, responden_pekerjaan, responden_penghasilan, mahasiswa_nim, mahasiswa_nama, mahasiswa_prodi, responden_nama)
    SELECT ?, ?, NOW(), jenis_kelamin, umur, no_telp, pendidikan, pekerjaan, penghasilan, nim_mahasiswa, nama_mahasiswa, nama_prodi, nama
    FROM m_user_data
    WHERE user_id = ?";
} else if ($role === 'alumni') {
    $responden_id = $_SESSION['responden_alumni_id'] = $_SESSION['user_id'];
    $sql = "INSERT INTO t_responden_alumni (responden_alumni_id, survey_id, responden_tanggal, responden_nim, responden_nama, responden_prodi, responden_email, responden_hp, tahun_lulus)
    SELECT ?, ?, NOW(), nim, nama, prodi, email, no_telp, tahun_lulus
    FROM m_user_data
    WHERE user_id = ?";
} else if ($role === 'industri') {
    $responden_id = $_SESSION['responden_industri_id'] = $_SESSION['user_id'];
    $sql = "INSERT INTO t_responden_industri (responden_industri_id, survey_id, responden_tanggal, responden_nama, responden_jabatan, responden_perusahaan, responden_email, responden_hp, responden_kota)
    SELECT ?, ?, NOW(), nama, jabatan, perusahaan, email, no_telp, kota
    FROM m_user_data
    WHERE user_id = ?";
} else {
    die("Invalid user role.");
}

if ($sql !== "") {
    $stmt2 = $conn->prepare($sql);
    if ($stmt2 === false) {
        die("Failed to prepare statement: " . $conn->error);
    }

    $stmt2->bind_param("iis", $responden_id, $survey_id, $user_id);
    if ($stmt2->execute()) {
        echo "Data berhasil ditambahkan dengan responden_id: $responden_id<br>";
    } else {
        die("Error: " . $stmt2->error);
    }
    $stmt2->close();
} else {
    die("No SQL query to execute.");
}

echo '<pre>';
print_r($_SESSION);
echo '</pre>';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['response'])) {
    $responses = $_POST['response'];

    echo '<pre>';
    print_r($responses);
    echo '</pre>';

    $stmtCheckSoal = $conn->prepare("SELECT soal_id FROM m_survey_soal WHERE soal_id = ?");
    if ($stmtCheckSoal === false) {
        die("Failed to prepare statement for validation: " . $conn->error);
    }

    $responden_id_key = 'responden_' . $role . '_id';
    if (!isset($_SESSION[$responden_id_key])) {
        die("Invalid responden_id. The respondent does not exist.");
    }

    $responden_id = $_SESSION[$responden_id_key];

    // Determine the correct table for answers based on the user's role
    $table = "";
    if ($role === 'mahasiswa') {
        $table = "t_jawaban_mahasiswa";
    } else if ($role === 'dosen') {
        $table = "t_jawaban_dosen";
    } else if ($role === 'tendik') {
        $table = "t_jawaban_tendik";
    } else if ($role === 'ortu') {
        $table = "t_jawaban_ortu";
    } else if ($role === 'alumni') {
        $table = "t_jawaban_alumni";
    } else if ($role === 'industri') {
        $table = "t_jawaban_industri";
    } else {
        die("Invalid user role for responses.");
    }

    // Prepare the SQL statement to insert answers
    $stmtInsert = $conn->prepare("INSERT INTO $table (responden_" . $role . "_id, soal_id, jawaban) VALUES (?, ?, ?)");
    if ($stmtInsert === false) {
        die("Failed to prepare statement for insertion: " . $conn->error);
    }

    foreach ($responses as $soal_id => $jawaban) {
        $soal_id = intval($soal_id);
        $jawaban = intval($jawaban);

        $stmtCheckSoal->bind_param("i", $soal_id);
        $stmtCheckSoal->execute();
        $stmtCheckSoal->store_result();
        if ($stmtCheckSoal->num_rows === 0) {
            die("Invalid soal_id: $soal_id. The question does not exist.");
        }

        $stmtInsert->bind_param("iii", $responden_id, $soal_id, $jawaban);
        if (!$stmtInsert->execute()) {
            die("Failed to execute statement: " . $stmtInsert->error);
        }
    }

    $stmtCheckSoal->close();
    $stmtInsert->close();
    $conn->close();

    // Redirect to user dashboard after successful submission
    header("Location: user-dashboard.php?username=" . urlencode($_SESSION['username']) . "&role=" . urlencode($_SESSION['role']));
    exit();
} else {
    die('Invalid submission');
}
?>
