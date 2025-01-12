<?php
session_start(); // Memulai sesi
include '../conn.php';

// Cek apakah sesi user ada, jika tidak arahkan ke halaman login
if (!isset($_SESSION['user'])) {
    header("location:../index.php");
    exit();
}

// Cek apakah parameter ID ada, jika tidak arahkan ke halaman students.php
if (!isset($_GET['id'])) {
    header("location:students.php");
    exit();
}

$id = $_GET['id'];

// Proses form ketika disubmit
if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $class = $_POST['class'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    // Ambil ID kelas berdasarkan nama kelas
    $select_class = $conn->query("SELECT classId FROM class WHERE className='$class'");
    foreach ($select_class as $cId) {
        $classId = $cId['classId'];
    }

    // Update data siswa
    $insert = $conn->query("UPDATE students SET fName='$fname', lName='$lname', age=$age, classId='$classId', gender='$gender' WHERE studentId=$id");

    // Jika update berhasil, arahkan ke halaman students.php
    if ($insert) {
        header("location:students.php");
        exit();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Edit Siswa</title>
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

        li a:hover,
        .active {
            background-color: #4438c9;
            border-radius: 7px;
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

        <!-- Form Edit -->
        <div class="col-md-9 d-flex justify-content-center align-items-start mt-5">
            <div class="card shadow-sm w-75">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Edit Data Siswa</h4>
                </div>
                <div class="card-body">
                    <?php
                    $select_student = $conn->query("SELECT students.*, class.className FROM students INNER JOIN class ON students.classId=class.classId WHERE studentId=$id");
                    foreach ($select_student as $student) {
                    ?>
                    <form action="" method="post" class="row g-3">
                        <div class="col-md-6">
                            <label for="fname" class="form-label">Nama Depan</label>
                            <input class="form-control" name="fname" id="fname" value="<?= $student['fName'] ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lname" class="form-label">Nama Belakang</label>
                            <input class="form-control" name="lname" id="lname" value="<?= $student['lName'] ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="class" class="form-label">Kelas</label>
                            <select name="class" id="class" class="form-select" required>
                                <?php
                                $selectClass = $conn->query("SELECT classId, className FROM class");
                                foreach ($selectClass as $class) {
                                    $selected = $class['className'] == $student['className'] ? 'selected' : '';
                                    echo "<option value='" . $class['className'] . "' $selected>" . $class['className'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="age" class="form-label">Umur</label>
                            <input class="form-control" name="age" id="age" type="number" value="<?= $student['age'] ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label d-block">Jenis Kelamin</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Laki-laki" <?= $student['gender'] == 'Laki-laki' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="genderMale">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Perempuan" <?= $student['gender'] == 'Perempuan' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="genderFemale">Perempuan</label>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary" type="submit" name="submit">
                                <i class="fa-solid fa-save me-2"></i>Edit Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>