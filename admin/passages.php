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
if (!isset($_GET['q']) || empty($_GET['q'])) {
    header("Location: question-bank.php");
}
$exam_id = decrypt($_GET['q']);
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

        <!-- Custom box css -->
        <link href="<?php echo ROOT; ?>assets/libs/custombox/custombox.min.css" rel="stylesheet">
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
                            <?php if (isset($_SESSION['response'])) {
                                echo $_SESSION['response'];
                                unset($_SESSION['response']);
                            } ?>
                            <div class="row justify-content-center">
                                <div class="col-sm-6">
                                    <div class="text-center">
                                        <h3>Available Courses</h3>
                                        <p class="text-muted"> Nisi praesentium similique totam odio obcaecati, reprehenderit,
                                            dignissimos rem temporibus ea inventore alias! Beatae animi nemo ea
                                            tempora, temporibus laborum facilis ut!</p>                                      
                                            <a href="new-question.php?q=<?php echo $_GET['q']; ?>" class="btn btn-success waves-effect waves-light mt-1">Add new Question</a>
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->

                              <div class="row">
                    <div class="col-12">
                        <div class="card-box table-responsive">
                             <?php 
                              $query = $conn->prepare("SELECT * FROM questions WHERE exam_id='$exam_id' AND active='1' ");
                              $query->execute();
                              if (($query->rowCount()) == 0) {
                                echo "<h1 class='text-center alert alert-danger'>No question found.</h1>";
                              }else{
                             ?>  
                                <hr/>                         
                                <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive norap">
                                    <thead>

                                    <tr>
                                        <th></th>
                                        <th>Question</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i =0;
                                    while ($row= $query->fetch(PDO::FETCH_ASSOC)) { $i++; ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row['question_description']; ?></td>
                                            <td>
                                                <div class="row">
                                                    <a  href="#diagnosis-modal<?php echo $row['question_id']; ?>" data-animation="door" data-plugin="custommodal" data-overlayColor="#36404a" class="btn btn-primary btn-block"><i class="fa fa-eye"></i></a>
                                                <a href="edit-question.php?q=<?php echo encrypt($row['question_id']); ?>&e=<?php echo $_GET['q'] ?>" class="btn btn-warning btn-block"><i class="fa fa-edit"></i></a>
                                                <a href="actions/trash-question.php?q=<?php echo encrypt($row['question_id']); ?>&e=<?php echo $_GET['q'] ?>" class="btn btn-danger trash-button2 btn-block"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>

        <!-- Modal -->
        <div id="diagnosis-modal<?php echo $row['question_id']; ?>" class="modal-demo">
                <button type="button" class="close" onclick="Custombox.modal.close();">
                    <span>&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="custom-modal-title">Question Details</h4>
                <div class="custom-modal-text">
                  <p><?php echo $row['question_description']; ?></p>
                  <hr/>
                  <h4>Options</h4>
                  <?php $options = explode('&&', $row['options']);
                            $k=0;
                            for ($i=0; $i < count($options) ; $i++) { if ($i >=5 ) break;?>
                                <?php if (test_input($options[$i]) == '') {
                                   break;
                                } ?>
                               <p><b>Option <?php echo $i+1; ?>  => </b><?php echo $options[$i] ?></p>                                
                            <?php } ?>
                            <hr/>
                            <h4>Answer Type</h4>
                            <p><?php echo $row['answer_type']; ?></p><hr/>
                            <h4>Correct Answer</h4>
                            <?php $answer = explode('&&', $row['answer']);
                            $k=0;
                            for ($i=0; $i < count($answer) ; $i++) { if ($i >=5) break;?>
                                 <?php if (test_input($answer[$i]) == '') {
                                   break;
                                } ?>
                               <p>=> <?php echo $answer[$i] ?></p>                                
                            <?php } ?>
                                <hr/>
                            
                            <?php if ($row['attachment'] != '0') {?>
                                <h4>Attachment</h4>
                            <img src="<?php echo ROOT; ?>uploads/<?php echo $row['attachment']; ?>" style="max-height: 300px;width: auto;margin: auto;" alt="" />
                        <?php } ?>
                </div>
            </div>
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

        <!-- Modal-Effect -->
        <script src="<?php echo ROOT; ?>assets/libs/custombox/custombox.min.js"></script>
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