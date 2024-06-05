<?php
// Mulai session pada halaman awal
session_start();

// Ambil role dari session
$user_role = $_SESSION['role'];

// Query SQL untuk menambahkan data ke tabel yang sesuai dengan peran (role) pengguna
$sql = "";
if ($user_role === 'mahasiswa') {
    $sql = "INSERT INTO t_responden_mahasiswa (survey_id, responden_tanggal, responden_nim, responden_nama, responden_prodi, responden_email, responden_hp, tahun_masuk)
            SELECT ?, NOW(), nim, nama, prodi, email, no_telp, tahun_lulus
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
} 

// Eksekusi query SQL untuk menambahkan data ke tabel yang sesuai
$stmt2 = $conn->prepare($sql);
$stmt2->bind_param("ii", $survey_id, $user_id); // Pastikan sesuai dengan jumlah placeholder dalam query
$stmt2->execute();
$stmt2->close();
?>