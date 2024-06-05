<?php
session_start();

if (!isset($_SESSION['survey_id']) || !isset($_SESSION['role'])) {
    die('Unauthorized access');
}

$survey_id = $_SESSION['survey_id'];
$role = $_SESSION['role'];
$user_id = $_SESSION['user_id']; // Assuming user_id is stored in session

// Fetch survey details
$sql_survey = "SELECT survey_nama, survey_deskripsi FROM m_survey WHERE survey_id = ?";
$stmt_survey = $conn->prepare($sql_survey);
$stmt_survey->bind_param("i", $survey_id);
$stmt_survey->execute();
$result_survey = $stmt_survey->get_result();

if ($result_survey->num_rows > 0) {
    $survey = $result_survey->fetch_assoc();
    $survey_nama = htmlspecialchars($survey['survey_nama']);
    $survey_deskripsi = htmlspecialchars($survey['survey_deskripsi']);
} else {
    die('Survey not found');
}

$stmt_survey->close();

// Fetch survey questions
$sql_questions = "SELECT no_urut, soal_id, soal_nama FROM m_survey_soal WHERE survey_id = ? ORDER BY no_urut";
$stmt_questions = $conn->prepare($sql_questions);
$stmt_questions->bind_param("i", $survey_id);
$stmt_questions->execute();
$result_questions = $stmt_questions->get_result();

$surveyQuestions = [];
if ($result_questions->num_rows > 0) {
    while ($question = $result_questions->fetch_assoc()) {
        $surveyQuestions[] = $question;
    }
}
$stmt_questions->close();
$conn->close();

// Store questions in session
$_SESSION['surveyQuestions'] = $surveyQuestions;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survei Ortu Pelayanan</title>
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
            margin-top: 20px;
            width: 95%;
            margin-left: auto;
            margin-right: auto;
        }
        .survey-content h2, h5 {
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
            color: #304C65;
        }
        .survey-content label {
            font-size: 1em; 
        }
        .nav-divider {
            border: none;
            height: 2px; 
            background-color: #304C65; 
            margin: 15px 0;
        }
        .btn-custom {
            background-color: #304C65;
            color: white;
            font-weight: bold;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #203347;
        }
        .checkpoint {
            display: flex;
            gap: 10px;
            margin: 10px 0;
        }
        .checkpoint input[type="radio"] {
            display: none;
        }
        .checkpoint label {
            background-color: #e0e0e0;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
            font-weight: bold;
            color: #304C65;
        }
        .checkpoint input[type="radio"]:checked + label {
            background-color: #304C65;
            color: white;
        }
        .checkpoint label:hover {
            background-color: #d4d4d4;
        }
        .btn-container {
            display: flex;
            justify-content: center; /* Center the button */
            margin-top: 20px;
        }
    </style>
    <script>
        function validateForm() {
            const form = document.forms["surveyForm"];
            const checkpoints = form.querySelectorAll('.checkpoint input:checked');
            if (checkpoints.length < <?php echo count($surveyQuestions); ?>) {
                alert("Mohon isi semua pertanyaan.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="navbar-vertical">
        <img src="aset/logopolinema.png" alt="Polinema Logo">
        <p>Survei Polinema</p>
        <hr class="nav-divider">
        <nav class="nav flex-column mt-4">
            <a class="nav-link active" href="user-dashboard-ortu.php">
                <i class="bi bi-speedometer2"></i> Overview
            </a>
            <a class="nav-link" href="user-detailakun-ortu.php">
                <i class="bi bi-person"></i> User
            </a>
        </nav>
        <a class="nav-link logout" href="user-register.php">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
    <div class="content">
        <div class="content-header">
            <h1><?php echo $survey_nama; ?></h1>
            <div class="profile">
                <div class="profile-info">
                    <a href="user-detailakun-mahasiswa.php">
                        <span id="profileName" style="color: #f8f9fa;"><?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?></span>
                    </a>
                    <span> | </span>
                    <span id="profileRole"><?php echo htmlspecialchars($role); ?></span>
                </div>
            </div>
        </div>
        <div class="survey-content">
            <h2><?php echo $survey_nama; ?></h2>
            <h5><?php echo $survey_deskripsi; ?></h5>
            <form name="surveyForm" method="post" action="submit_survey.php" onsubmit="return validateForm()">
                <?php
                if (!empty($surveyQuestions)) {
                    foreach ($surveyQuestions as $question) {
                        $no_urut = htmlspecialchars($question['no_urut']);
                        $soal_id = htmlspecialchars($question['soal_id']);
                        $soal_nama = htmlspecialchars($question['soal_nama']);
                        echo '<div class="form-group">';
                        echo '<label for="question' . $no_urut . '">' . $no_urut . '. ' . $soal_nama . '</label>';
                        echo '<div class="checkpoint">';
                        echo '<input type="radio" id="sangatburuk' . $no_urut . '" name="response[' . $soal_id . ']" value="1">';
                        echo '<label for="sangatburuk' . $no_urut . '">Sangat Buruk</label>';
                        echo '<input type="radio" id="buruk' . $no_urut . '" name="response[' . $soal_id . ']" value="2">';
                        echo '<label for="buruk' . $no_urut . '">Buruk</label>';
                        echo '<input type="radio" id="cukup' . $no_urut . '" name="response[' . $soal_id . ']" value="3">';
                        echo '<label for="cukup' . $no_urut . '">Cukup</label>';
                        echo '<input type="radio" id="baik' . $no_urut . '" name="response[' . $soal_id . ']" value="4">';
                        echo '<label for="baik' . $no_urut . '">Baik</label>';
                        echo '<input type="radio" id="sangatbaik' . $no_urut . '" name="response[' . $soal_id . ']" value="5">';
                        echo '<label for="sangatbaik' . $no_urut . '">Sangat Baik</label>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>Tidak ada soal survei yang tersedia saat ini.</p>";
                }
                ?>
                <div class="btn-container">
                    <button type="submit" class="btn-custom">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
