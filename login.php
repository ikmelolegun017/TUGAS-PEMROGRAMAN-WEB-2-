<?php
session_start();
include 'koneksi.php'; // atau sesuaikan lokasi file koneksi

if (isset($_POST['signin'])) {
    $email = $_POST['login_email'] ?? null;
    $password = $_POST['login_password'] ?? null;

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $user['name'];
        header("Location: index.php"); // arahkan ke dashboard
        exit;
    } else {
        echo "<script>alert('Email atau password salah!');</script>";
    }
}
// Tambahkan ini untuk Sign Up
if (isset($_POST['signup'])) {
    $name = $_POST['signup_name'];
    $email = $_POST['signup_email'];
    $password = password_hash($_POST['signup_password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);
    if ($stmt->execute()) {
        echo "<script>alert('Akun berhasil dibuat! Silakan login.');</script>";
    } else {
        echo "<script>alert('Gagal membuat akun.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modern Login Page | ikmal</title>
  
  <!-- Corrected Font Awesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  
  <link rel="stylesheet" href="style.css">

  <style>

@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
}

body{
    background-color: #c9d6ff;
    background: linear-gradient(to right, #e2e2e2,#c9d6ff);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    height: 100vh;
}

.container{
    background-color: #fff;
    border-radius: 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
    position: relative;
    overflow: hidden;
    width: 768px;
    max-width: 100%;
    min-height: 480px;
}

.container p{
    font-size: 14px;
    line-height: 20px;
    letter-spacing: 0.3px;
    margin: 20px 0;
}

.container span{
    font-size: 12px;
}

.container a{
    color: #333;
    font-size: 13px;
    text-decoration: none;
    margin: 15px 0 10px;
}

.container button{
    background-color: #512da8;
    color: #fff;
    font-size: 12px;
    padding: 10px 45px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-top: 10px;
    cursor: pointer;
}

.container button.hidden{
    background-color: transparent;
    border-color: #fff;
}

.container form{
    background-color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 40px;
    height: 100%;
}

.container input{
    background-color: #eee;
    border: none;
    margin: 8px 0;
    padding: 10px 15px;
    font-size: 13px;
    border-radius: 8px;
    width: 100%;
    outline: none;
}

.form-container{
    position: absolute;
    top: 0;
    height: 100%;
    transition: all 0.6s ease-in-out;
}

.sign-in{
    left: 0;
    width: 50%;
    z-index: 2;
}

.container.active .sign-in{
    transform: translateX(100%);
}

.sign-up{
    left: 0;
    width: 50%;
    opacity: 0;
    z-index: 1;
}

.container.active .sign-up{
    transform: translateX(100%);
    opacity: 1;
    z-index: 5;
    animation: move 0.6s;
}

@keyframes move{
    0%, 49.99%{
        opacity: 0;
        z-index: 1;
    }
    50%, 100%{
        opacity: 1;
        z-index: 5;
    }
}

.social-icons{
    margin: 20px 0;
    display: flex;
    justify-content: center;
    gap: 12px;
}

.social-icons a{
    border: 1px solid #ccc;
    border-radius: 20%;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    margin: 0 3px;
    width: 40px;
    height: 40px;
}

.toggle-container{
    position: absolute;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    transition: all 0.6s ease-in-out;
    border-radius: 150px 0 0 100px;
    z-index: 1000;
}

.container.active .toggle-container{
    transform: translateX(-100%);
    border-radius: 0 150px 100px 0;
}

.toggle{
    background-color: #512da8;
    height: 100%;
    background: linear-gradient(to right, #5c6bc0, #512da8);
    color: #fff;
    position: relative;
    left: -100%;
    height: 100%;
    width: 200%;
    transform: translateX(0);
    transition: all 0.6ss ease-in-out;
}

.container.active .toggle{
    transform: translateX(50%);
}

.toggle-panel{
    position: absolute;
    width: 50%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 30px;
    text-align: center;
    top: 0;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}


.toggle-left{
    transform: translateX(-200%);
}

.container.active .toggle-left{
    transform: translateX(0);
}

.toggle-right{
    right: 0;
    transform: translateX(0);
}

.container.active .toggle-right{
    transform: translateX(200%);
}
.icon {
  width: 45px;
  height: 45px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 12px;
  color: white;
  font-size: 18px;
  text-decoration: none;
  transition: transform 0.3s ease, opacity 0.3s ease;
}

.icon:hover {
  transform: scale(1.1);
  opacity: 0.9;
}

/* Warna spesifik platform */
.fa-google-plus-g { color: #db4437;}
.fa-facebook-f { color: #1877f2;}
.fa-github { color: #333333;}
.fa-linkedin-in { color: #0077b5;}


  
  </style>
  
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="post" action="">
    <h1>Create Account</h1>
    <div class="social-icons">
        <a href="https://accounts.google.com" class="icon google" target="_blank"><i class="fa-brands fa-google-plus-g"></i></a>
        <a href="https://facebook.com/namamu" class="icon facebook" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="https://github.com/namamu" class="icon github" target="_blank"><i class="fa-brands fa-github"></i></a>
        <a href="https://linkedin.com/in/namamu" class="icon linkedin" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>

        

    </div>
    <span>or use your email for registration</span>
    <input type="text" name="signup_name" placeholder="Name" required>
    <input type="email" name="signup_email" placeholder="Email" required>
    <input type="password" name="signup_password" placeholder="Password" required>
    <button type="submit" name="signup">Sign Up</button>
</form>

        </div>
        <div class="form-container sign-in">
            <form method="post" action="">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="https://accounts.google.com" class="icon" target="_blank"><i class="fa-brands fa-google-plus-g"></i></a>
        <a href="https://facebook.com/namamu" class="icon" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="https://github.com/namamu" class="icon" target="_blank"><i class="fa-brands fa-github"></i></a>
        <a href="https://linkedin.com/in/namamu" class="icon" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email password</span>
                <input type="email" name="login_email" placeholder="Email" required>
                <input type="password" name="login_password" placeholder="Password" required>
                <a href="#">Forgot Your Password?</a> 
                <button type="submit" name="signin">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel
                toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details
                    to use all of site features</p>
                    <button class="hidden"
                    id="Login">Sign In</button>
                </div>
                <div class="toggle-panel
                toggle-right">
                    <h1>Hello, Friends!</h1>
                    <p>Register with your personal details
                    to use all of site features</p>
                    <button class="hidden"
                    id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

  <script src="js/script.js"></script>
</body>
</html>
