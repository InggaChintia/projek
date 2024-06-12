<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survei Polinema</title>
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
            margin-bottom: 15px;
            margin-top: -10px;
        }
        .navbar-vertical .nav-link img {
            width: 20px;
            height: 20px;
            margin-top: 10px;
            padding: 3px;
            margin-right: 10px;
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
            padding: 0px;
            display: block;
            border-radius: 5px;
            font-size: 14px;
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
        }
        .content {
            margin-left: 240px;
            padding: 0px;
        }
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #304C65;
            padding: 8px 20px;
            color: white;
        }
        .content-header .profile {
            display: flex;
            align-items: center;
            font-size: 14px;
            margin-top: 5px;
            margin-bottom: 5px;
        }
        .survey-content {
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .survey-content h2 {
            margin-bottom: 20px;
            margin-left: 20px;
            font-weight: bold;
            font-size: 20px;
        }
        .nav-divider {
            border: none;
            height: 2px; 
            background-color: #304C65; 
            margin: 10px 0;
        }
        .filter-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .filter-section h3 {
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 14px;
        }
        .filter-section .filter-group {
            margin-bottom: 20px;
            font-size: 14px;
        }
        .filter-section .filter-group select,
        .filter-section .filter-group input[type="date"] {
            width: 150px;
            padding: 10px;
            border-radius: 20px;
            border: 1px solid #ccc;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
        }
        .filter-section .filter-group input[type="date"] {
            background: url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/fonts/fontawesome-webfont.svg#calendar') no-repeat right 10px center;
        }
        .filter-section .chart-container {
            width: 700px; 
            margin-right: 70px;
            margin-bottom: 20px;
        }
        .filter-section .chart-container canvas {
            width: 100%; 
        }
        .table-container, .table-priority {
            width: 48%;
            margin-bottom: 50px;
        }
        .table-container table, .table-priority table {
            width: 100%;
            border-collapse: collapse;
        }
        .table-container th, .table-container td, .table-priority th, td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
        }
        .table-container th, .table-priority th {
            background-color: #f2f2f2;
        }
        .tables-wrapper {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Fungsi untuk mengupdate grafik
        function updateChart(chart, timeFilter) {
            let labels, data;

            if (timeFilter === 'Hari') {
                labels = Array.from({length: 30}, (_, i) => i + 1); // Days of the month
                data = [10, 15, 20, 25, 30, 35, 40, 45, 50, 45, 40, 35, 30, 25, 20, 15, 10, 15, 20, 25, 30, 35, 40, 45, 50, 45, 40, 35, 30, 25];
            } else if (timeFilter === 'Bulan') {
                labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                data = [300, 250, 320, 400, 350, 380, 420, 450, 410, 390, 370, 360];
            }

            chart.data.labels = labels;
            chart.data.datasets[0].data = data;
            chart.update();
        }

        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('surveyChart').getContext('2d');
            var surveyChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: Array.from({length: 30}, (_, i) => i + 1), // Days of the month
                    datasets: [{
                        label: 'Pengisian Survei',
                        data: [10, 15, 20, 25, 30, 35, 40, 45, 50, 45, 40, 35, 30, 25, 20, 15, 10, 15, 20, 25, 30, 35, 40, 45, 50, 45, 40, 35, 30, 25],
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            document.getElementById('waktu').addEventListener('change', function() {
                updateChart(surveyChart, this.value);
            });
        });
    </script>
    </head>
    <body>
        <div class="navbar-vertical">
            <img src="aset/logopolinema.png" alt="Polinema Logo">
            <p>Survei Polinema</p>
            <hr class="nav-divider">
            <nav class="nav flex-column mt-4">
                <a class="nav-link active" href="#"><img src="aset/overview.png" alt="Overview Icon">Overview</a>
                <a class="nav-link" href="admin_user.php"><img src="aset/users.png" alt="User Icon">User</a>
                <a class="nav-link" href="admin_datasurvei_dashboard.php"><img src="aset/data.png" alt="Data Survei Icon">Data Survei</a>
                <a class="nav-link" href="admin_survei.php"><img src="aset/survei.png" alt="Survei Icon">Survei</a>
            </nav>
            <a class="nav-link logout" href="../user/user_registrasi.php">Logout</a>
        </div>
        <div class="content">
            <div class="content-header">
                <h1>  </h1>
                <div class="profile">
                    <a class="nav-link" href="admin_profile.php">
                    <span>Admin</span></a>
                </div>
            </div>
            <div class="survey-content">
                <h2>Overview</h2>
                <hr class="nav-divider">
                <div class="filter-section">
                    <div>
                        <h3>Filter</h3>
                        <div class="filter-group">
                            <label for="role">Role:</label>
                            <select id="role" name="role">
                                <option value="" disabled selected>Pilih</option>
                                <option value="guest">Mahasiswa</option>
                                <option value="admin">Dosen</option>
                                <option value="user">Tendik</option>
                                <option value="guest">Alumni</option>
                                <option value="guest">OrangTua/Wali Mahasiswa</option>
                                <option value="guest">Industri</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label for="waktu">Waktu:</label>
                            <select id="waktu" name="waktu">
                                <option value="" disabled selected>Pilih</option>
                                <option value="Hari">Hari</option>
                                <option value="Bulan">Bulan</option>
                                <option value="Tahun">Tahun</option>
                            </select>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="surveyChart"></canvas>
                    </div>
                </div>

                <!-- Wrapper untuk dua tabel -->
                <div class="tables-wrapper">
                    <!-- Tabel Poin Kategori -->
                    <div class="table-container">
                        <h3>Poin Kategori</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th>Jumlah Point</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Fasilitas</td>
                                    <td>455</td>
                                </tr>
                                <tr>
                                    <td>Akademik</td>
                                    <td>255</td>
                                </tr>
                                <tr>
                                    <td>Pelayanan</td>
                                    <td>285</td>
                                </tr>
                                <tr>
                                    <td>Alumni</td>
                                    <td>100</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Tabel Urutan Prioritas -->
                    <div class="table-priority">
                        <h3>Urutan Prioritas</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Fasilitas</td>
                                </tr>
                                <tr>
                                    <td>2. </td>
                                    <td>Akademik</td>
                                </tr>
                                <tr>
                                    <td>3. </td>
                                    <td>Pelayanan</td>
                                </tr>
                                <tr>
                                    <td>4. </td>
                                    <td>Alumni</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Script untuk chart -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Fungsi untuk mengupdate grafik
            function updateChart(chart, timeFilter) {
                let labels, data;

                if (timeFilter === 'Hari') {
                    labels = Array.from({length: 30}, (_, i) => i + 1); // Days of the month
                    data = [10, 15, 20, 25, 30, 35, 40, 45, 50, 45, 40, 35, 30, 25, 20, 15, 10, 15, 20, 25, 30, 35, 40, 45, 50, 45, 40, 35, 30, 25];
                } else if (timeFilter === 'Bulan') {
                    labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    data = [300, 250, 320, 400, 350, 380, 420, 450, 410, 390, 370, 360];
                } else if (timeFilter === 'Tahun') {
                    labels = ['2018', '2019', '2020', '2021', '2022', '2023'];
                    data = [3200, 3500, 3000, 3800, 4200, 3900];
                }

                chart.data.labels = labels;
                chart.data.datasets[0].data = data;
                chart.update();
            }

            document.addEventListener('DOMContentLoaded', function() {
                var ctx = document.getElementById('surveyChart').getContext('2d');
                var surveyChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: Array.from({length: 30}, (_, i) => i + 1), // Days of the month
                        datasets: [{
                            label: 'Pengisian Survei',
                            data: [10, 15, 20, 25, 30, 35, 40, 45, 50, 45, 40, 35, 30, 25, 20, 15, 10, 15, 20, 25, 30, 35, 40, 45, 50, 45, 40, 35, 30, 25],
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1,
                            fill: false
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                document.getElementById('waktu').addEventListener('change', function() {
                    updateChart(surveyChart, this.value);
                });
            });
        </script>
    </body>
</html>
