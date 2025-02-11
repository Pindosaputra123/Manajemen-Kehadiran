<?php
include '../conn.php';
session_start();
if (!isset($_SESSION['user'])){
    header("location:../index.php");
}
if (!isset($_POST['submit'])){
    header("location:index.php");
}

if (isset($_POST['submit'])) {
    $desc=$_POST['desc'];
    $select_missed_student = $conn->query("SELECT students.*,class.className FROM  students INNER JOIN class ON class.classId=students.classId");
     $i=0;
    if (mysqli_num_rows($select_missed_student) > 0) {
        foreach ($select_missed_student as $missed_student) {
            if (!isset($_POST['status'][$missed_student['studentId']])) {
             $i++;
            }
        }
    }
    $insert=$conn->query("INSERT INTO attendance(missed,attDesc) VALUES ('$i','$desc')");
    if (!$insert) echo "<script>alert('attendance not inserted')</script>";
}

?>
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

    li a:hover,.active{
        background-color: #4438c9;
        border-radius:7px;
    }

</style>
<body>
<div class="container-fluid">
    <div class="row">
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

        <div class="col-sm-8 mt-5">
            <div class="card">
                <div class="card-header"><h4 class="h5 text-sm-center card-title">Kehadiran Siswa</h4></div>
                <div class="card-body">
                    <div class="table-responsive" id="content">
                        <table class="table table-hover table-striped table-bordered">
                            <thead class="p-2" style="background-color: #0a53be;color: white">
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($_POST['submit'])){
                                $select_missed_student=$conn->query("SELECT students.*,class.className FROM  students INNER JOIN class ON class.classId=students.classId");
                                $select_att=$conn->query("SELECT  id FROM attendance ORDER BY id DESC LIMIT 1");
                                if (mysqli_num_rows($select_missed_student) > 0 && mysqli_num_rows($select_att )>0){
                                    foreach ($select_missed_student as $missed_student){
                                        if (!isset($_POST['status'][$missed_student['studentId']])){
                                            foreach ($select_att as $att){
                                                $stdId=$missed_student['studentId'];
                                                $attId=$att['id'];
                                                $insert_missed=$conn->query("INSERT INTO missed(att_id,student_id) VALUES ('$attId','$stdId')");
                                                if(!$insert) echo "<script>alert('student not inserted')</script>";
                                            }
                                            echo "<tr>
                                                 <td>".$missed_student['studentId']."</td>
                                                  <td>".$missed_student['fName']." ".$missed_student['lName']."</td>
                                                   <td>".$missed_student['className']."</td>
                                               </tr>";
                                        }
                                    }
                                }
                                else{
                                    echo "<td>No students found</td>";
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>


                    <center><button type="button" class="btn rounded-2" id="btn" style="background-color: #0b5ed7"><i class="fa-solid fa-download"></i>&nbsp;Download</button></center>
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