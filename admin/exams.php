<?php
require_once "../db/dbconfig.php";
require "dependencies/functions.php";

if(!isset($_SESSION['admin_logged'])) { 
 header("Location:  index.php"); 
}
$admin_logged = $_SESSION['admin_logged'];
$adminQuery = $conn->prepare("SELECT * FROM admin WHERE admin_id='".$_SESSION['admin_logged']."'");
$adminQuery->execute();
if (($adminQuery->rowCount()) == 0) {
  echo "<h1>  <a href='logout.php'> Something went wrong, please login again</a> </h1>";
}else{
  $user = $adminQuery->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8" />
        <title>Exams  - <?php echo $config['school_name']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <?php if (!file_exists("../setup/images/school-favicon.png")) {
           ?>
             <link rel="shortcut icon" href="../setup/images/default-favicon.png">
        <?php } else {?>
            <link rel="shortcut icon" href="../setup/images/school-favicon.png">
        <?php } ?>
        <!-- App css -->
        <link href="<?php echo ROOT; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ROOT; ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ROOT; ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body>

        <!-- Navigation Bar-->
        <?php include "dependencies/header.php"; ?>
        <!-- End Navigation Bar-->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="wrapper">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                    <li class="breadcrumb-item active">Tests</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Tests</h4>
                        </div>
                    </div>
                </div>     
                <!-- end page title --> 

 <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="row justify-content-center">
                                <div class="col-sm-6">
                                    <div class="text-center">
                                        <h3>Examinations</h3>
                                        <p class="text-muted"> Nisi praesentium similique totam odio obcaecati, reprehenderit,
                                            dignissimos rem temporibus ea inventore alias! Beatae animi nemo ea
                                            tempora, temporibus laborum facilis ut!</p>

                                        <?php if (isset($ongoing_exam)) {?>
                                        <div class="ongoing-exam-button">
                                        <button type="button" class="btn btn-primary waves-effect waves-light mt-1" id="end-ongoing-test" pin='<?php echo decrypt($user["access_pin"]); ?>'>End Ongoing All Tests</button>
                                        </div>
                                    <?php } ?>

                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->

                             <div class="row mt-4 ">

                    <div class="col-sm-6">
                         <a href="question-bank.php">
                            <div class="card-box bg-warning has-flex p-70">
                                <h1 class="text-white text-uppercase text-center">Question Bank</h1>
                            </div>
                        </a>
                    </div><!-- end col -->

                    <div class="col-sm-6">
                         <a href="results.php">
                            <div class="card-box bg-theme-colored has-flex p-70">
                                <h1 class="text-white text-uppercase text-center">Results</h1>
                            </div>
                        </a>
                    </div><!-- end col -->

</div>
                            


                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->
            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

        <!-- Footer Start -->

        <?php include "dependencies/footer.php"; ?>

<!-- Vendor js -->
<script src="<?php echo ROOT; ?>assets/js/vendor.min.js"></script>

<!-- App js-->
<script src="<?php echo ROOT; ?>assets/js/app.min.js"></script>

<script src="<?php echo ROOT; ?>assets/js/custom.js"></script>
    </body>
</html>
<?php } ?>