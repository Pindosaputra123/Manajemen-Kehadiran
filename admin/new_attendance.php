<?php
include '../conn.php';
session_start();
if (!isset($_SESSION['user'])) {
    header("location:../index.php");
}

if (isset($_POST['submit'])) {
    $select_missed_student = $conn->query("SELECT * FROM students");
    $i = 0;
    foreach ($select_missed_student as $missed_student) {
        if (!isset($_POST['status'][$missed_student['studentId']])) {
            echo "Student " . $missed_student['fName'] . " " . $missed_student['lName'] . " is absent <br>";
            $i++;
        }
    }
    echo $i;
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
    <title>Kehadiran Baru</title>
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

        .btn-generate {
            background-color: #0b5ed7;
            color: white;
        }

        .btn-generate:hover {
            background-color: #094bb2;
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
                    <a class="nav-link text-light" href="index.php"><i class="fa-solid fa-house"></i> Dashboard</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-light" href="students.php"><i class="fa-solid fa-user-graduate"></i> Siswa</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-light" href="Attendance.php"><i class="fa-brands fa-creative-commons-by"></i> Kehadiran</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-light action" href="new_attendance.php"><i class="fa-solid fa-clipboard-user"></i> Kehadiran Baru</a>
                </li>
                <li class="nav-item mt-auto">
                    <a class="nav-link text-light" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Keluar</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-sm-9">
            <div class="card mt-5">
                <div class="card-header">
                    <h5 class="text-center text-black">Kehadiran Baru</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="list.php">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Deskripsi</span>
                            <input type="text" class="form-control" name="desc" value="Kehadiran harian">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead style="background-color: #0b5ed7; color: white;">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $select_student = $conn->query("SELECT students.*, class.className FROM students INNER JOIN class ON students.classId=class.classId ORDER BY students.fName");
                                    foreach ($select_student as $student) {
                                        $id = $student['studentId'];
                                        echo "<tr>
                                                <td>{$student['studentId']}</td>
                                                <td>{$student['fName']} {$student['lName']}</td>
                                                <td>{$student['className']}</td>
                                                <td><input type='checkbox' name='status[$id]' class='form-check-input' checked></td>
                                              </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-generate">Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../resources/js/bootstrap.min.js"></script>
</body>

</html>
