<?php
require_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $survey_nama = $_POST['survey_nama'];
    $survey_jenis = $_POST['survey_jenis'];
    $survey_deskripsi = $_POST['survey_deskripsi'];
    $survey_tanggal = $_POST['survey_tanggal'];

    $sql_insert_survey = "INSERT INTO m_survey (user_id, survey_jenis, survey_nama, survey_deskripsi, survey_tanggal) 
                         VALUES (?, ?, ?, ?, ?)";
    $stmt_insert_survey = $conn->prepare($sql_insert_survey);
    $stmt_insert_survey->bind_param("issss", $user_id, $survey_jenis, $survey_nama, $survey_deskripsi, $survey_tanggal);
    
    
    $user_id = 33;

    if ($stmt_insert_survey->execute()) {
        $survey_id = $conn->insert_id; 
        $stmt_insert_survey->close();
        for ($i = 1; isset($_POST['soal_nama' . $i]); $i++) {
            $soal_nama = $_POST['soal_nama' . $i];
            $soal_jenis = $_POST['soal_jenis' . $i];
            $kategori_id = $_POST['kategori_id' . $i];

            $sql_insert_soal = "INSERT INTO m_survey_soal (survey_id, soal_jenis, soal_nama, kategori_id) 
                                VALUES (?, ?, ?, ?)";
            $stmt_insert_soal = $conn->prepare($sql_insert_soal);
            $stmt_insert_soal->bind_param("issi", $survey_id, $soal_jenis, $soal_nama, $kategori_id);

            if (!$stmt_insert_soal->execute()) {
                echo "Gagal menambahkan pertanyaan ke database" . $stmt_insert_soal->error;
                exit();
            }
            $stmt_insert_soal->close();
        }

        header("Location: admin_survei.php");
        exit();
    } else {
        echo "Gagal membuat survei" . $stmt_insert_survey->error;
    }

    $stmt_insert_survey->close();
    $conn->close();
}
?>
