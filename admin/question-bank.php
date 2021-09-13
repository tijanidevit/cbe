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

          <!-- third party css -->
        <link href="<?php echo ROOT; ?>assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ROOT; ?>assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ROOT; ?>assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ROOT; ?>assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
        
        <!-- third party css end -->

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
                                        <h3>Available Courses</h3>
                                        <p class="text-muted"> Nisi praesentium similique totam odio obcaecati, reprehenderit,
                                            dignissimos rem temporibus ea inventore alias! Beatae animi nemo ea
                                            tempora, temporibus laborum facilis ut!</p>                                      
                                            <a href="new-exam.php" class="btn btn-success waves-effect waves-light mt-1">Add new Course</a>
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->
                             <?php if (isset($_SESSION['response'])) {
                                echo $_SESSION['response'];
                                unset($_SESSION['response']);
                            } ?>
                              <div class="row">
                    <div class="col-12">
                        <div class="card-box table-responsive">
                             <?php 
                              $query = $conn->prepare("SELECT exams.exam_id,exams.status,course.course_name,exams.level_id,exams.studentship_type,exams.total_questions,exams.duration,levels.level_name,exams.exam_id,exams.department_id FROM exams JOIN course ON exams.course_id =course.course_id JOIN levels ON exams.level_id = levels.level_id WHERE exams.active='1' ORDER BY exams.status ASC");
                              $query->execute();
                              if (($query->rowCount()) == 0) {
                                echo "<h1 class='text-center alert alert-danger'>No record found.</h1>";
                              }else{
                             ?>
                                <h4 class="mt-0 header-title text-center">Question Bank</h4>   
                                <hr/>                         
                                <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive norap">
                                    <thead>

                                    <tr>
                                        <th></th>
                                        <th>Course</th>
                                        <th>Department</th>
                                        <th>Level</th>
                                        <th>Studentship</th>
                                        <th>Questions</th>
                                        <th>Total Exam Questions</th>
                                        <th>Duration</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i =0;
                                    while ($row= $query->fetch(PDO::FETCH_ASSOC)) { $i++; ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row['course_name']; ?></td>
                                            <td><?php $department_id = explode(';', $row['department_id']);

                                            for ($j=0; $j < count($department_id)-1 ; $j++) { 
                                                echo getValue('departments','department_id','department_name',$department_id[$j])."_";
                                            }
                                             ?>
                                                
                                            </td>
                                            <td><?php echo $row['level_name']; ?></td>
                                            <td><?php echo ucfirst(str_replace(';', '<br />', $row['studentship_type'])); ?></td>
                                            <td><?php echo getRowCount('questions','exam_id',$row['exam_id']); ?></td>
                                            <td><?php echo $row['total_questions']; ?></td>
                                            <td><?php echo $row['duration']; ?></td>
                                            <td>
                                                <?php if ($row['status'] == 'not active') {?>
                                                <div class="row mb-2">
                                                    <a href="questions.php?q=<?php echo encrypt($row['exam_id']); ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                
                                                </div>
                                                <div class="row">
                                                    
                                                    <a href="actions/start-exam.php?q=<?php echo encrypt($row['exam_id']); ?>" class="btn bg-theme-colored"><i class="fa fa-check"></i></a>
                                                
                                                <a href="actions/trash-exam.php?q=<?php echo encrypt($row['exam_id']); ?>" class="btn btn-danger ml-2 trash-button2"><i class="fa fa-trash"></i></a>
                                                </div>
                                            <?php }else{?>
                                               
                                                    <a href="questions.php?q=<?php echo encrypt($row['exam_id']); ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                
                                               
                                                <a href="actions/trash-exam.php?q=<?php echo encrypt($row['exam_id']); ?>" class="btn btn-danger ml-2 trash-button2"><i class="fa fa-trash"></i></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            <?php } ?>
                        </div>
                    </div>
                </div> 
                            <!-- end row -->


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
 <!-- third party js -->
        <script src="<?php echo ROOT; ?>assets/libs/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo ROOT; ?>assets/libs/datatables/dataTables.bootstrap4.js"></script>
        <script src="<?php echo ROOT; ?>assets/libs/datatables/dataTables.responsive.min.js"></script>
        <script src="<?php echo ROOT; ?>assets/libs/datatables/responsive.bootstrap4.min.js"></script>
        <script src="<?php echo ROOT; ?>assets/libs/datatables/dataTables.buttons.min.js"></script>
        <script src="<?php echo ROOT; ?>assets/libs/datatables/buttons.bootstrap4.min.js"></script>
        <!-- third party js ends -->
       
        <!-- Datatables init -->
        <script src="<?php echo ROOT; ?>assets/js/pages/datatables.init.js"></script>


<!-- App js-->
<script src="<?php echo ROOT; ?>assets/js/app.min.js"></script>

<script src="<?php echo ROOT; ?>assets/js/custom.js"></script>
    </body>
</html>
<?php } ?>