<?php
include '../conn.php';
session_start();
if (!isset($_SESSION['user'])) {
    header("location:../index.php");
}
if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $class = $_POST['class'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $insert = $conn->query("INSERT INTO students(fName, lName, age, classId, gender) VALUES ('$fname', '$lname', '$age', '$class', '$gender')");
    if ($insert) {
        header("location:students.php");
    } else {
        header("location:new.php");
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Tambah Siswa</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            background-color: #4f47e6;
            min-height: 100vh;
            color: #fff;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #4438c9;
            border-radius: 7px;
        }

        .content {
            margin: 0 auto;
            padding: 40px 20px;
            max-width: 800px;
        }

        .card-header {
            background-color: #4f47e6;
            color: white;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #0b5ed7;
            border: none;
        }

        .btn-primary:hover {
            background-color: #084da1;
        }

        .form-control:focus {
            border-color: #4f47e6;
            box-shadow: 0 0 4px rgba(79, 71, 230, 0.5);
        }

        .form-select:focus {
            border-color: #4f47e6;
            box-shadow: 0 0 4px rgba(79, 71, 230, 0.5);
        }
    </style>
</head>

<body>
    <div class="d-flex">
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

        <!-- Content -->
        <div class="content">
            <div class="card shadow">
                <div class="card-header">Tambah Siswa Baru</div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="fname" class="form-label">Nama Depan</label>
                                <input type="text" class="form-control" name="fname" placeholder="Masukkan nama depan" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="lname" class="form-label">Nama Belakang</label>
                                <input type="text" class="form-control" name="lname" placeholder="Masukkan nama belakang" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="class" class="form-label">Kelas</label>
                            <select class="form-select" name="class" required>
                                <?php
                                $selectClass = $conn->query("SELECT classId, className FROM class");
                                foreach ($selectClass as $class) {
                                    echo "<option value='" . $class['classId'] . "'>" . $class['className'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="age" class="form-label">Umur</label>
                                <input type="number" class="form-control" name="age" placeholder="Masukkan Umur" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="Laki-laki" name="gender" value="Laki-laki" checked>
                                    <label class="form-check-label" for="Laki-laki">Laki-laki</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="Perempuan" name="gender" value="Perempuan">
                                    <label class="form-check-label" for="Perempuan">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" name="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah Siswa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../resources/js/bootstrap.min.js"></script>
</body>

</html>
