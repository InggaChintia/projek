<?php
require_once 'connection.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = isset($_GET['username']) ? $_GET['username'] : '';
$role = isset($_GET['role']) ? $_GET['role'] : '';
$kategori_id = isset($_GET['kategori_id']) ? (int)$_GET['kategori_id'] : 0;

if (!$username || !$kategori_id) {
    die("Invalid access. Please contact the administrator.");
}

// Query untuk mengambil soal berdasarkan kategori_id
$sql = "SELECT * FROM m_survey_soal WHERE kategori_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $kategori_id);
$stmt->execute();
$result = $stmt->get_result();

$soal_list = [];
while ($row = $result->fetch_assoc()) {
    $soal_list[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Survei</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Isi Survei</h2>
        <form action="submit-jawaban.php" method="POST">
            <input type="hidden" name="username" value="<?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="role" value="<?php echo htmlspecialchars($role, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="kategori_id" value="<?php echo htmlspecialchars($kategori_id, ENT_QUOTES, 'UTF-8'); ?>">

            <?php foreach ($soal_list as $index => $soal) : ?>
                <div class="form-group">
                    <label><?php echo htmlspecialchars($soal['soal_nama'], ENT_QUOTES, 'UTF-8'); ?></label>
                    <div class="checkpoint">
                        <?php
                        $soal_id = htmlspecialchars($soal['soal_id'], ENT_QUOTES, 'UTF-8');
                        ?>
                        <input type="checkbox" id="sangatburuk<?php echo $index; ?>" name="response[<?php echo $soal_id; ?>]" value="1">
                        <label for="sangatburuk<?php echo $index; ?>">Sangat Buruk</label>
                        <input type="checkbox" id="buruk<?php echo $index; ?>" name="response[<?php echo $soal_id; ?>]" value="2">
                        <label for="buruk<?php echo $index; ?>">Buruk</label>
                        <input type="checkbox" id="cukup<?php echo $index; ?>" name="response[<?php echo $soal_id; ?>]" value="3">
                        <label for="cukup<?php echo $index; ?>">Cukup</label>
                        <input type="checkbox" id="baik<?php echo $index; ?>" name="response[<?php echo $soal_id; ?>]" value="4">
                        <label for="baik<?php echo $index; ?>">Baik</label>
                        <input type="checkbox" id="sangatbaik<?php echo $index; ?>" name="response[<?php echo $soal_id; ?>]" value="5">
                        <label for="sangatbaik<?php echo $index; ?>">Sangat Baik</label>
                    </div>
                </div>
            <?php endforeach; ?>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>