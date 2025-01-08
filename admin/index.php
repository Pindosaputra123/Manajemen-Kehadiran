<?php
include '../conn.php';
session_start();
if (!isset($_SESSION['user'])){
    header("location:../index.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
    <title>Dashboard</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            background-color: #4f47e6;
            min-height: 100vh;
            color: #fff;
        }

        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #4438c9;
            border-radius: 7px;
        }

        .card-custom {
            background-color: #111826;
            color: #fff;
        }

        .card-custom.green {
            background-color: #21c45d;
        }

        .card-custom.blue {
            background-color: #4f47e6;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar p-3">
                <div class="text-center mb-4">
                    <a href="#"><img src="logo.png" alt="Logo" class="rounded-pill" style="width: 100px;"></a>
                    <h4 class="mt-3">Manajemen Kehadiran</h4>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a class="nav-link text-light active" href="index.php"><i class="fa-solid fa-house"></i> Dashboard</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-light" href="students.php"><i class="fa-solid fa-user-graduate"></i> Siswa</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-light" href="Attendance.php"><i class="fa-brands fa-creative-commons-by"></i> Kehadiran</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-light" href="new_attendance.php"><i class="fa-solid fa-clipboard-user"></i> Kehadiran Baru</a>
                    </li>
                    <li class="nav-item mt-auto">
                        <a class="nav-link text-light" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Keluar</a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 p-4">
                <div class="row mb-4">
                    <!-- Students Card -->
                    <div class="col-md-4">
                        <div class="card card-custom p-3">
                            <h5>Siswa</h5>
                            <p class="display-6">26</p>
                            <a href="students.php" class="btn btn-dark btn-sm">Lebih detailnya <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- Attendance Card -->
                    <div class="col-md-4">
                        <div class="card card-custom green p-3">
                            <h5>Kehadiran</h5>
                            <p class="display-6">92%</p>
                            <a href="Attendance.php" class="btn btn-dark btn-sm">Lebih detailnya <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- Missing Card -->
                    <div class="col-md-4">
                        <div class="card card-custom blue p-3">
                            <h5>Hilang</h5>
                            <p class="display-6">8%</p>
                            <a href="Attendance.php" class="btn btn-dark btn-sm">Lebih detailnya <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Recent Attendance Table -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">Kehadiran Terkini</div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kelas</th>
                                    <th>Tanggal</th>
                                    <th>Hilang</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Basis Data</td>
                                    <td>2025-01-02</td>
                                    <td>2</td>
                                    <td><a href="#" class="btn btn-sm btn-primary">Lihat Detail</a></td>
                                </tr>
                                <!-- Add dynamic rows here -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Top Absent Students Table -->
                <div class="card">
                    <div class="card-header bg-primary text-white">Siswa Absen Teratas</div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Depan</th>
                                    <th>Nama Belakang</th>
                                    <th>Kelas</th>
                                    <th>Waktu Terlewatkan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Pindo</td>
                                    <td>Saputra</td>
                                    <td>3B - Informatika</td>
                                    <td>0</td>
                                </tr>
                                <!-- Add dynamic rows here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../resources/js/bootstrap.min.js"></script>
</body>

</html>
