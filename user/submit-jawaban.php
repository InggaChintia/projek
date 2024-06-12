<?php
session_start();

require_once 'connection.php';

echo '<pre>';
print_r($_SESSION);
echo '</pre>';

if (!isset($_SESSION['role']) || !isset($_SESSION['user_id']) || !isset($_SESSION['survey_id'])) {
    die("Invalid access. Role or User ID not provided.");
}

$user_role = $_SESSION['role'];
$user_id = $_SESSION['user_id'];
$survey_id = $_SESSION['survey_id'];
$responden_mahasiswa_id = $_SESSION['user_id'];

$sql = "";
if ($user_role === 'mahasiswa') {
    $sql = "INSERT INTO t_responden_mahasiswa (responden_mahasiswa_id, survey_id, responden_tanggal, responden_nim, responden_nama, responden_prodi, responden_email, responden_hp, tahun_masuk)
    SELECT ?, ?, NOW(), nim, nama, prodi, email, no_telp, tahun_masuk
    FROM m_user_data
    WHERE user_id = ? ";
} else {
    die("Invalid user role.");
}

if ($sql !== "") {
    $stmt2 = $conn->prepare($sql);
    if ($stmt2 === false) {
        die("Failed to prepare statement: " . $conn->error);
    }

    $stmt2->bind_param("iii", $responden_mahasiswa_id, $survey_id, $user_id);
    if ($stmt2->execute()) {
        $_SESSION['responden_mahasiswa_id'] = $responden_mahasiswa_id;
        echo "Data berhasil ditambahkan dengan responden_mahasiswa_id: $responden_mahasiswa_id";
    } else {
        echo "Error: " . $stmt2->error;
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

    if (!isset($_SESSION['responden_mahasiswa_id'])) {
        die("Invalid responden_mahasiswa_id. The respondent does not exist.");
    }

    $responden_mahasiswa_id = $_SESSION['responden_mahasiswa_id'];

    $stmtInsert = $conn->prepare("INSERT INTO t_jawaban_mahasiswa (responden_mahasiswa_id, soal_id, jawaban) VALUES (?, ?, ?)");
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

        $stmtInsert->bind_param("iii", $responden_mahasiswa_id, $soal_id, $jawaban);
        if (!$stmtInsert->execute()) {
            die("Failed to execute statement: " . $stmtInsert->error);
        }
    }

    $stmtCheckSoal->close();
    $stmtInsert->close();
    $conn->close();
    header("Location: user-dashboard.php?username=" . urlencode($_SESSION['username']) . "&role=" . urlencode($_SESSION['role']));
    exit();
} else {
    die('Invalid submission');
}
