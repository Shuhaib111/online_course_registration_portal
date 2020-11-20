<?php
    require_once("pdo.php");
    session_start();
?>
<?php
    if(isset($_POST['courseCode']) && isset($_POST['submit'])){
        $sql = "INSERT INTO enrolledcourses(courseCode, regNo) VALUES (:courseCode, :regNo)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':courseCode' => $_POST['courseCode'],
            ':regNo' => $_SESSION['username']
        ));
        header('Location: courseinfo.php?courseCode='.$_POST['courseCode']);
        return;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Course Info</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />   
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        
        <link href="assets/css/style.css" rel="stylesheet" />
    
    </head>
    <body>
    <?php   
        include("fragments/header.php");
        include("fragments/navbar.php");
    ?>
    <?php   
        $sql = "SELECT * FROM courseinfo WHERE courseCode = :courseCode";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':courseCode'=> $_GET['courseCode'],
        ));
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {?>
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                        <div class="col-md-12">
                            <h1 class="page-head-line">
                            <?php                                      
                                echo($row['courseCode']);
                                echo("<br><br>");
                                echo($row['courseName']);
                            ?></h1>
                        </div>
                </div>
                <h4 style="color:red;">CREDIT <span style="color:red"><?= $row['credit'] ?></span></h6>
                <br>
                <h4 style="color:red">OBJECTIVE</h2>
                
                <p><?= $row['objectives'] ?></p>
                <br>
                <h4 style="color:red">FACULTY <span><b><?= $row['faculty'] ?></b></span></h4>
                <hr />
                <?php
                    $sql_ = "SELECT * FROM enrolledcourses WHERE courseCode = :courseCode and regNo = :username";
                    $stmt_ = $pdo->prepare($sql_);
                    $stmt_->execute(array(
                        ':courseCode' =>$_GET['courseCode'],
                        ':username'=>$_SESSION['username']
                    ));
                    $row_ = $stmt_->fetch(PDO::FETCH_ASSOC);
                    
                    if($row_==false) {
                
                    echo('<form method="post">');
                    echo('<input type="hidden" name="courseCode" value = "'.$row['courseCode'].'"/>');
                    echo('<button type="submit" value="Enroll" name="submit" class="btn btn-info" style="width:150px">Enroll</button>');
                    echo('</form>');
                    } else{
                        echo('<button type="button" class="btn btn-info" style="width:150px" disabled>Enrolled</button>');
                    }?>
            </div>
        </div>
        <?php } ?>
    </body>
</html>