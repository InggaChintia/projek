<?php
require_once 'koneksi.php';

// Ambil data dari form
$survey_id = $_POST['survey_id'];
$kategori_id = $_POST['kategori_id'];
$soal_jenis = $conn->real_escape_string($_POST['soal_jenis']);
$soal_nama = $_POST['soal_nama'];
$edit_soal_id = isset($_POST['edit-soal-id']) ? $_POST['edit-soal-id'] : null;
$edit_soal_jenis = isset($_POST['edit-soal-jenis']) ? $_POST['edit-soal-jenis'] : null;
$edit_soal_nama = isset($_POST['edit-soal-nama']) ? $_POST['edit-soal-nama'] : null;

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
            echo "<script>alert('Soal baru berhasil ditambahkan.'); window.location.href = 'admin_survei.php';</script>";
        } else {
            echo "Error: " . $stmt->error . "<br>";
        }
    }

    $stmt->close();
} else {
    echo "Tidak ada soal baru yang ditambahkan.";
}

// Proses edit data survei
if (is_array($edit_soal_id) && is_array($edit_soal_jenis) && is_array($edit_soal_nama)) {
    for ($i = 0; $i < count($edit_soal_id); $i++) {
        $soal_id = $edit_soal_id[$i];
        $soal_jenis = $conn->real_escape_string($edit_soal_jenis[$i]);
        $soal_nama = $conn->real_escape_string($edit_soal_nama[$i]);

        $sql_update = "UPDATE m_survey_soal SET soal_jenis=?, soal_nama=? WHERE soal_id=?";
        $stmt_update = $conn->prepare($sql_update);
        if ($stmt_update === false) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt_update->bind_param('ssi', $soal_jenis, $soal_nama, $soal_id);
        if ($stmt_update->execute() === TRUE) {
            echo "<script>alert('Soal berhasil diupdate.'); window.location.href = 'admin_survei.php';</script>";
        } else {
            echo "Error: " . $stmt_update->error . "<br>";
        }
        $stmt_update->close();
    }
} else {
    echo "Tidak ada soal yang diupdate.";
}

// Tutup koneksi
$conn->close();
?>
