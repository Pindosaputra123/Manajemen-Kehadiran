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
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Siswa</title>
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

        .table-responsive {
            margin-top: 20px;
        }

        .btn-new {
            background-color: #0b5ed7;
            color: white;
        }

        .btn-new:hover {
            background-color: #083e9c;
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
                    <a class="nav-link text-light active" href="students.php"><i class="fa-solid fa-user-graduate"></i> Siswa</a>
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
        <div class="col-sm-9">
            <div class="card mt-4">
                <div class="card-header text-center">
                    <h5 class="fw-bold">Semua Siswa</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="text-white" style="background-color: #0b5ed7;">
                            <tr>
                                <th>ID</th>
                                <th>Nama Depan</th>
                                <th>Nama Belakang</th>
                                <th>Kelas</th>
                                <th>Jenis Kelamin</th>
                                <th>Umur</th>
                                <th>Edit</th>
                                <th>Hapus</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $select_student = $conn->query("SELECT students.*, class.className FROM students INNER JOIN class ON students.classId = class.classId");
                            if (mysqli_num_rows($select_student) > 0) {
                                foreach ($select_student as $student) {
                                    $id = $student['studentId'];
                                    echo "<tr>
                                        <td>" . $student['studentId'] . "</td>
                                        <td>" . $student['fName'] . "</td>
                                        <td>" . $student['lName'] . "</td>
                                        <td>" . $student['className'] . "</td>
                                        <td>" . $student['gender'] . "</td>
                                        <td>" . $student['age'] . "</td>
                                        <td><a href='update.php?id=$id' class='btn btn-success btn-sm'><i class='fa-solid fa-pen'></i>&nbsp;Edit</a></td>
                                        <td><a href='delete.php?id=$id' class='btn btn-danger btn-sm'><i class='fa-solid fa-trash'></i>&nbsp;Hapus</a></td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8' class='text-center'>No students found</td></tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="new.php" class="btn btn-new"><i class="fa-solid fa-plus"></i>&nbsp;Tambah Siswa Baru</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../resources/js/bootstrap.min.js"></script>
</body>

</html>
