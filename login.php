<?php
    require_once "pdo.php";
    session_start();
     if ( isset($_POST["username"]) && isset($_POST["password"]) ) {
         unset($_SESSION["username"]);
         $sql = "SELECT password FROM userlogininfo WHERE username = :username";
         $stmt = $pdo->prepare($sql);
         $stmt->execute(array(
            ':username' => $_POST['username']
         ));
         $row = $stmt->fetch(PDO::FETCH_ASSOC);
         $password = $row['password'];
        if ( $_POST['password'] == $password ) {
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["success"] = "Logged in.";
            header( 'Location: courses.php' ) ;
            return;
        } else {
            $_SESSION["error"] = "Incorrect password.";
            header( 'Location: login.php' ) ;
            return;
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Student Login</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>
    <?php
        include("fragments/header.php");
    ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Please Login To Enter </h4>
                    
                </div>
            </div>
            <?php
                 if ( isset($_SESSION["error"]) ) {
                    echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
                    unset($_SESSION["error"]);
                }
            ?>
            <form name="admin" method="post">
            <div class="row">
                <div class="col-md-6">
                     <label>Enter Reg no : </label>
                        <input type="text" name="username" class="form-control"  />
                        <label>Enter Password :  </label>
                        <input type="password" name="password" class="form-control"  />
                        <h5>New user? <a href="register.php">Sign up!</a></h5>
                        <hr />
                        <button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-user"></span> &nbsp;Log Me In </button>&nbsp;
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>