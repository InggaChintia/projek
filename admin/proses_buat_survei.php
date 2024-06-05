<?php
// require_once 'koneksi.php';

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $survey_nama = $_POST['survey_nama'];
//     $survey_jenis = $_POST['survey_jenis'];
//     $survey_deskripsi = $_POST['survey_deskripsi'];
//     $survey_tanggal = $_POST['survey_tanggal'];
//     $kategori_id = $_POST['kategori_id'];
//     // $survey_kode = $_POST['survey_kode'];
//     $user_id = 33;
//     $survey_kode = 'mhs';

//     // input di tabel m_survey
//     $insert_data_survey = mysqli_query($conn, "INSERT INTO m_survey (user_id, survey_jenis, survey_kode, survey_nama, survey_deskripsi, survey_tanggal) VALUES 
//     ($user_id, $survey_jenis, $survey_kode, $survey_nama, $survey_deskripsi, $survey_tanggal)");
//     // input di tabel m_survey_soal


//     // $sql_insert_survey = "INSERT INTO m_survey (user_id, survey_jenis, survey_nama, survey_deskripsi, survey_tanggal) 
//     //                      VALUES (?, ?, ?, ?, ?)";
//     // $stmt_insert_survey = $conn->prepare($sql_insert_survey);
//     // $stmt_insert_survey->bind_param("issss", $user_id, $survey_jenis, $survey_nama, $survey_deskripsi, $survey_tanggal);

//     if (isset($insert_data_survey)) {
//         $survey_id = $conn->insert_id; 
//         for ($i = 1; isset($_POST['soal_' . $i]); $i++) {
//             $soal_nama = $_POST['soal_' . $i];
//             $jenis_soal = $_POST['jenis_soal_' . $i];

//             $sql_insert_soal = "INSERT INTO m_survey_soal (survey_id, kategori_id, soal_jenis, soal_nama) 
//                                 VALUES ($survey_id, $kategori_id, $jenis_soal, $soal_nama)";

//             if (!$isset($sql_insert_soal)) {
//                 echo "Gagal menambahkan pertanyaan ke database";
//                 exit();
//             }
//         }
//         header("Location: admin_survei.php");
//         exit();
//     } else {
//         echo "Gagal membuat survei";
//     }
//     // $stmt_insert_survey->close();
//     // $conn->close();
// }

require_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $survey_nama = $_POST['survey_nama'];
    $survey_jenis = $_POST['survey_jenis'];
    $survey_deskripsi = $_POST['survey_deskripsi'];
    $survey_tanggal = $_POST['survey_tanggal'];
    $kategori_id = $_POST['kategori_id'];
    $user_id = 33; // Misalnya, sesuaikan dengan id admin yang sedang login
    $survey_kode = 'mhs'; // Sesuaikan jika diperlukan

    // Masukkan data survei ke dalam tabel m_survey
    $insert_data_survey = mysqli_query($conn, "INSERT INTO m_survey (user_id, survey_jenis, survey_kode, survey_nama, survey_deskripsi, survey_tanggal) VALUES 
    ($user_id, '$survey_jenis', '$survey_kode', '$survey_nama', '$survey_deskripsi', '$survey_tanggal')");

    if ($insert_data_survey) {
        $survey_id = $conn->insert_id; // Ambil ID survei yang baru saja dibuat

        // Simpan pertanyaan survei ke dalam tabel m_survey_soal
        for ($i = 1; isset($_POST['soal_' . $i]); $i++) {
            $soal_nama = $_POST['soal_' . $i];
            $jenis_soal = $_POST['jenis_soal_' . $i];

            $sql_insert_soal = "INSERT INTO m_survey_soal (survey_id, kategori_id, soal_jenis, soal_nama) 
                                VALUES ($survey_id, $kategori_id, '$jenis_soal', '$soal_nama')";

            $result_insert_soal = mysqli_query($conn, $sql_insert_soal);

            if (!$result_insert_soal) {
                echo "Gagal menambahkan pertanyaan ke database";
                exit();
            }
        }
        header("Location: admin_survei.php");
        exit();
    } else {
        echo "Gagal membuat survei";
    }
    // Tutup koneksi
    $conn->close();
}

?>
