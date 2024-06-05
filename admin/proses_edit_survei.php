<?php
require_once 'koneksi.php';

// Ambil data dari form
$survey_id = $_POST['survey_id'];
$kategori_id = $_POST['kategori_id'];
$soal_jenis = $conn->real_escape_string($_POST['soal_jenis']);
$soal_nama = $_POST['soal_nama'];


if (is_array($soal_nama)) {
    $sql = "INSERT INTO m_survey_soal (survey_id, kategori_id, soal_jenis, soal_nama) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    foreach ($soal_nama as $soal) {
        $soal = $conn->real_escape_string($soal);
        $stmt->bind_param('iiss', $survey_id, $kategori_id, $soal_jenis, $soal);

        if ($stmt->execute() === TRUE) {
            echo "<script>alert('Data survei berhasil ditambahkan.'); window.location.href = 'admin_survei.php';</script>";
        } else {
            echo "Error: " . $stmt->error . "<br>";
        }
    }

    $stmt->close();
    // Proses edit data survei
    if (isset($_POST['edit-soal-id']) && isset($_POST['edit-soal-jenis']) && isset($_POST['edit-soal-nama'])) {
        $soal_id = $_POST['edit-soal-id'];
        $soal_jenis = $_POST['edit-soal-jenis'];
        $soal_nama = $_POST['edit-soal-nama'];

        $sql_update = "UPDATE m_survey_soal SET soal_jenis='$soal_jenis', soal_nama='$soal_nama' WHERE soal_id=$soal_id";

        if ($conn->query($sql_update) === TRUE) {
            echo "Data survei berhasil diupdate.";
        } else {
            echo "Error: " . $sql_update . "<br>" . $conn->error;
        }
    }
} else {
    echo "Tidak ada soal yang ditambahkan.";
}


// Tutup koneksi
$conn->close();
