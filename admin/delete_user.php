<?php
require_once('koneksi.php');

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Query untuk menghapus pengguna berdasarkan user_id
    $sql = "DELETE FROM m_user WHERE user_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Pengguna berhasil dihapus.');
                window.location.href = 'admin_user.php';
              </script>";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID pengguna tidak diberikan.";
}

$conn->close();
?>
