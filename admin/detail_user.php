<?php
require_once('koneksi.php');
if (!isset($_GET['user_id']) || !is_numeric($_GET['user_id'])) {
    echo "ID pengguna tidak valid.";
    exit;
}

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Query untuk mengambil data pengguna dari m_user
    $sql_user = "SELECT * FROM m_user WHERE user_id = $user_id";
    $result_user = $conn->query($sql_user);

    if ($result_user->num_rows == 1) {
        $row_user = $result_user->fetch_assoc();

        
        echo "<p><strong>Username:</strong> " . $row_user['username'] . "</p>";
        echo "<p><strong>Role:</strong> " . $row_user['role'] . "</p>";
        $sql_user_data = "SELECT * FROM m_user_data WHERE user_id = $user_id";
        $result_user_data = $conn->query($sql_user_data);

        if ($result_user_data->num_rows > 0) {
            $row_user_data = $result_user_data->fetch_assoc();

           
            if ($row_user['role'] == 'dosen') {
                echo "<p><strong>Nama:</strong> " . $row_user_data['nama'] . "</p>";
                echo "<p><strong>NIP:</strong> " . $row_user_data['nip'] . "</p>";
                echo "<p><strong>Unit:</strong> " . $row_user_data['unit'] . "</p>";
            } elseif ($row_user['role'] == 'mahasiswa') {
                echo "<p><strong>Nama:</strong> " . $row_user_data['nama'] . "</p>";
                echo "<p><strong>NIM:</strong> " . $row_user_data['nim'] . "</p>";
                echo "<p><strong>Jurusan:</strong> " . $row_user_data['jurusan'] . "</p>";
                echo "<p><strong>Program Studi:</strong> " . $row_user_data['prodi'] . "</p>";
                echo "<p><strong>No.Telepon:</strong> " . $row_user_data['no_telp'] . "</p>";
                echo "<p><strong>Email:</strong> " . $row_user_data['email'] . "</p>";
                echo "<p><strong>Tahun Masuk:</strong> " . $row_user_data['tahun_masuk'] . "</p>";
            } elseif ($row_user['role'] == 'tendik') {
                echo "<p><strong>No. Pegawai:</strong> " . $row_user_data['no_peg'] . "</p>";
                echo "<p><strong>Nama:</strong> " . $row_user_data['nama'] . "</p>";
                echo "<p><strong>Unit:</strong> " . $row_user_data['unit'] . "</p>";
            } elseif ($row_user['role'] == 'ortu') {
                echo "<p><strong>Nama:</strong> " . $row_user_data['nama'] . "</p>";
                echo "<p><strong>No.Telepon:</strong> " . $row_user_data['no_telp'] . "</p>";
                echo "<p><strong>Jenis Kelamin:</strong> " . $row_user_data['jenis_kelamin'] . "</p>";
                echo "<p><strong>Umur:</strong> " . $row_user_data['umur'] . "</p>";
                echo "<p><strong>Pendidikan:</strong> " . $row_user_data['pendidikan'] . "</p>";
                echo "<p><strong>Penghasilan:</strong> " . $row_user_data['penghasilan'] . "</p>";
                echo "<p><strong>Nama Mahasiswa:</strong> " . $row_user_data['nama_mahasiswa'] . "</p>";
                echo "<p><strong>NIM Mahasiswa:</strong> " . $row_user_data['nim_mahasiswa'] . "</p>";
                echo "<p><strong>Program Studi:</strong> " . $row_user_data['nama_prodi'] . "</p>";
            } elseif ($row_user['role'] == 'alumni') {
                echo "<p><strong>Nama:</strong> " . $row_user_data['nama'] . "</p>";
                echo "<p><strong>NIM:</strong> " . $row_user_data['nim'] . "</p>";
                echo "<p><strong>Program Studi:</strong> " . $row_user_data['prodi'] . "</p>";
                echo "<p><strong>No.Telepon:</strong> " . $row_user_data['no_telp'] . "</p>";
                echo "<p><strong>Email:</strong> " . $row_user_data['email'] . "</p>";
                echo "<p><strong>Tahun Lulus:</strong> " . $row_user_data['tahun_lulus'] . "</p>";
            } elseif ($row_user['role'] == 'industri') {
                echo "<p><strong>Nama:</strong> " . $row_user_data['nama'] . "</p>";
                echo "<p><strong>No.Telepon:</strong> " . $row_user_data['no_telp'] . "</p>";
                echo "<p><strong>Email:</strong> " . $row_user_data['email'] . "</p>";
                echo "<p><strong>Jabatan:</strong> " . $row_user_data['jabatan'] . "</p>";
                echo "<p><strong>Perusahaan:</strong> " . $row_user_data['perusahaan'] . "</p>";
                echo "<p><strong>Kota:</strong> " . $row_user_data['kota'] . "</p>";
            } else {
                echo "<p>Informasi tidak tersedia untuk role ini.</p>";
            }
        } else {
            echo "<p>Informasi tambahan tidak tersedia.</p>";
        }
    } else {
        echo "Pengguna tidak ditemukan.";
    }
} else {
    echo "ID pengguna tidak diberikan.";
}
?>
