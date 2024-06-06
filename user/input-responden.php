<?php
// Mulai session pada halaman awal
session_start();
require_once 'connection.php'; // Pastikan ini adalah file koneksi yang benar

// Ambil role dari session
if (!isset($_SESSION['role']) || !isset($_SESSION['user_id'])) {
    die("Invalid access. Role or User ID not provided.");
}

$user_role = $_SESSION['role'];
$user_id = $_SESSION['user_id'];
$survey_id = $_GET['survey_id']; // Ambil survey_id dari GET parameter atau sesuaikan sesuai kebutuhan

// Query SQL untuk menambahkan data ke tabel yang sesuai dengan peran (role) pengguna
$sql = "";
if ($user_role === 'mahasiswa') {
    $sql = "INSERT INTO t_responden_mahasiswa (survey_id, responden_tanggal, responden_nim, responden_nama, responden_prodi, responden_email, responden_hp, tahun_masuk)
            SELECT ?, NOW(), nim, nama, prodi, email, no_telp, tahun_masuk
            FROM m_user_data
            WHERE user_id = ?";
} elseif ($user_role === 'dosen') {
    $sql = "INSERT INTO t_responden_dosen (survey_id, responden_tanggal, responden_nip, responden_nama, responden_unit)
            SELECT ?, NOW(), nip, nama, unit
            FROM m_user_data
            WHERE user_id = ?";
} elseif ($user_role === 'tendik') {
    $sql = "INSERT INTO t_responden_tendik (survey_id, responden_tanggal, responden_nopeg, responden_nama, responden_unit)
            SELECT ?, NOW(), no_peg, nama, unit
            FROM m_user_data
            WHERE user_id = ?";
} elseif ($user_role === 'ortu') {
    $sql = "INSERT INTO t_responden_ortu (survey_id, responden_tanggal, responden_nama, responden_jk, responden_umur, responden_hp, responden_pendidikan, responden_pekerjaan, responden_penghasilan)
            SELECT ?, NOW(), nama, jenis_kelamin, umur, no_telp, pendidikan, pekerjaan, penghasilan
            FROM m_user_data
            WHERE user_id = ?";
} elseif ($user_role === 'alumni') {
    $sql = "INSERT INTO t_responden_alumni (survey_id, responden_tanggal, responden_nim, responden_nama, responden_prodi, responden_email, responden_hp, tahun_lulus)
            SELECT ?, NOW(), nim, nama, prodi, email, no_telp, tahun_lulus
            FROM m_user_data
            WHERE user_id = ?";
} elseif ($user_role === 'industri') {
    $sql = "INSERT INTO t_responden_industri (survey_id, responden_tanggal, responden_nama, responden_jabatan, responden_perusahaan, responden_email, responden_hp, responden_kota)
            SELECT ?, NOW(), nama, jabatan, perusahaan, email, no_telp, kota
            FROM m_user_data
            WHERE user_id = ?";
} else {
    die("Invalid user role.");
}

// Eksekusi query SQL untuk menambahkan data ke tabel yang sesuai
if ($sql !== "") {
    $stmt2 = $conn->prepare($sql);
    if ($stmt2 === false) {
        die("Failed to prepare statement: " . $conn->error);
    }

    $stmt2->bind_param("ii", $survey_id, $user_id);
    if ($stmt2->execute()) {
        echo "Data berhasil ditambahkan.";
    } else {
        echo "Error: " . $stmt2->error;
    }
    $stmt2->close();
} else {
    die("No SQL query to execute.");
}

$conn->close();
?>
