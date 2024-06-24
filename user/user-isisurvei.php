<?php
require_once '../admin/koneksi.php';
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = isset($_GET['username']) ? $_GET['username'] : '';
$role = isset($_GET['role']) ? $_GET['role'] : '';
$survey_id = isset($_GET['survey_id']) ? (int)$_GET['survey_id'] : 0;
$role = $_SESSION['role'];
if (!$username || !$survey_id) {
    die("Invalid access. Please contact the administrator.");
}


$sql = "SELECT * FROM m_survey_soal WHERE survey_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $survey_id);
$stmt->execute();
$result = $stmt->get_result();

$soal_list = [];
while ($row = $result->fetch_assoc()) {
    $soal_list[] = $row;
}
$_SESSION['survey_id']= $survey_id;
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survei Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">
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

        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            /* z-index: 1000; */
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            color : black;
            text-align: center;
            width: 390px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .popup-button {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .popup-button.confirm {
            background-color: #203040;
            color: white;
        }

        .popup-button.cancel {
            background-color: orangered;
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
            height: 65px;
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

        .survey-item-link.disabled {
            pointer-events: none;
            color: grey !important;
            border-color: grey !important;
            cursor: not-allowed;
            background-color: #e9ecef !important;
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

        .instructions {
        background-color: #f0f2f5;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .instructions p {
        font-size: 16px;
        line-height: 1.6;
    }

    .instructions ul {
        list-style: none;
        padding: 0;
        margin: 10px 0;
    }

    .instructions ul li {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }

    .instructions ul li i {
        font-size: 1.5rem;
        margin-right: 10px;
    }

    /* CSS untuk bagian surveyForm */
    #surveyForm {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    #surveyForm h2 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #304C65;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: bold;
        color: #304C65;
    }

    .emoticon-rating {
        display: flex;
        align-items: center;
        justify-content: space-between;
        max-width: 400px;
        margin-top: 10px;
    }

    .emoticon-rating input[type="radio"] {
        display: none;
    }

    .emoticon-rating label {
        font-size: 2rem;
        cursor: pointer;
        padding: 15px;
        border-radius: 50%;
        transition: transform 0.2s, color 0.2s;
        box-shadow: none;
        display: inline-flex;
        align-items: center;
    }

    .emoticon-rating input[type="radio"]:checked + label {
        box-shadow: 0 0 0 2px blue;
    }

    .emoticon-rating label:hover {
        transform: scale(1.1);
    }

    .emoticon-rating label[for^="sangatburuk"] {
        color: red;
    }

    .emoticon-rating label[for^="buruk"] {
        color: orange;
    }

    .emoticon-rating label[for^="cukup"] {
        color: yellow;
    }

    .emoticon-rating label[for^="baik"] {
        color: lightgreen;
    }

    .emoticon-rating label[for^="sangatbaik"] {
        color: green;
    }

    /* Tombol Submit */
    button[type="submit"] {
        background-color: #304C65;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    button[type="submit"]:hover {
        background-color: #203040;
    }

    /* Pesan Error */
    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 10px;
        display: none; /* Sembunyikan pesan error secara default */
    }

    /* Respon untuk layar kecil */
    @media (max-width: 768px) {
        .instructions {
            padding: 15px;
        }

        .emoticon-rating label {
            font-size: 1.5rem;
            padding: 10px;
        }
    }
</style>
</head>
<body>
    <div class="navbar-vertical">
        <img src="aset/logopolinema.png" alt="Polinema Logo">
        <p>Survei Polinema</p>
        <hr class="nav-divider">
        <nav class="nav flex-column mt-4">
            <a class="nav-link active" href="user-dashboard.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?>">
                <i class="bi bi-speedometer2"></i> Overview
            </a>
            <a class="nav-link" href="user-detailakun.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?>">
                <i class="bi bi-person"></i> User
            </a>
        </nav>
        <a class="nav-link logout" href="index.php">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
    <div class="content">
        <div class="content-header">
            <h1 style="font-size: 20pt;">Survei Dashboard</h1>
            <div class="profile">
                <div class="profile-info">
                    <a href="user-detailakun.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?>">
                        <span id="profileName" style="color: #f8f9fa;"><?php echo htmlspecialchars($username ?? ''); ?></span>
                    </a>
                    <span> | </span>
                    <span id="profileRole"><?php echo htmlspecialchars($role ?? ''); ?></span>
                </div>
            </div>
        </div>
        <div class="container">

        <div class="container">
    <div class="instructions">
        <h4>Harap Pastikan Seluruh Soal Telah Terisi</h4>
        <p>Untuk mengerjakan survei ini, Anda dapat memilih salah satu pilihan berikut dengan keterangan sebagai berikut:</p>
        <ul>
            <li><i class="fas fa-sad-tear"></i> = Sangat Buruk</li>
            <li><i class="fas fa-frown"></i> = Buruk</li>
            <li><i class="fas fa-meh"></i> = Cukup</li>
            <li><i class="fas fa-smile"></i> = Baik</li>
            <li><i class="fas fa-laugh-beam"></i> = Sangat Baik</li>
        </ul>
    </div>

            <form id="surveyForm" action="submit-jawaban.php" method="POST">
                <input type="hidden" name="username" value="<?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="role" value="<?php echo htmlspecialchars($role, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="survey_id" value="<?php echo htmlspecialchars($survey_id, ENT_QUOTES, 'UTF-8'); ?>">

                <?php if (empty($soal_list)) : ?>
                    <div>
                        <h3>Survei belum dibuat, Hubungi admin</h3>
                    </div>
                <?php else : ?>
                    <h2>Silahkan mengisi survei sesuai dengan pengalaman Anda</h2>
                    <?php foreach ($soal_list as $index => $soal) : ?>
                        <div class="form-group">
                            <label><?php echo htmlspecialchars($soal['soal_nama'], ENT_QUOTES, 'UTF-8'); ?></label>
                            <div class="radio" style="padding-left: 7px;">
                                <?php
                                $soal_id = htmlspecialchars($soal['soal_id'], ENT_QUOTES, 'UTF-8');
                                ?>
                                <div class="emoticon-rating">
                                    <input type="radio" id="sangatburuk<?php echo $index; ?>" name="response[<?php echo $soal_id; ?>]" value="1" class="response">
                                    <label for="sangatburuk<?php echo $index; ?>"><i class="fas fa-sad-tear"></i></label>

                                    <input type="radio" id="buruk<?php echo $index; ?>" name="response[<?php echo $soal_id; ?>]" value="2" class="response">
                                    <label for="buruk<?php echo $index; ?>"><i class="fas fa-frown"></i></label>

                                    <input type="radio" id="cukup<?php echo $index; ?>" name="response[<?php echo $soal_id; ?>]" value="3" class="response">
                                    <label for="cukup<?php echo $index; ?>"><i class="fas fa-meh"></i></label>

                                    <input type="radio" id="baik<?php echo $index; ?>" name="response[<?php echo $soal_id; ?>]" value="4" class="response">
                                    <label for="baik<?php echo $index; ?>"><i class="fas fa-smile"></i></label>

                                    <input type="radio" id="sangatbaik<?php echo $index; ?>" name="response[<?php echo $soal_id; ?>]" value="5" class="response">
                                    <label for="sangatbaik<?php echo $index; ?>"><i class="fas fa-laugh-beam"></i></label>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="error-message" id="error-message">Harap isi semua pertanyaan sebelum mengirim.</div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                <?php endif; ?>
            </form>
        </div>

    </div>
    <script>
        document.getElementById('surveyForm').addEventListener('submit', function(event) {
            let allAnswered = true;
            const responseGroups = document.querySelectorAll('.form-group');
            responseGroups.forEach(group => {
                const inputs = group.querySelectorAll('.response');
                let isChecked = false;
                inputs.forEach(input => {
                    if (input.checked) {
                        isChecked = true;
                    }
                });
                if (!isChecked) {
                    allAnswered = false;
                }
            });
            if (!allAnswered) {
                event.preventDefault();
                alert('Harap isi semua pertanyaan sebelum mengirim.');
            }
        });
    </script>
</body>

</html>