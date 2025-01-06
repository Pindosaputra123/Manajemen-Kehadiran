<?php
session_start();
include "conn.php";

if (isset($_POST['submit'])) {
    $uname = $_POST['uname'];
    $psw = $_POST['pass'];
    $select = $conn->query("SELECT * FROM users WHERE userName='$uname' AND password='$psw'");
    if (mysqli_num_rows($select) > 0) {
        $_SESSION['user'] = $uname;
        header("location:admin/");
    } else {
        header("location:index.php?error=Password atau username salah");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Login</title>
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
        }
        .login-card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s ease-in-out;
        }
        .login-card h2 {
            text-align: center;
            color: #6a11cb;
            font-weight: bold;
        }
        .btn-primary {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            border: none;
            color: white;
        }
        .btn-primary:hover {
            background: linear-gradient(to left, #6a11cb, #2575fc);
        }
        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
        }
        .form-control:focus {
            border-color: #6a11cb;
            box-shadow: 0 0 5px rgba(106, 17, 203, 0.5);
        }
        .alert {
            font-size: 14px;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Selamat Datang</h2>
        <p class="text-center text-muted">Masuk untuk melanjutkan</p>
        <form method="post">
            <?php
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        $error
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                      </div>";
            }
            ?>
            <div class="mb-3">
                <label for="uname" class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" name="uname" class="form-control" placeholder="Masukkan username" required />
                </div>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" name="pass" class="form-control" placeholder="Masukkan password" required />
                </div>
            </div>
            <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" checked />
                <label class="form-check-label">Ingatkan Saya</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">
                <i class="fas fa-sign-in-alt"></i> Masuk
            </button>
        </form>
    </div>
    <script src="resources/js/bootstrap.min.js"></script>
</body>
</html>
