<?php
include 'app/db.php';
$id;
$job;
$title;
if ($_GET['job'] == 'add') {
    $job = 'add';
    $title = "اضافه کردن تسک جدید";
} elseif ($_GET['job'] == 'edit') {
    $id = $_GET['id'];
    $job = 'edit';
    $title = "ویرایش";
    $object = new db();
    $object->setTbl("tasks");
    $results = $object->showEditData($id);
} elseif ($_GET['job'] == 'delete') {
    $id = $_GET['id'];
    $object = new db();
    $object->setTbl("tasks");
    $object->deleteData($id);
    header("location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css/styleJob.css">
    
</head>

<body>
    <?php
    if ($job == 'edit') :
    ?>
        <form action="" method="post">
            <div id="header">
                <label for="taskTitle">عنوان تسک : </label>
                <input id="taskTitle" name="title" maxlength="20" type="text" placeholder="عنوان تسک را وارد کنید ...." value="<?php echo $results['title']; ?>">
            </div>
            <hr>
            <div id="text">
                <label for="taskText" id="taskTextLabel">توضیحات تسک : </label>
                <textarea id="taskText" name="text" cols="30" rows="10"><?php echo $results['text']; ?></textarea>
            </div>
            <div id="buttons">
                <button type="submit"  href="#" id="add" name="edit">ویرایش</button>
            </div>
            </div>
        </form>
    <?php
    endif;
    if ($job == 'add') :
    ?>
        <form action="" method="post">
            <div id="header">
                <label for="taskTitle">عنوان تسک : </label>
                <input id="taskTitle" name="title" maxlength="20" type="text" placeholder="عنوان تسک را وارد کنید ....">
            </div>
            <hr>
            <div id="text">
                <label for="taskText" id="taskTextLabel">توضیحات تسک : </label>
                <textarea name="task" id="taskText" name="text" cols="30" rows="10">توضیحات تسک را وارد کنید ....</textarea>
            </div>
            <div id="buttons">
                <button type="submit" href="#" id="add" name="add">افزودن</button>
            </div>
            </div>
        </form>
    <?php endif; ?>
    <div id="backHome">
        <a href="index.php">برگشت</a>
    </div>

    <div id="abl">
        <div id="success">
            <p id="pSuccess"></p>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
<?php 


if (isset($_POST['add'])) {
    if (empty($_POST['title'] || $_POST['text'])) {
        echo "<script>alert('لطفا عنوان و توضیحات را کامل کنید')</script>";
    } else {
        $object = new db();
        $filds = ['title', 'text'];
        $values = [$_POST['title'], $_POST['task']];
        $object->setTbl("tasks");
        $object->insertData($filds, $values);
        echo "<script type='text/javascript'>cheackSuccessDiv(true)</script>" ;
    }
}
if (isset($_POST['edit'])) {
    if (empty($_POST['title']) || empty($_POST['text'])) {
        echo "<script>alert('لطفا عنوان و توضیحات را کامل کنید')</script>";
    } else {
        $filds = ['title', 'text'];
        $data = ['title' => $_POST['title'], 'text' => $_POST['text']];
        $object->editData($filds, $data, $id);
        echo "<script type='text/javascript'>cheackSuccessDiv(true)</script>" ;
    }
}

?>