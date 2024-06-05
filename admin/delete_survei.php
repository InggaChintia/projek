<?php
session_start();

require_once 'koneksi.php';

// if (!isset($_SESSION['user_id'])) {
//     header("Location: admin_survei.php");
//     exit();
// }

if (!isset($_GET['id'])) {
    die("ID survei tidak diberikan.");
}

$id = $_GET['id'];

$sql_delete_soal = "DELETE FROM m_survey_soal WHERE survey_id = ?";
$stmt_delete_soal = $conn->prepare($sql_delete_soal);
$stmt_delete_soal->bind_param("i", $id);
$stmt_delete_soal->execute();
$stmt_delete_soal->close();

$sql_delete_survei = "DELETE FROM m_survey WHERE survey_id = ?";
$stmt_delete_survei = $conn->prepare($sql_delete_survei);
$stmt_delete_survei->bind_param("i", $id);
$stmt_delete_survei->execute();
$stmt_delete_survei->close();

header("Location: admin_survei.php");
exit();