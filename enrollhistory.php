<?php
    require_once("pdo.php");
    session_start();    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Enroll History</title>
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
                        <h1 class="page-head-line">Enroll History  </h1>
                    </div>
                </div>
                <div class="row" >
            
                <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Enroll History
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Course Code </th>
                                            <th>Course Name </th>
                                            <th> Faculty</th>
                                             <th>Credits</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
    $sql = "SELECT courseinfo.courseCode, courseinfo.courseName, courseinfo.faculty, courseinfo.credit FROM courseinfo,enrolledcourses
            WHERE courseinfo.courseCode = enrolledcourses.courseCode and enrolledcourses.regNo = :regNo ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
    ':regNo'=>$_SESSION['username']
    ));
    $cnt = 1;
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
?>


    <tr>
        <td><?php echo $cnt;?></td>
        <td><?php echo htmlentities($row['courseCode']);?></td>
        <td><?php echo htmlentities($row['courseName']);?></td>
        <td><?php echo htmlentities($row['faculty']);?></td>
        <td><?php echo htmlentities($row['credit']);?></td>
        <td>
        <a href="confirmdelete.php?courseCode=<?= $row['courseCode'] ?>  & courseName=<?= $row['courseName']?>">
        <button class="btn btn-danger"><i class="fa fa-remove "></i> &nbsp;Unenroll</button> </a>                                      
        </td>
    </tr>
<?php 
$cnt++;
} ?>

                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
