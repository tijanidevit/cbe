<?php
require_once "../db/dbconfig.php";
require "dependencies/functions.php";

if (!isset($_SESSION['admin_logged'])) {
    header("Location:  index.php");
}
$admin_logged = $_SESSION['admin_logged'];
$adminQuery   = $conn->prepare("SELECT * FROM admin WHERE admin_id='" . $_SESSION['admin_logged'] . "'");
$adminQuery->execute();
if (($adminQuery->rowCount()) == 0) {
    echo "<h1>  <a href='logout.php'> Something went wrong, please login again</a> </h1>";
} else {
    $user = $adminQuery->fetch(PDO::FETCH_ASSOC);

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8" />
        <title>Configuration Settings  - <?php echo $config['school_name']; ?></title>
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
        <?php }?>
        <!-- App css -->
                <!-- Plugins css -->
        <link href="<?php echo ROOT; ?>assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="<?php echo ROOT; ?>assets/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo ROOT; ?>assets/libs/multiselect/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="<?php echo ROOT; ?>assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ROOT; ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
        <link href="<?php echo ROOT; ?>assets/libs/switchery/switchery.min.css" rel="stylesheet" />
        <link href="<?php echo ROOT; ?>assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
        <link href="<?php echo ROOT; ?>assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="<?php echo ROOT; ?>assets/libs/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet">
        <link href="<?php echo ROOT; ?>assets/libs/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <link href="<?php echo ROOT; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ROOT; ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ROOT; ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body>

        <!-- Navigation Bar-->
        <?php include "dependencies/header.php";?>
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
                            <h4 class="page-title">New Question</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div  class="col-md-2"></div>
                    <div class="col-xs-12 col-md-8">
                        <div class="card-box">
                            <?php if (isset($_SESSION['response'])) {
                                echo $_SESSION['response'];
                                unset($_SESSION['response']);
                            } ?>
                            <h4 class="header-title mt-0 mb-4">Software Configuration Settings</h4>
                            <form method="post" action="actions/update-system-settings.php">
                            <div class="row">


                            <div class="form-group col-12 col-xs-12 text-center">
                               <?php if (!file_exists("../setup/images/school-logo.png")) {
                               ?>
                            <span style=";"><img src="../setup/images/default-logo.png" alt="" height="45"></span>
                        <?php } else {?>
                            <span style=";"><img src="../setup/images/school-logo.png" alt="" height="45"></span>
                            <?php } ?>
                               
                            </div>
                            <div class="form-group col-12 col-xs-12">
                                <label class="label">School Name</label> <br/>
                                <input type="text" name="" value="<?php echo $config['school_name']; ?>" class="form-control" readonly='readonly' />
                               
                            </div>
                            <div class="form-group col-12 col-xs-12">
                                <label class="label">School Type</label> <br/>
                                <input type="text" name="" value="<?php echo ucwords($config['school_type']); ?>" class="form-control" readonly='readonly' />
                               
                            </div>
                            
                            <div class="form-group col-12 col-xs-12">
                                <label class="label">Studentship Mode</label> <br/>
                                <select class="form-control" name="studentship_mode[]" multiple>
                                    <option>Full Time</option>
                                    <option>Part Time</option>
                                    <option>Pre Degree</option>
                                    <option>Post Degree</option>
                                </select>
                            </div>
                            <div class="clearfix"></div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-theme-colored btn-md float-right" name="update-settings">Update</button>
                            </div>
                            </div>
                            </form>
                        </div>
                    </div><!-- end col -->
</div><!-- end row -->
            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

        <!-- Footer Start -->

        <?php include "dependencies/footer.php";?>

<!-- Vendor js -->
<script src="<?php echo ROOT; ?>assets/js/vendor.min.js"></script>

<!-- Plugins Js -->
        <script src="<?php echo ROOT; ?>assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
        <script src="<?php echo ROOT; ?>assets/libs/switchery/switchery.min.js"></script>
        <script src="<?php echo ROOT; ?>assets/libs/multiselect/jquery.multi-select.js"></script>
        <script src="<?php echo ROOT; ?>assets/libs/jquery-quicksearch/jquery.quicksearch.min.js"></script>

        <script src="<?php echo ROOT; ?>assets/libs/select2/select2.min.js"></script>
        <script src="<?php echo ROOT; ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="<?php echo ROOT; ?>assets/libs/jquery-mask-plugin/jquery.mask.min.js"></script>
        <script src="<?php echo ROOT; ?>assets/libs/moment/moment.js"></script>
        <script src="<?php echo ROOT; ?>assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
        <script src="<?php echo ROOT; ?>assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
        <script src="<?php echo ROOT; ?>assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="<?php echo ROOT; ?>assets/libs/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="<?php echo ROOT; ?>assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

        <!-- Init js-->
        <script src="<?php echo ROOT; ?>assets/js/pages/form-advanced.init.js"></script>
<!-- App js-->
<script src="<?php echo ROOT; ?>assets/js/app.min.js"></script>

<script src="<?php echo ROOT; ?>assets/js/custom.js"></script>
<script src="<?php echo ROOT; ?>assets/js/repeater.js"></script>

    </body>
</html>
<?php }?>