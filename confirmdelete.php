<?php
    require_once("pdo.php");
    session_start();    
?>
<?php
    if(isset($_POST['courseCode']) && isset($_POST['username']) && isset($_POST['confirm'])){
        $sql = "DELETE FROM enrolledcourses WHERE courseCode = :courseCode and regNo = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':courseCode'=>$_POST['courseCode'],
            ':username'=>$_SESSION['username']
        ));
        header('Location:enrollhistory.php');
        return;
    }
    if(isset($_POST['courseCode']) && isset($_POST['username']) && isset($_POST['return'])){
        header('Location:enrollhistory.php');
        return;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Confirm Uenrollment</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php 
    include('fragments/header.php');
    include('fragments/navbar.php');
?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Confirm Uenrollment</h1>
                    </div>
                </div>
            <h4>Are you sure that you want to unenrol from the course <b><?= $_GET['courseCode'] ?> <?= $_GET['courseName'] ?> </b>?</h5>
            <hr>
        <form method="post">
            <input type="hidden" name="courseCode" value="<?= $_GET['courseCode'] ?>">
            <input type="hidden" name="username" value="<?= $_SESSION['username'] ?>">
            <div class="row container">
                <button type="submit" value="return" name="return" class="btn btn-info" style="width:80px;margin-right:10px">No</button>
                <button type="submit" value="confirm" name="confirm" class="btn btn-danger" style="width:80px">Yes</button>
            </div>
        </form>
        </div>
    </div>
</body>
</html>