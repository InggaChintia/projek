<?php
require_once '../admin/koneksi.php';
session_start();
$username = $_GET['username'];
$role = $_GET['role'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_GET['username'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    $sql = "SELECT * FROM m_user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nama = $row['nama'];
        $password_from_db = $row['password'];

        // Verify current password
        if ($current_password == $password_from_db) {
            // Update password
            $sql_update = "UPDATE m_user SET password = ? WHERE username = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("ss", $new_password, $username);
            if ($stmt_update->execute()) {
                $success_message = "Password berhasil diganti.";
                header("Location: user-dashboard.php?username=" . urlencode($_SESSION['username']) . "&role=" . urlencode($_SESSION['role']));
            } else {
                $error_message = "Terjadi kesalahan saat mengganti password. Silakan coba lagi.";
            }
            $stmt_update->close();
        } else {
            $error_message = "Password saat ini tidak sesuai.";
        }
    } else {
        die("Username tidak ditemukan.");
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-control {
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
            padding: 10px;
            width: 100%;
            font-size: 14px;
        }
        .form-group label {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            padding: 12px 20px;
            margin-top: 20px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .alert {
            margin-top: 20px;
            padding: 15px;
            border-radius: 4px;
        }
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ganti Password</h2>
        <?php if (isset($error_message)) : ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <?php if (isset($success_message)) : ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?username=" . urlencode($username); ?>">
            <div class="form-group">
                <label for="current_password">Password Saat Ini</label>
                <input type="password" class="form-control" id="current_password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">Password Baru</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Ganti Password</button>
        </form>
    </div>
</body>
</html>
