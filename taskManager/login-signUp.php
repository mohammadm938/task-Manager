<?php
include "app/user.php";
$method = $_GET['method'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام</title>
    <link rel="stylesheet" href="css/form.css">
    <script src="js/form.js"></script>
</head>

<body>
    <?php if ($method == 'signUp') : ?>
        <div id="content" class="signUp">
            <h2>ثبت نام</h2>
            <form action="" method="POST" id="form" autocomplete="off">
                <img src="img/user.png" alt="ایکون یوزرنبم | user icon">
                <input type="text" name="name" id="name" placeholder="نام کاربری">
                <br>
                <img src="img/email.png" alt="ایکون ایمیل | email icon">
                <input type="email" name="email" id="email" placeholder="ایمیل">
                <br>
                <img src="img/mobile.png" alt="ایکون موبایل | mobile icon">
                <input maxlength="10" onchange="validatePhoneNumber('phone')" type="phone" name="phone" id="phone" placeholder="شماره تلفن بدون 0">
                <br>
                <img src="img/pass.png" alt="ایکون پسورد | password icon">
                <input type="password" name="password" id="password" placeholder="پسورد">

                <input type="submit" name="signUp" id="btn" value="ثبت نام">
            </form>
            <p>حساب کاربری موجود دارید ؟ <a href="login-signUp.php?method=login">کلیک کنید</a></p>
        </div>
    <?php endif; ?>
    <?php if ($method == 'login') : ?>
        <div id="content" class="login">
            <h2>ورود به حساب کاربری</h2>
            <form action="" method="POST" id="form" autocomplete="off">
                <img src="img/user.png" alt="ایکون یوزرنبم | user icon">
                <input type="text" name="name" id="name" placeholder="نام کاربری">
                <br>
                <img src="img/pass.png" alt="ایکون پسورد | password icon">
                <input type="password" name="password" id="password" placeholder="پسورد">
                <input type="submit" name="login" id="btn" value="ورود">
            </form>
            <p>حساب کاربری موجود ندارید ؟ <a href="login-signUp.php?method=signUp">کلیک کنید</a></p>
            <p>اطلاعات حساب خود را فراموش کرده اید ؟ <a href="login-signUp.php?method=recovery">کلیک کنید</a></p>
        </div>
    <?php endif; ?>
    <?php if ($method == 'recovery') : ?>
        <div id="content" class="recovery">
            <h2>بازگرداندن حساب</h2>
            <form action="" method="POST" id="form" autocomplete="off">
                <img src="img/email.png" alt="ایکون ایمیل | email icon">

                <input type="email" name="email" id="email" placeholder="ایمیل">

                <input type="submit" name="recovery" id="btn" value="دریافت اطلاعات">
            </form>
            <p>اطلاعت به ایمیل شما ارسال میشود</p>
            <a href="login-signUp.php?method=login">برگشت به صفحه ورود</a>
        </div>
    <?php endif; ?>
    <div id="backHome">
        <a href="index.php">برگشت</a>
    </div>
</body>

</html>
<?php

$object = new user();

if (isset($_POST['login']) && (!empty($_POST['name'])) && (!empty($_POST['password']))) {
    $name = $_POST['name'];
    $password = $_POST['password'];

    $data = ['name' => $name, 'password' => $password];
    $object->login($data);
}
?>
<?php
if (isset($_POST['signUp']) && (!empty($_POST['name'])) && (!empty($_POST['email'])) && (!empty($_POST['password'])) && (!empty($_POST['phone']))) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    
    $data = ['name' => $name, 'email' => $email, 'phone' => $phone, 'password' => $password];
    $object->signUp($data);
} ?>