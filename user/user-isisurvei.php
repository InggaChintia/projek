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
            <style>
                body {
                    margin: 0;
                    font-family: Arial, sans-serif;
                    background-color: #f8f9fa;
                }

                .navbar-vertical {
                    background-color: #f0f2f5;
                    color: #304C65;
                    height: 100vh;
                    padding: 20px;
                    position: fixed;
                    width: 250px;
                }

                .navbar-vertical img {
                    width: 45px;
                    margin-bottom: 10px;
                    margin-top: -10px;
                }

                .navbar-vertical p {
                    margin: 0;
                    font-weight: bold;
                    text-align: center;
                    position: relative;
                    margin-top: -50px;
                    margin-left: 54px;
                    font-size: 20px;
                }

                .navbar-vertical .nav-link {
                    color: #304C65;
                    font-weight: 700;
                    padding: 10px;
                    display: flex;
                    align-items: center;
                    border-radius: 5px;
                    margin-top: 10px;
                }

                .navbar-vertical .nav-link i {
                    margin-right: 10px;
                }

                .navbar-vertical .nav-link:hover {
                    background-color: #e0e0e0;
                }

                .navbar-vertical .nav-link.active {
                    background-color: #e0e0e0;
                }

                .navbar-vertical .logout {
                    position: absolute;
                    bottom: 20px;
                    left: 20px;
                    display: flex;
                    align-items: center;
                }

                .content {
                    margin-left: 250px;
                    padding: 0px;
                }

                .content-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    background-color: #304C65;
                    padding: 20px 20px;
                    color: white;
                }

                .content-header .profile {
                    display: flex;
                    align-items: center;
                }

                .content-header .profile-info {
                    text-align: left;
                    display: flex;
                    align-items: center;
                }

                .content-header .profile-info span {
                    margin-right: 10px;
                }

                .survey-content {
                    padding: 20px;
                    background-color: white;
                    border-radius: 8px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }

                .survey-content h2 {
                    margin-bottom: 20px;
                    font-weight: bold;
                }

                .survey-list {
                    list-style: none;
                    padding: 0;
                }

                .survey-item {
                    margin-bottom: 20px;
                    background-color: #f0f2f5;
                    border-radius: 10px;
                    padding: 20px;
                    transition: transform 0.2s;
                    display: flex;
                    align-items: center;
                }

                .survey-item:hover {
                    transform: scale(1.02);
                }

                .survey-item-icon {
                    flex: 0 0 auto;
                    font-size: 2rem;
                    margin-right: 20px;
                }

                .survey-item-content {
                    flex: 1 1 auto;
                }

                .survey-item-title {
                    font-weight: bold;
                    margin-bottom: 5px;
                }

                .survey-item-description {
                    color: #304C65;
                }

                .survey-item-link {
                    margin-top: 10px;
                    display: block;
                    color: white;
                    background-color: #304C65;
                    padding: 10px 20px;
                    border-radius: 5px;
                    text-decoration: none;
                    transition: background-color 0.2s;
                }

                .survey-item-link:hover {
                    background-color: #203040;
                }

                .nav-divider {
                    border: none;
                    height: 2px;
                    background-color: #304C65;
                    margin: 15px 0;
                }
            </style>
        </head>

        <body>
            <div class="navbar-vertical">
                <img src="aset/logopolinema.png" alt="Polinema Logo">
                <p>Survei Polinema</p>
                <hr class="nav-divider">
                <nav class="nav flex-column mt-4">
                    <a class="nav-link active" href="user-dashboard.php">
                        <i class="bi bi-speedometer2"></i> Overview
                    </a>
                    <a class="nav-link" href="user-detailakun-mahasiswa.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?>">
                        <i class="bi bi-person"></i> User
                    </a>
                </nav>
                <a class="nav-link logout" href="user-register.php">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
            <div class="content">
                <div class="content-header">
                    <h1> </h1>
                    <div class="profile">
                        <div class="profile-info">
                            <a href="user-detailakun-mahasiswa.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?>">
                                <span id="profileName" style="color: #f8f9fa;"><?php echo htmlspecialchars($username ?? ''); ?></span>
                            </a>
                            <span> | </span>
                            <span id="profileRole"><?php echo htmlspecialchars($role ?? ''); ?></span>
                        </div>
                    </div>
                </div>
            <div class="container">
                <h2>Isi Survei</h2>
                <form id="surveyForm" action="submit-jawaban.php" method="POST">
                    <input type="hidden" name="username" value="<?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="role" value="<?php echo htmlspecialchars($role, ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="kategori_id" value="<?php echo htmlspecialchars($kategori_id, ENT_QUOTES, 'UTF-8'); ?>">

                <?php foreach ($soal_list as $soal): ?>
                    <div class="form-group">
                    <label><?php echo htmlspecialchars($soal['soal_nama'], ENT_QUOTES, 'UTF-8'); ?></label>
                    <div class="checkpoint">
                        <input type="radio" name="response[<?php echo $soal['soal_id']; ?>]" value="1" required>
                        <label>Sangat Buruk</label>
                        <input type="radio" name="response[<?php echo $soal['soal_id']; ?>]" value="2" required>
                        <label>Buruk</label>
                        <input type="radio" name="response[<?php echo $soal['soal_id']; ?>]" value="3" required>
                        <label>Cukup</label>
                        <input type="radio" name="response[<?php echo $soal['soal_id']; ?>]" value="4" required>
                        <label>Baik</label>
                        <input type="radio" name="response[<?php echo $soal['soal_id']; ?>]" value="5" required>
                        <label>Sangat Baik</label>
                    </div>
                </div>
                <?php endforeach; ?>

                <a href="submit-jawaban.php?survey_id=<?php echo urlencode($kategori_id); ?>&role=<?php echo urlencode($role); ?>&user_id=<?php echo urlencode($username); ?>" class="btn btn-primary">Submit</a>
                </form>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                var submitButton = document.getElementById("submitButton");
                submitButton.addEventListener("click", function() {
                    // Tampilkan prompt konfirmasi
                    var confirmation = confirm("Apakah Anda yakin ingin mengirim jawaban survei?");
                    // Jika pengguna menekan "OK", lanjutkan untuk mengirim jawaban
                    if (confirmation) {
                    document.getElementById("surveyForm").submit();
                    }
                });
                });
            </script>
        </body>
    </html>
