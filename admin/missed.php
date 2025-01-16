<?php
include '../conn.php';
session_start();
if (!isset($_SESSION['user'])){
    header("location:../index.php");
}
if(!isset($_GET['id'])){
    header("location:index.php");
}
$id=$_GET['id'];
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Attendance</title>
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

    li a:hover,.active{
        background-color: #4438c9;
        border-radius:7px;
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

        <div class="col-sm-8 mt-5">
            <div class="card">
                <div class="card-header"><h4 class="h5 text-sm-center card-title">Absent students</h4></div>
                <div class="card-body">
                    <div class="table-responsive" id="content">
                        <table class="table table-hover table-striped table-bordered">
                            <thead class="p-2" style="background-color: #0b5ed7;color: white;">
                            <tr>
                                <th>ID</th>
                                <th>Names</th>
                                <th>class</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $select=$conn->query(" SELECT students.studentId,students.fName,students.lName,class.className,attendance.date FROM students INNER JOIN missed ON students.studentId=missed.student_id INNER JOIN class ON class.classId=students.studentId INNER JOIN attendance ON attendance.id=missed.att_id WHERE missed.att_id=$id");
                            if (mysqli_num_rows($select) >0){
                                foreach ($select as $student){
                                    $date=$student['date'];
                                    $formatedDate=date("D,F j,Y",strtotime($date));
                                    echo "<tr>
                                             <td>".$student['studentId']."</td>
                                             <td>".$student['fName']." ".$student['lName']."</td>
                                             <td>".$student['className']."</td>
                                             <td>".$formatedDate."</td>
                                           </tr>
                                         ";
                                }
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>


                    <center><button type="button" class="btn  rounded-2" id="btn" style="background-color: #0b5ed7;color: white"><i class="fa-solid fa-download"></i>&nbsp;Download</button></center>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
<script>
    const btn=document.getElementById("btn");
    btn.addEventListener("click",()=>{
        const content=document.getElementById("content");
        const options = {
            margin: 0.5,
            filename: 'attendance.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        };
        html2pdf().set(options).from(content).save();
        window.location.href("/");
    })
</script>
</body>
</html>