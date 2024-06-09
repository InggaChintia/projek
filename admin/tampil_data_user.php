<?php
// Tambahkan header di sini
header('Content-Type: text/html');

require_once 'koneksi.php';

if (isset($_POST['role'])) {
    $role = $_POST['role'];

    // Debugging - Tampilkan role yang dipilih
    error_log("Role yang dipilih: " . $role);

    // Query untuk mengambil data berdasarkan role
    $query = "SELECT nama, role FROM m_user_data WHERE role = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $role);
    $stmt->execute();
    $result = $stmt->get_result();

    // Debugging - Tampilkan hasil query
    error_log("Jumlah hasil: " . $result->num_rows);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='user-info'><span>" . $row["nama"] . "</span></td>";
            echo "<td>" . $row["role"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='2'>Tidak ada data ditemukan</td></tr>";
    }
    $stmt->close();
    $conn->close();
}
?>
