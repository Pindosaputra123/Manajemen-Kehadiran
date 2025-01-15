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
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Kehadiran</title>
</head>
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

    li a:hover, .active {
        background-color: #4438c9;
        border-radius: 7px;
    }
</style>
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
                        <a class="nav-link text-light" href="index.php"><i class="fa-solid fa-house"></i> Dashboard</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-light" href="students.php"><i class="fa-solid fa-user-graduate"></i> Siswa</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-light active" href="Attendance.php"><i class="fa-brands fa-creative-commons-by"></i> Kehadiran</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-light" href="new_attendance.php"><i class="fa-solid fa-clipboard-user"></i> Kehadiran Baru</a>
                    </li>
                    <li class="nav-item mt-auto">
                        <a class="nav-link text-light" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Keluar</a>
                    </li>
                </ul>
            </div>

        <!-- Content -->
        <div class="col-sm-9 mt-4">
            <h2 class="text-center mb-4">Catatan Kehadiran</h2>
            <div class="row">
                <?php
                $select_attendance = $conn->query("SELECT * FROM attendance ORDER BY date DESC");
                if (mysqli_num_rows($select_attendance) > 0) {
                    foreach ($select_attendance as $attendance) {
                        $id = $attendance['id'];
                        $date = $attendance['date'];
                        $formattedDate = date('D, F j, Y', strtotime($date));
                        echo "<div class='col-md-4 mb-4'>
                            <div class='card shadow-sm'>
                                <div class='card-body'>
                                    <h5 class='card-title text-primary'>" . $attendance['attDesc'] . "</h5>
                                    <p class='card-text'>Date: <strong>" . $formattedDate . "</strong></p>
                                    <p class='card-text'>Absent: <strong>" . $attendance['missed'] . "</strong></p>
                                    <a href='missed.php?id=$id' class='btn btn-primary btn-sm'><i class='fa-solid fa-eye'></i>&nbsp;View Absent</a>
                                </div>
                            </div>
                        </div>";
                    }
                } else {
                    echo "<p class='text-center'>Tidak ada catatan kehadiran yang ditemukan.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script src="../resources/js/bootstrap.min.js"></script>
</body>
</html>
