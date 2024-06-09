<?php
session_start();

require_once 'connection.php';

// Debug: Tampilkan nilai session untuk memastikan semuanya sudah di-set
echo '<pre>';
print_r($_SESSION);
echo '</pre>';

if (!isset($_SESSION['survey_id']) || !isset($_SESSION['role']) || !isset($_SESSION['user_id'])) {
    die('Unauthorized accesssssss');
}

$survey_id = $_SESSION['survey_id'];
$role = $_SESSION['role'];
$user_id = $_SESSION['user_id'];

$table_map = [
    'mahasiswa' => 't_jawaban_mahasiswa',
    'dosen' => 't_jawaban_dosen',
    'tendik' => 't_jawaban_tendik',
    'alumni' => 't_jawaban_alumni',
    'industri' => 't_jawaban_industri',
    'ortu' => 't_jawaban_ortu'
];

if (!array_key_exists($role, $table_map)) {
    die('Invalid role');
}

$table_name = $table_map[$role];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['response'])) {
    $responses = $_POST['response'];

    // Debug: Tampilkan response dari form
    echo '<pre>';
    print_r($responses);
    echo '</pre>';

    // Validate soal_id before insertion
    $stmtCheckSoal = $conn->prepare("SELECT soal_id FROM m_survey_soal WHERE soal_id = ?");
    if ($stmtCheckSoal === false) {
        die("Failed to prepare statement for validation: " . $conn->error);
    }

    // Check if responden_mahasiswa_id exists in t_responden_mahasiswa
    $stmtCheckResponden = $conn->prepare("SELECT responden_mahasiswa_id FROM t_responden_mahasiswa WHERE responden_mahasiswa_id = ?");
    if ($stmtCheckResponden === false) {
        die("Failed to prepare statement for validation: " . $conn->error);
    }

    $stmtCheckResponden->bind_param("i", $user_id);
    $stmtCheckResponden->execute();
    $stmtCheckResponden->store_result();
    if ($stmtCheckResponden->num_rows === 0) {
        die("Invalid responden_mahasiswa_id: $user_id. The respondent does not exist.");
    }

    $stmtInsert = $conn->prepare("INSERT INTO $table_name (responden_${role}_id, soal_id, jawaban) VALUES (?, ?, ?)");
    if ($stmtInsert === false) {
        die("Failed to prepare statement for insertion: " . $conn->error);
    }

    foreach ($responses as $soal_id => $jawaban) {
        $soal_id = intval($soal_id);
        $jawaban = intval($jawaban);

        // Check if soal_id exists in m_survey_soal
        $stmtCheckSoal->bind_param("i", $soal_id);
        $stmtCheckSoal->execute();
        $stmtCheckSoal->store_result();
        if ($stmtCheckSoal->num_rows === 0) {
            die("Invalid soal_id: $soal_id. The question does not exist.");
        }

        $stmtInsert->bind_param("iii", $user_id, $soal_id, $jawaban);
        if (!$stmtInsert->execute()) {
            die("Failed to execute statement: " . $stmtInsert->error);
        }
    }

    $stmtCheckSoal->close();
    $stmtCheckResponden->close();
    $stmtInsert->close();
    $conn->close();
    // header("Location: user-dashboard.php");
    exit();
} else {
    die('Invalid submission');
}
?>
