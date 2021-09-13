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
                            <h4 class="page-title">New Course</h4>
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
                            <h4 class="header-title mt-0 mb-4">New Course Registration</h4>
                            <!-- <p class="text-muted font-13">
                                Use a <code>
                                &lt;select multiple /&gt;</code>
                                as your input element for a tags input, to gain true multivalue support.
                            </p> -->
                            <form method="post" action="actions/submit-exam.php">
                            <div class="row">




                            <div class="form-group col-12 col-xs-12">
                                <label class="label">Session</label> <br/>
                               <input type="text" name="session" class="form-control" placeholder="Current session" required="required"/>
                            </div>

                                <div class="form-group col-12 col-xs-12">
                                    <label class="label">Department(s)</label> <br/>
                                    <?php $query = $conn->prepare("SELECT department_id,department_name FROM departments WHERE active='1'  ORDER BY department_name ASC");
                                        $query->execute();
                                        if ($query->rowCount() == 0) {?>
                                          <p class="alert alert-warning">You have not register any department</p>
                                      <?php } else {?>
                                    <select name="department_id[]" class="multi-select" multiple="" id="my_multi_select3" required="required" >
                                          <?php
                                            while ($sql_row = $query->fetch(PDO::FETCH_ASSOC)) {?>
                                            <option value="<?php echo $sql_row['department_id']; ?>"><?php echo $sql_row['department_name']; ?></option>
                                            <?php }?>
                                    </select>
                                <?php }?>
                            </div>
                            <div class="form-group col-12 col-xs-12">
                                <label class="label">Level</label> <br/>
                                <?php $query = $conn->prepare("SELECT level_id,level_name FROM levels WHERE active='1'  ORDER BY level_name ASC");
                                    $query->execute();
                                    if ($query->rowCount() == 0) {?>
                                          <p class="alert alert-warning">You have not register any level. Please contact our support centre.</p>
                                      <?php } else {?>
                                    <select name="level_id" class="form-control" required="required">
                                          <?php
                                            while ($sql_row = $query->fetch(PDO::FETCH_ASSOC)) {?>
                                            <option value="<?php echo $sql_row['level_id']; ?>"><?php echo $sql_row['level_name']; ?></option>
                                            <?php }?>
                                    </select>
                                <?php }?>
                            </div>
                            <div class="form-group col-12 col-xs-12">
                                <label class="label">Studentship Type</label> <br/>
                                <?php $query = $conn->prepare("SELECT studentship_mode FROM settings WHERE active='1'");
                                        $query->execute();
                                        if ($query->rowCount() == 0) {?>
                                          <p class="alert alert-warning">It appears that the software was not properly configured. Please contact our support centre.</p>
                                      <?php } else {
                                        $sql_row = $query->fetch(PDO::FETCH_ASSOC);
                                        $mode    = explode(';', $sql_row['studentship_mode']);
                                        ?>
                                    <select name="studentship_type[]" class="form-control" multiple required="required">
                                          <?php
                                        for ($i = 0; $i < count($mode); $i++) {?>
                                            <option value="<?php echo $mode[$i]; ?>"><?php echo $mode[$i]; ?></option>
                                            <?php }?>
                                    </select>
                                     <?php }?>
                            </div>


                            <div class="form-group col-12 col-xs-12">
                                <label class="label">Course</label> <br/>
                                <?php $query = $conn->prepare("SELECT course_id,course_name FROM course WHERE active='1'  ORDER BY course_name ASC");
                                    $query->execute();
                                    if ($query->rowCount() == 0) {?>
                                          <p class="alert alert-warning">You have not register any course.</p>
                                      <?php } else {?>
                                    <select name="course_id" class="form-control" required="required">
                                          <?php
                                    while ($sql_row = $query->fetch(PDO::FETCH_ASSOC)) {?>
                                            <option value="<?php echo $sql_row['course_id']; ?>"><?php echo $sql_row['course_name']; ?></option>
                                            <?php }?>
                                    </select>
                                <?php }?>
                            </div>


                            <div class="form-group col-12 col-xs-12">
                                <label class="label">Total Questions <small class="text-info">(Number of questions per exam.)</small></label> <br/>
                               <input type="number" name="total_questions" class="form-control" placeholder="" required="required" />
                            </div>


                            <div class="form-group col-12 col-xs-12">
                                <label class="label">Exam Duration </label> <br/>
                                <input id="timepicker2" type="text" name="duration" class="form-control" required="required"/>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn bg-theme-colored btn-md float-right" name="submit-exam">Submit</button>
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
    </body>
</html>
<?php }?>