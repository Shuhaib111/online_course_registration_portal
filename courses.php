<?php 
session_start();
require_once "pdo.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />   
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href = "assets/css/card.css" rel = "stylesheet" />
    
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> -->
    <title>Registration</title>
</head>

<body>
<?php
        include("fragments/header.php");
        include("fragments/navbar.php");
    ?>
  <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Available Courses</h1>
                    </div>
                </div>
            <?php
                $sql = "SELECT department, semester FROM studentinfo where regNo = :regNo";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':regNo' => $_SESSION['username']
                ));
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $semester = $row['semester'];
                $department = $row['department'];
                $sql = "SELECT courseCode, courseName FROM courses WHERE department = :department and semester = :semester";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':department' => $department,
                    ':semester' => $semester,
                ));?>
                <div class="row">
                <?php
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                    

                        <div class="col-sm-6">
                            <div class="card bg-light mb-3" style="">
                            <div class="card-header">COURSE</div>
                            <div class="card-body">
                                <h5 class="card-title"><?= $row['courseCode'] ?></h5>
                                <p class="card-text"><?= $row['courseName'] ?></p>
                                <a href="courseinfo.php?courseCode=<?= $row['courseCode'] ?>" class="btn btn-primary">View More</a>
                            </div>
                            </div>
                        </div>
                       
    
                        

                <?php } ?>
                </div>
        </div>
    </div>
</body>
</html>


<!-- <html>
<head></head>
<body>
<?php
    // if ( isset($_SESSION["success"]) ) {
    //     echo('<p style="color:green">'.$_SESSION["success"]."</p>\n");
    //     unset($_SESSION["successs"]);
    // }
?>
<h1>Welcome<?= $_SESSION["username"] ?></h1>
</body>
</html> -->