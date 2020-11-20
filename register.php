<?php 
session_start();
require_once "pdo.php";
?>
<?php
 if (isset($_POST['studentname']) && isset($_POST['studentname']) && isset($_POST['studentregno']) && isset($_POST['password'])
        && isset($_POST['department']) && isset($_POST['semester'])){
            $sql = "INSERT INTO studentinfo(studentName, regNo, department, semester) VALUES (:studentName, :regNo, :department, :semester)";
            $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':studentName' => $_POST['studentname'],
            ':regNo' => $_POST['studentregno'],
            ':department' => (int)$_POST['department'],  
            ':semester' => (int)$_POST['semester']));

        $sql = "INSERT INTO userlogininfo(username, password) VALUES(:username, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':username' => $_POST['studentregno'],
            ':password' => $_POST['password']
        ));
        header('Location: login.php');
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
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <title>Registration</title>
</head>

<body>
<?php
        include("fragments/header.php");
    ?>
  <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Registration</h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                          Registration
                        </div>


    <div class="panel-body">
        <form name="dept" method="post">
        <div class="form-group">
        <label for="studentname">Student Name  </label>
            <input type="text" class="form-control" id="studentname" name="studentname"  />
        </div>

        <div class="form-group">
            <label for="studentregno">Student Reg No   </label>
            <input type="text" class="form-control" id="studentregno" name="studentregno" placeholder="Student Reg no"  />
            
        </div>

        <div class="form-group">
            <label for="password">Password  </label>
            <input type="password" class="form-control" id="password" name="password" placeholder="password"  />
            
        </div>



<div class="form-group">
    <label for="Department">Department  </label>
    <select class="form-control" name="department" required="required">
   <option value="">Select Depertment</option>   
   <?php 
$sql="select * from departments";
$stmt = $pdo->query($sql);
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
?>
<option value="<?php echo htmlentities($row['deptNum']);?>"><?php echo htmlentities($row['deptName']);?></option>
<?php } ?>

    </select> 
  </div> 
 

<div class="form-group">
    <label for="Semester">Semester  </label>
    <select class="form-control" name="semester" required="required">
   <option value="">Select Semester</option>   
   <?php 
$sql="select * from semester";
$stmt = $pdo->query($sql);
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
?>
<option value="<?php echo htmlentities($row['semesterNum']);?>"><?php echo htmlentities($row['semesterNum']);?></option>
<?php } ?>

    </select> 
  </div>



 <button type="submit" name="submit" id="submit" class="btn btn-primary">Enroll</button>
</form>
</div>
</div>
</div>
                  
</div>
</div>
</div>
<script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>