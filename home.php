<?php 
require_once "dependencies/functions.php";
// $_SESSION['student_logged'] = "PN/CS/16/04763";
if (!isset($_SESSION['student_logged'])) {
    header("Location: logout.php");
    exit();
}else{  
$query = $conn->prepare("SELECT profile_picture,matric_number,fullname,department_id,level_id,studentship_type FROM student WHERE matric_number='".$_SESSION['student_logged']."' ");
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
        <title>Pre Exam</title>
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

        <!-- Navigation Bar-->
        <header id="topnav">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-right mb-0">
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

        <div class="wrapper" tyle="padding-top: 0;">
            <div class="container-fluid" tyle="padding-top: 0;">

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



        
                    <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                    <br><br>
                        <div class="card-box">
                        
                            <div class="text-center" style="color: #000 !important;">
                                My Courses                        
                            </div>
                            </div>                            
                        </div>


                            <div class="col-12 col-xs-12 col-sm-6 col-md-4">
                                <?php 
                                    $query = $conn->prepare("SELECT course.course_name,exams.exam_id FROM exams JOIN course ON course.course_id=exams.course_id WHERE exams.department_id like '%".$student['department_id']."%' AND exams.studentship_type like '%".$student['studentship_type']."%' AND exams.status='active' AND exams.active='1'");
                                    $query->execute();
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <a href="exams.php?id=<?php echo encrypt($row['exam_id']); ?>" exam-id="<?php echo $row['exam_id']; ?>" class="card-box take-exam" style="display: flex;justify-content: center;align-items: center;flex-direction: column;">
                                            <img src="assets/images/book-icon.png" style="width: 30px;height: auto;">
                                            <h4 class="header-title mt-4 mb-4 text-center text-danger"><?php echo $row['course_name']; ?></h4>
                                    </a>
                        <?php } ?>
                            </div>
                        </div>
                    </div><!-- end col -->


                </div>


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
        <script src="assets/js/custom.js"></script>
        <script>
            $(function(){

                $('.take-exam').click(function(e){
                    e.preventDefault();
                    let examId = $(this).attr('exam-id');
                    let examDetails = {
                        examId: examId,
                        examNo: <?php echo "'".$_SESSION['student_logged']."'"; ?>
                    };
                    localStorage.setItem('examDetails', JSON.stringify(examDetails));
                    location.href = "exams.php";
                });                
            });
        </script>
    </body>
</html>
<?php } } ?>