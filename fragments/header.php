<?php
require_once("pdo.php");
?>
<?php if($_SESSION['username']!="")
{
    $sql = "SELECT studentName FROM studentinfo WHERE regNo =  :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':username' => $_SESSION['username']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $name = $row['studentName'];
    ?>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <strong>Welcome: </strong><?php echo htmlentities($name);?>
                    &nbsp;&nbsp;
                </div>

            </div>
        </div>
    </header>
    <?php } ?>
    <!-- HEADER END-->
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button> -->
                <a class="navbar-brand" href="courses.php" style="color:#fff; font-size:24px;4px; line-height:24px; ">

                   Online Course Registration
                </a>

            </div>

            <div class="left-div">
                <i class="fa fa-book login-icon" ></i>
        </div>
            </div>
        </div>
