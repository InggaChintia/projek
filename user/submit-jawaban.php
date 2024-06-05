<?php
session_start();

if (!isset($_SESSION['survey_id']) || !isset($_SESSION['role']) || !isset($_SESSION['user_id'])) {
    die('Unauthorized access');
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
    $stmt = $conn->prepare("INSERT INTO $table_name (user_id, survey_id, soal_id, jawaban) VALUES (?, ?, ?, ?)");

    foreach ($responses as $soal_id => $jawaban) {
        $soal_id = intval($soal_id);
        $jawaban = intval($jawaban);
        $stmt->bind_param("iiii", $user_id, $survey_id, $soal_id, $jawaban);
        $stmt->execute();
    }

    $stmt->close();
    $conn->close();
    header("Location: thank_you.php"); // Redirect to a thank you page after submission
    exit();
} else {
    die('Invalid submission');
}
?>
