<?php
require_once '../admin/koneksi.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$username = isset($_GET['username']) ? $_GET['username'] : '';
$role = isset($_GET['role']) ? $_GET['role'] : '';
$_SESSION['role'] = $role;

if (!$username) {
    die("Invalid username. Please contact the administrator.");
} else {
    $sql = "SELECT * FROM m_user WHERE username = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $role = $row['role'];
        } else {
            die("User not found.");
        }

        $stmt->close();
    } else {
        die("Database query failed.");
    }
}
$role = $_SESSION['role'];
$user_id = $_SESSION['user_id'];
$survey_ids = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13];

if ($role == "mahasiswa") {
    $survey_status = [];
    foreach ($survey_ids as $survey_id) {
        $stmt = $conn->prepare("SELECT * FROM t_responden_mahasiswa WHERE responden_mahasiswa_id = ? AND survey_id = ?");
        $stmt->bind_param("ii", $user_id, $survey_id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $survey_status[$survey_id] = true;
        } else {
            $survey_status[$survey_id] = false;
        }
        $stmt->close();
    }
    $conn->close();
} else if ($role == "dosen"){
    $survey_status = [];
    foreach ($survey_ids as $survey_id) {
        $stmt = $conn->prepare("SELECT * FROM t_responden_dosen WHERE responden_dosen_id = ? AND survey_id = ?");
        $stmt->bind_param("ii", $user_id, $survey_id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $survey_status[$survey_id] = true;
        } else {
            $survey_status[$survey_id] = false;
        }
        $stmt->close();
    }
    $conn->close();
} else if ($role == "tendik"){
    $survey_status = [];
    foreach ($survey_ids as $survey_id) {
        $stmt = $conn->prepare("SELECT * FROM t_responden_tendik WHERE responden_tendik_id = ? AND survey_id = ?");
        $stmt->bind_param("ii", $user_id, $survey_id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $survey_status[$survey_id] = true;
        } else {
            $survey_status[$survey_id] = false;
        }
        $stmt->close();
    }
    $conn->close();
} else if ($role == "alumni"){
    $survey_status = [];
    foreach ($survey_ids as $survey_id) {
        $stmt = $conn->prepare("SELECT * FROM t_responden_alumni WHERE responden_alumni_id = ? AND survey_id = ?");
        $stmt->bind_param("ii", $user_id, $survey_id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $survey_status[$survey_id] = true;
        } else {
            $survey_status[$survey_id] = false;
        }
        $stmt->close();
    }
    $conn->close();
} else if ($role == "ortu"){
    $survey_status = [];
    foreach ($survey_ids as $survey_id) {
        $stmt = $conn->prepare("SELECT * FROM t_responden_ortu WHERE responden_ortu_id = ? AND survey_id = ?");
        $stmt->bind_param("ii", $user_id, $survey_id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $survey_status[$survey_id] = true;
        } else {
            $survey_status[$survey_id] = false;
        }
        $stmt->close();
    }
    $conn->close();
} else if ($role == "industri"){
    $survey_status = [];
    foreach ($survey_ids as $survey_id) {
        $stmt = $conn->prepare("SELECT * FROM t_responden_ortu WHERE responden_ortu_id = ? AND survey_id = ?");
        $stmt->bind_param("ii", $user_id, $survey_id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $survey_status[$survey_id] = true;
        } else {
            $survey_status[$survey_id] = false;
        }
        $stmt->close();
    }
    $conn->close();
}

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
            background-color: grey;
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
        <a id="logout-link" class="nav-link logout" href="index.php">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
        <div id="logout-popup" class="popup-overlay">
            <div class="popup-content">
                <h2>Konfirmasi Logout</h2>
                <button id="confirm-logout" class="popup-button confirm">Logout</button>
                <button id="cancel-logout" class="popup-button cancel">Cancel</button>
            </div>
        </div>

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

        <div class="survey-content">
            <h2>Pilih Survei</h2>
            <hr class="nav-divider">
            <ul class="survey-list">
                <?php if ($role === 'mahasiswa') : ?>
                    <li class="survey-item">
                        <i class="bi bi-book survey-item-icon"></i>
                        <div class="survey-item-content">
                            <div class="survey-item-title">Survei Akademik Polinema</div>
                            <div class="survey-item-description">Survei mengenai akademik kampus Polinema pada tahun 2024</div>
                        </div>
                        <a href="user-isisurvei.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?>&survey_id=1" class="survey-item-link <?php echo $survey_status[1] ? 'disabled' : ''; ?>" <?php echo $survey_status[1] ? 'onclick="return false;"' : ''; ?>>Lakukan Survei</a>
                    </li>
                    <li class="survey-item">
                        <i class="bi bi-building survey-item-icon"></i>
                        <div class="survey-item-content">
                            <div class="survey-item-title">Survei Fasilitas Polinema</div>
                            <div class="survey-item-description">Survei mengenai fasilitas kampus Polinema pada tahun 2024</div>
                        </div>
                        <a href="user-isisurvei.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?>&survey_id=2" class="survey-item-link <?php echo $survey_status[2] ? 'disabled' : ''; ?>" <?php echo $survey_status[2] ? 'onclick="return false;"' : ''; ?>>Lakukan Survei</a>
                    </li>
                    <li class="survey-item">
                        <i class="bi bi-gear survey-item-icon"></i>
                        <div class="survey-item-content">
                            <div class="survey-item-title">Survei Pelayanan Polinema</div>
                            <div class="survey-item-description">Survei mengenai pelayanan kampus Polinema pada tahun 2024</div>
                        </div>
                        <a href="user-isisurvei.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?>&survey_id=3" class="survey-item-link <?php echo $survey_status[3] ? 'disabled' : ''; ?>" <?php echo $survey_status[3] ? 'onclick="return false;"' : ''; ?>>Lakukan Survei</a>
                    </li>
                <?php elseif ($role === 'dosen') : ?>
                    <li class="survey-item">
                        <i class="bi bi-book survey-item-icon"></i>
                        <div class="survey-item-content">
                            <div class="survey-item-title">Survei Akademik Polinema</div>
                            <div class="survey-item-description">Survei mengenai akademik kampus Polinema pada tahun 2024</div>
                        </div>
                        <a href="user-isisurvei.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?>&survey_id=4" class="survey-item-link <?php echo $survey_status[4] ? 'disabled' : ''; ?>" <?php echo $survey_status[4] ? 'onclick="return false;"' : ''; ?>>Lakukan Survei</a>
                    </li>
                    <li class="survey-item">
                        <i class="bi bi-building survey-item-icon"></i>
                        <div class="survey-item-content">
                            <div class="survey-item-title">Survei Fasilitas Polinema</div>
                            <div class="survey-item-description">Survei mengenai fasilitas kampus Polinema pada tahun 2024</div>
                        </div>
                        <a href="user-isisurvei.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?>&survey_id=5" class="survey-item-link <?php echo $survey_status[5] ? 'disabled' : ''; ?>" <?php echo $survey_status[5] ? 'onclick="return false;"' : ''; ?>>Lakukan Survei</a>
                    </li>
                    <li class="survey-item">
                        <i class="bi bi-gear survey-item-icon"></i>
                        <div class="survey-item-content">
                            <div class="survey-item-title">Survei Pelayanan Polinema</div>
                            <div class="survey-item-description">Survei mengenai pelayanan kampus Polinema pada tahun 2024</div>
                        </div>
                        <a href="user-isisurvei.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?>&survey_id=6" class="survey-item-link <?php echo $survey_status[6] ? 'disabled' : ''; ?>" <?php echo $survey_status[6] ? 'onclick="return false;"' : ''; ?>>Lakukan Survei</a>
                    </li>
                <?php elseif ($role === 'tendik') : ?>
                    <li class="survey-item">
                        <i class="bi bi-gear survey-item-icon"></i>
                        <div class="survey-item-content">
                            <div class="survey-item-title">Survei Pelayanan Polinema</div>
                            <div class="survey-item-description">Survei mengenai pelayanan kampus Polinema pada tahun 2024</div>
                        </div>
                        <a href="user-isisurvei.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?>&survey_id=7" class="survey-item-link <?php echo $survey_status[7] ? 'disabled' : ''; ?>" <?php echo $survey_status[7] ? 'onclick="return false;"' : ''; ?>>Lakukan Survei</a>
                    </li>
                    <li class="survey-item">
                        <i class="bi bi-building survey-item-icon"></i>
                        <div class="survey-item-content">
                            <div class="survey-item-title">Survei Fasilitas Polinema</div>
                            <div class="survey-item-description">Survei mengenai fasilitas kampus Polinema pada tahun 2024</div>
                        </div>
                        <a href="user-isisurvei.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?>&survey_id=8" class="survey-item-link <?php echo $survey_status[8] ? 'disabled' : ''; ?>" <?php echo $survey_status[8] ? 'onclick="return false;"' : ''; ?>>Lakukan Survei</a>
                    </li>
                <?php elseif ($role === 'alumni') : ?>
                    <li class="survey-item">
                        <i class="bi bi-gear survey-item-icon"></i>
                        <div class="survey-item-content">
                            <div class="survey-item-title">Survei Pelayanan Polinema</div>
                            <div class="survey-item-description">Survei mengenai pelayanan kampus Polinema pada tahun 2024</div>
                        </div>
                        <a href="user-isisurvei.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?>&survey_id=9" class="survey-item-link <?php echo $survey_status[9] ? 'disabled' : ''; ?>" <?php echo $survey_status[9] ? 'onclick="return false;"' : ''; ?>>Lakukan Survei</a>
                    </li>
                    <li class="survey-item">
                        <i class="bi bi-people survey-item-icon"></i>
                        <div class="survey-item-content">
                            <div class="survey-item-title">Survei Alumni Polinema</div>
                            <div class="survey-item-description">Survei mengenai pengalaman alumni kampus Polinema pada tahun 2024</div>
                        </div>
                        <a href="user-isisurvei.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?>&survey_id=10" class="survey-item-link <?php echo $survey_status[10] ? 'disabled' : ''; ?>" <?php echo $survey_status[10] ? 'onclick="return false;"' : ''; ?>>Lakukan Survei</a>
                    </li>
                <?php elseif ($role === 'ortu') : ?>
                    <li class="survey-item">
                        <i class="bi bi-gear survey-item-icon"></i>
                        <div class="survey-item-content">
                            <div class="survey-item-title">Survei Pelayanan Polinema</div>
                            <div class="survey-item-description">Survei mengenai pelayanan kampus Polinema pada tahun 2024</div>
                        </div>
                        <a href="user-isisurvei.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?>&survey_id=11" class="survey-item-link <?php echo $survey_status[11] ? 'disabled' : ''; ?>" <?php echo $survey_status[11] ? 'onclick="return false;"' : ''; ?>>Lakukan Survei</a>
                    </li>
                <?php elseif ($role === 'industri') : ?>
                    <li class="survey-item">
                        <i class="bi bi-gear survey-item-icon"></i>
                        <div class="survey-item-content">
                            <div class="survey-item-title">Survei Pelayanan Polinema</div>
                            <div class="survey-item-description">Survei mengenai pelayanan kampus Polinema pada tahun 2024</div>
                        </div>
                        <a href="user-isisurvei.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?>&survey_id=12" class="survey-item-link <?php echo $survey_status[12] ? 'disabled' : ''; ?>" <?php echo $survey_status[12] ? 'onclick="return false;"' : ''; ?>>Lakukan Survei</a>
                    </li>
                    <li class="survey-item">
                        <i class="bi bi-people survey-item-icon"></i>
                        <div class="survey-item-content">
                            <div class="survey-item-title">Survei Alumni Polinema</div>
                            <div class="survey-item-description">Survei mengenai pengalaman alumni kampus Polinema pada tahun 2024</div>
                        </div>
                        <a href="user-isisurvei.php?username=<?php echo urlencode($username); ?>&role=<?php echo urlencode($role); ?>&survey_id=13" class="survey-item-link <?php echo $survey_status[13] ? 'disabled' : ''; ?>" <?php echo $survey_status[13] ? 'onclick="return false;"' : ''; ?>>Lakukan Survei</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</body>
<script>
    document.getElementById('logout-link').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('logout-popup').style.display = 'flex';
    });

    document.getElementById('cancel-logout').addEventListener('click', function() {
        document.getElementById('logout-popup').style.display = 'none';
    });

    document.getElementById('confirm-logout').addEventListener('click', function() {
        window.location.href = 'index.php';
    });
</script>

</html>