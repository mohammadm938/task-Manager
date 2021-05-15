<?php
session_start();
include "app/user.php";
$is_Login;
if (isset($_SESSION['id'])) {
    $object = new user();
    $object->setTbl("user");
    $res = $object->searchData('name', $_SESSION['name']);
    $object->setTbl("tasks");
    $result = $object->searchDatas('owner', $res->id);
    $is_Login=true;
}else{
    $is_Login=false;
}
if (isset($_GET['logout'])) {
    if (isset($_SESSION['name'])) {
        $object->logout();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/typed.js-master/lib/typed.js" type="text/javascript"></script>
    <script src="js/typed.js-master/assets/demos.js"></script>

</head>

<body>

<!-- <div class="type-wrap divText">
    <div id="typed-strings" class="divText">
      <p class="textBetweenHrs">لطفا برای استفاده ثبت نام کنید یا وارد شوید.</p>
    </div>
    <span id="typed" class="textBetweenHrs" style="white-space:pre;"></span>
  </div> -->
<?php if(!$is_Login): ?>
<div class="type-wrap divText">
    <span id="typed2" class="textBetweenHrs" style="white-space:pre;"></span>
  </div>
  <script type="text/javascript">
  var typed2 = new Typed('#typed2', {
    strings: ['لطفا برای استفاده ثبت نام کنید یا وارد شوید.'],
    typeSpeed: 40,
    backSpeed: 300,
    fadeOut: true,
    loop: true
  });
</script>
<?php endif; ?>
<?php if (isset($_SESSION['id'])) : ?>
        <div id="add">
            <a href="taskJob.php?job=add">اضافه کردن برنامه جدید</a>
        </div>
        <div id="profile">
            <p><b><?php echo $_SESSION['name']; ?></b>خوش آمدید</p>
        </div>
    <?php endif; ?>
    <div id="right" class="profileButtons">
        <a href="login-signUp.php?method=login" id="login">ورود</a>
    </div>
    <div id="left" class="profileButtons">
        <a href="login-signUp.php?method=signUp" id="singUp">ثبت نام</a>
    </div>
    <?php
    if (isset($_SESSION['id'])) :
        foreach ($result as $value) : ?>
            <div id="content">
                <div id="header">
                    <h2><?php echo $value->title; ?></h2>
                </div>
                <div id="border"></div>
                <div id="tasks">
                    <?php echo $value->text; ?>
                </div>
                <div id="buttons">
                    <a href="taskJob.php?id=<?php echo $value->id; ?>&&job=edit" id="edit">ویرایش</a>
                    <a href="taskJob.php?id=<?php echo $value->id; ?>&&job=delete" id="delete">حذف</a>
                </div>
            </div>
    <?php 
    endforeach;
    endif;
    ?>
<script src="js/index.js"></script>
<?php
if (isset($_SESSION['name'])) {
    echo "<script>deleteLoginAndSignUpWay()</script>";
}
if (!isset($_SESSION['id'])) {
    echo "<script>justShowButtonsForNullUsers()</script>";
}
?>
</body>

</html>