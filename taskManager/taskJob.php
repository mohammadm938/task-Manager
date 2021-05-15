<?php
session_start();
include 'app/user.php';
$id;
$job;
$title;

// choose job
if ($_GET['job'] == 'add') {
    $job = 'add';
    $title = "اضافه کردن برنامه جدید";
} elseif ($_GET['job'] == 'edit') {
    $id = $_GET['id'];
    $job = 'edit';
    $title = "ویرایش";
    $object = new user();
    $object->setTbl("tasks");
    $results = $object->showEditData($id);
} elseif ($_GET['job'] == 'delete') {
    //delete choose and work do here
    $id = $_GET['id'];
    $object = new user();
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
                <label for="taskTitle">عنوان برنامه : </label>
                <input id="taskTitle" name="title" maxlength="20" type="text" placeholder="عنوان برنامه را وارد کنید ...." value="<?php echo $results['title']; ?>">
            </div>
            <hr>
            <div id="text">
                <label for="taskText" id="taskTextLabel">توضیحات برنامه : </label>
                <br>
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
                <label for="taskTitle">عنوان برنامه : </label>
                <br>
                <input id="taskTitle" name="title" maxlength="20" type="text" placeholder="عنوان برنامه را وارد کنید ....">
            </div>
            <hr>
            <div id="text">
                <label for="taskText" id="taskTextLabel">توضیحات برنامه : </label>
                <br>
                <textarea name="task" id="taskText" name="text" cols="30" rows="10">توضیحات برنامه را وارد کنید ....</textarea>
            </div>
            <hr>
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

// if select add job this code will add task
if (isset($_POST['add'])) {
    if (empty($_POST['title'] || $_POST['text'])) {
        echo "<script>alert('لطفا عنوان و توضیحات را کامل کنید')</script>";
    } else {
        $object = new user();
        $filds = ['title', 'text' , 'owner'];
        $values = [$object->returnSafeText($_POST['title']), $object->returnSafeText($_POST['task']),$_SESSION['id']];
        $object->setTbl("tasks");
        $object->insertData($filds, $values);
        echo "<script type='text/javascript'>cheackSuccessDiv(true)</script>" ;
    }
}
// if select edit job this code will edit task
if (isset($_POST['edit'])) {
    if (empty($_POST['title']) || empty($_POST['text'])) {
        echo "<script>alert('لطفا عنوان و توضیحات را کامل کنید')</script>";
    } else {
        $filds = ['title', 'text'];
        $data = [$object->returnSafeText($_POST['title']), $object->returnSafeText($_POST['task'])];
        $object->editData($filds, $data, $id);
        echo "<script type='text/javascript'>cheackSuccessDiv(true)</script>" ;
    }
}

?>