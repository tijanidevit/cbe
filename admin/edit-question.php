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

    if (!isset($_GET['q']) || empty($_GET['q'])) {
    header("Location: question-bank.php");
}
$question_id = decrypt($_GET['q']);
$e = $_GET['e'];

$query = $conn->prepare("SELECT * FROM questions WHERE question_id='$question_id'");
$query->execute();
if (($query->rowCount()) == 0) {
    echo "<h1 class='text-center alert alert-danger'>Invalid or broken link $question_id .<a href='questions.php?a=$e'>Click here to go back</a></h1>";
}else{
    $row = $query->fetch(PDO::FETCH_ASSOC);
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8" />
        <title>Questions  - <?php echo $config['school_name']; ?></title>
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
                            <h4 class="page-title">Edit Question</h4>
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
                            <h4 class="header-title mt-0 mb-4">Edit Question</h4>
                            <!-- <p class="text-muted font-13">
                                Use a <code>
                                &lt;select multiple /&gt;</code>
                                as your input element for a tags input, to gain true multivalue support.
                            </p> -->
                            <form method="post" action="actions/update-question.php">
                            <div class="row">


                            <div class="form-group col-12 col-xs-12">
                                <label class="label">Question</label> <br/>
                                <textarea name="question_description" class="form-control" placeholder="" required="required" rows="10"><?php echo $row['question_description'] ?></textarea>
                               
                            </div>
                            <?php $options = explode('&&', $row['options']);
                            $k=0;
                            for ($i=0; $i < count($options) ; $i++) { if ($i >=5 ) break;?>

                                 <div class="form-group col-12 col-xs-12">
                                <label class="label">Option <?php echo $i+1; ?></label> <br/>
                                <input type="text" name="option<?php echo $i; ?>" value="<?php echo $options[$i] ?>" class="form-control" />                          
                            </div>

                                
                            <?php $k++;} ?>
                                        <input type="hidden" name="no_of_options" value="<?php echo $k ?>">
                                        <input type="hidden" name="question_id" value="<?php echo $question_id ?>">
                                        <input type="hidden" name="exam_id" value="<?php echo decrypt($e); ?>"> 
                                            <!-- Repeater End -->


                            <div class="form-group col-12 col-xs-12">
                                <label class="label">Answer Type</label> <br/>
                                <select class="form-control" name="answer_type" id="answer-type">
                                    <option value="single" <?php if ($row['answer_type'] == 'single') echo "selected='selected'"; ?>>Single Type</option>
                                    <option value="multiple" <?php if ($row['answer_type'] == 'multiple') echo "selected='selected'"; ?>>Multiple Choice</option>
                                </select>
                            </div>
                            <div class="form-group col-12 col-xs-12">
                                <label class="label">Correct Answer <small class="text-danger" id="multiple-answer-tip" <?php if ($row['answer_type'] == 'single'){?> style="display: none;" <?php } ?> >(Seperate multiple answers with <b>&&</b>)</small> </label> <br/>
                                <input type="text" name="answer" class="form-control" required="required" value="<?php echo $row['answer'] ?>" />
                            </div>
                            <div class="form-group col-12 col-xs-12">
                                <label class="label">Attachment</label> <br/>
                                <input type="file" name="attachment" class="form-control" accept="image/*" />
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn bg-theme-colored btn-md float-right" name="update-question">Update</button>
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
<script>
    $(function(){
         
        $('#answer-type').change(function(){
            if ($(this).val() =='multiple') {
                $('#multiple-answer-tip').show();
            }else{

                $('#multiple-answer-tip').hide();
            }
        });
        });
</script>
    </body>
</html>
<?php } }?>