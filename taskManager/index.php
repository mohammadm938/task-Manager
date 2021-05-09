<?php 
    include "app/db.php";
    $object = new db();
    $object->setTbl("tasks");
    $result=$object->selectData('*');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="add">
        <a href="taskJob.php?job=add">اضافه کردن تسک جدید</a>
    </div>
    <?php foreach ($result as $value):?>
    <div id="content">
        <div id="header">
            <h2><?php echo $value->title; ?></h2>
        </div>
        <div id="border"></div>
        <div id="tasks">
        <?php echo $value->text;?>
        </div>
        <div id="buttons">
            <a href="taskJob.php?id=<?php echo $value->id;?>&&job=edit" id="edit">ویرایش</a>
            <a href="taskJob.php?id=<?php echo $value->id;?>&&job=delete" id="delete">حذف</a>
        </div>
    </div>
    <?php endforeach; ?>
</body>
</html>