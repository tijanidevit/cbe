<?php 
require_once "dependencies/functions.php";
if (!isset($_SESSION['student_logged'])) {
    header("Location: logout.php");
    exit();
}else{  
$query = $conn->prepare("SELECT profile_picture,matric_number,fullname,department_id,level_id FROM student WHERE matric_number='".$_SESSION['student_logged']."' ");
$query->execute();

if ($query->rowCount() == 0) {
    echo displayError("<h3 class='text-center'>Something went wrong. Please contact an invigilator.</h3>");
}else{
    $student = $query->fetch(PDO::FETCH_ASSOC);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>Exams Pane</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Custom box css -->
        <link href="assets/libs/custombox/custombox.min.css" rel="stylesheet">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body>
<div id="submit-overlay">
    <h1 class="text-center text-white"><i class="fa fa-spin fa-spinner"></i> <i>Submiting, please wait.</i></h1>
</div>
<div id="seek-attention">
    <h1 class="text-center alert alert-danger"><i class="fa fa-error"></i> <i>A critical error has occured. Kindly call the attention of an invigilator.</i></h1>
</div>
        <!-- Navigation Bar-->
        <header id="topnav">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-right mb-0 text-center">

                        <li class="dropdown notification-list">
                         <div class="examination-pane hide" >
                         <br>
                            <a><h4>Time Left: <span id="timer"><span id="hr">00</span>:<span id="mm">00</span>:<span id="ss">00</span></span></h4></a>
                            </div>
                        </li>
                        <li class="dropdown notification-list">
                            <a class="nav-link nav-user mr-0 waves-effect">
                                <!-- <i class="fa fa-user"></i> -->
                                <img src="./uploads/<?php echo $student['profile_picture']; ?>" alt="<?php echo $student['fullname']; ?>" style="width:35px; height: auto;">
                                <span class="pro-user-name ml-1">
                                   <?php echo $student['fullname'] ?>
                                </span>
                            </a>
                        </li>
    
                        <li class="dropdown notification-list">
                            <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect">
                                <i class="fe-settings noti-icon"></i>
                            </a>
                        </li>
    
                    </ul>
    
                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="home.php" class="logo text-center">
                            <span class="logo-lg">
                                <img src="assets/images/logo.png" alt="" height="50">
                                <!-- <span class="logo-lg-text-light">UBold</span> -->
                            </span>
                            <span class="logo-sm">
                                <!-- <span class="logo-sm-text-dark">U</span> -->
                                <img src="assets/images/logo.png" alt="" height="24">
                            </span>
                        </a>
                    </div>
    
                </div> <!-- end container-fluid-->
            </div>
            <!-- end Topbar -->

           
            <!-- end navbar-custom -->

        </header>
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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Adminto</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Dashboard</h4>
                        </div>
                    </div>
                </div>     
                <!-- end page title --> 


                <div class="row instruction-pane">




                    <div class="col-12 col-sm-12 col-md-4 col-xl-4">
                        <div class="card-box">
                            <div class="text-center" style="color: #000 !important;">
                                <img src="./uploads/<?php echo $student['profile_picture']; ?>" alt="<?php echo $student['fullname']; ?>" style="width:70px; height: auto;margin: auto;border-radius: 10px;">
                                <h4 class="text-center"><?php echo $student['fullname']; ?></h4>
                                <hr/>
                                <h4 class="text-left">Course: <span id="course-name"></span></h4>
                                <hr/>
                                <h4 class="text-left">Total Questions: <span id="total-questions"></span></h4>
                                <hr/>
                                <h4 class="text-left">Exam Duration: <span id="exam-duration"></span></h4>

                                <div class="mt-4">
                            <hr/>

                                    <button type="button" class="btn btn-primary btn-lg waves-effect width-md waves-light"  id="start-exam"> START EXAM</button>
                                    <div class="clearfix"></div>
                                
                            </div>
                            </div>                            
                        </div>

                    </div><!-- end col -->

                    <div class="col-12 col-sm-12 col-md-8 col-xl-8">
                        <div class="card-box">
                            <h4 class="header-title mt-0 mb-4 text-center text-danger">INSTRUCTIONS</h4> 
                            <p class="text-danger"><b>1. </b>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p> 
                            <hr/>
                            <p class="text-danger"><b>2. </b>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p> 
                            <hr/>
                            <p class="text-danger"><b>3. </b>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p> 
                            <hr/>
                            <p class="text-danger"><b>4. </b>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p> 
                            <hr/>
                              
                        </div>

                    </div><!-- end col -->


                </div>

                <div class="examination-pane hide">

                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-8 col-xl-8">
                        <div class="card-box">
                            <div id="pre-loader" class="text-center hide"><i class="fa fa-spin fa-spinner"></i></div>
                            <div  id="question-pane"></div>
                            
                              <div class="action-button mt-4">
                            <hr/>
                                <button type="button" class="btn btn-primary waves-effect width-md waves-light"  id="previous-question"><i class="fa fa-arrow-left"></i> Previous</button>
                                <button type="button" class="btn btn-dark waves-effect width-md waves-light pull-right float-right" id="next-question"><i class="fa fa-arrow-right"></i> Next</button> 
                                <button type="button" class="btn btn-success waves-effect width-md waves-light pull-right float-right hide" id="submit-answer"><i class="fa fa-arrow-right"></i> Finish</button>
                            </div>
                        </div>

                    </div><!-- end col -->



                    <div class="col-12 col-sm-12 col-md-4 col-xl-4">
                        <div class="card-box">
                            <div class="text-center" style="">
                            <img src="./uploads/<?php echo $student['profile_picture']; ?>" alt="<?php echo $student['fullname']; ?>" style="width:150px; height: auto;margin: auto;border-radius: 10px;">
                            </div>
                            <hr/>
                            <h4 class="header-title mt-0 mb-4 text-center">Questions</h4>
                            <div class="exam-icon-list"  id="question-list"></div>
                                    <div class="clearfix"></div>
                                    <hr/>
                            <button type="button" class="btn btn-primary btn-block waves-effect width-md waves-light"  id="submit-exam"> Submit</button>
                        </div>

                    </div><!-- end col -->
                    </div>

                </div>
                <!-- end row -->

 <!--submission confirmation Modal -->
                        <a href="#confirmation-modal" id="confirm-submit-modal" data-animation="fadein" data-plugin="custommodal"
                            data-overlaySpeed="200" data-overlayColor="#36404a" class="hide"> click me</a>
        <div id="confirmation-modal" class="modal-demo">
            <button type="button" class="close" onclick="Custombox.modal.close();">
                <span>&times;</span><span class="sr-only">Close</span>
            </button>
            <h4 class="custom-modal-title">Confirmation</h4>
            <div class="custom-modal-text text-left">
                <p class="alert alert-info text-center">
                    Are you sure you want to submit this exam?
                </p>
               <div class="text-center">
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="confirm-submit">Yes, Submit</button>
               <button type="button" class="btn btn-primary waves-effect waves-light close-modal" onclick="Custombox.modal.close();">No</button>
               </div>
            </div>
        </div>


 <!--submission success Modal -->
                        <a href="#success-modal" id="check-answer-modal" data-animation="fadein" data-plugin="custommodal"
                            data-overlaySpeed="200" data-overlayColor="#36404a" class="hide"> click me</a>
        <div id="success-modal" class="modal-demo">
            <button type="button" class="close" onclick="Custombox.modal.close();">
                <span>&times;</span><span class="sr-only">Close</span>
            </button>
            <h4 class="custom-modal-title">Test Result</h4>
            <div class="custom-modal-text text-left">
                <div class="alert alert-info text-center">
                    Dear <?php echo $student['fullname']; ?>, Your test has successfully been submitted. <br/> <h4> Your scored <span id="exam-score"></span></h4>
                </div>
               <div class="text-center">
                    <a href="result-details.php" class="btn btn-danger waves-effect waves-light">View details</a>
               <a href="home.php" class="btn btn-primary waves-effect waves-light">Close</a>
               </div>
            </div>
        </div>

         <!--submission success Modal -->
                        <a href="#elasped-modal" id="timeElapsed" data-animation="fadein" data-plugin="custommodal"
                            data-overlaySpeed="200" data-overlayColor="#36404a" class="hide"> click me</a>
        <div id="elasped-modal" class="modal-demo">
            <button type="button" class="close" onclick="Custombox.modal.close();">
                <span>&times;</span><span class="sr-only">Close</span>
            </button>
            <h4 class="custom-modal-title">Time Elasped</h4>
            <div class="custom-modal-text text-left">
                <div class="alert alert-info text-center">
                    Dear <?php echo $student['fullname']; ?>, The exam has ended because you have exhausted all your time.
                </div>
               <div class="text-center">
               <a href="home.php" class="btn btn-primary waves-effect waves-light">Close</a>
               </div>
            </div>
        </div>

            </div> <!-- end container -->
        </div>
            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        Copyright &copy; <?php echo date("Y"); ?> XYZ. 
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-right footer-links d-none d-sm-block">
                           
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- knob plugin -->
        <script src="assets/libs/jquery-knob/jquery.knob.min.js"></script>
        <!-- App js-->
        <script src="assets/js/app.min.js"></script>
        <!-- Modal-Effect -->
        <script src="assets/libs/custombox/custombox.min.js"></script>
        <script src="assets/js/logic.js"></script>
        <script src="assets/js/custom.js"></script>
    </body>
</html>
<?php } } ?>