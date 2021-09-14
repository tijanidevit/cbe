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

    if (!isset($_GET['p']) || empty($_GET['p'])) {
    header("Location: question-bank.php");
}
$passage_id = decrypt($_GET['p']);
$exam_id = decrypt($_GET['e']);
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
                            <h4 class="header-title mt-0 mb-4">New Question</h4>
                            <!-- <p class="text-muted font-13">
                                Use a <code>
                                &lt;select multiple /&gt;</code>
                                as your input element for a tags input, to gain true multivalue support.
                            </p> -->
                            <form method="post" action="actions/submit-question.php"  enctype="multipart/form-data">
                            <div class="row">


                            <div class="form-group col-12 col-xs-12">
                                <label class="label">Question</label> <br/>
                                <textarea name="question_description" class="form-control" placeholder="" required="required"></textarea>
                               
                            </div>
                            <div id="repeater2" class=" col-12 col-xs-12">
                                                <div class="items " data-group="test">
                                                  <!-- Repeater Content --> 
                                                  <div class="details-row-counter">
                                                  <div class="item-content">
                                                        <div class="form-group  col-12 col-xs-12 row">
                                                            <input type="text" name="option" data-name="option" class=" col-12 col-xs-12 col-md-11 form-control" placeholder="Option" required="required"/>
                                                            <button class="pull-right  float-right col-12 col-xs-12 col-md-1 btn btn-danger m-input remove-btn btnremove"  type="button">
                                                X
                                            </button>
                                                        </div> 
                                            </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row mt-4">
                                <div class="col-lg-3">
                                    <button class="btn btn btn-primary btn-sm repeater-add-btn" type="button">
                                        <span>
                                            <i class="fa fa-plus">
                                            </i>
                                            <span>
                                                Add
                                            </span>
                                        </span>
                                    </button>
                                </div>
                            </div>  
                                        </div>
                                        <input type="hidden" name="no_of_options_filled" id="no_of_options_filled">
                                        <input type="hidden" name="passage_id" value="<?php echo $passage_id ?>">
                                        <input type="hidden" name="exam_id" value="<?php echo $exam_id ?>">
                                            <!-- Repeater End -->


                            <!-- <div class="form-group col-12 col-xs-12">
                                <label class="label">Answer Type</label> <br/>
                                <select class="form-control" name="answer_type" id="answer-type">
                                    <option value="single">Single Type</option>
                                    <option value="multiple">Multiple Choice</option>
                                </select>
                            </div> -->
                            <input type="hidden" name="answer_type" value="single" id="answer-type" />
                            <div class="form-group col-12 col-xs-12">
                                <label class="label">Answer <small class="text-danger" id="multiple-answer-tip" style="display: none;">(Seperate multiple answers with <b>&&</b>)</small></label> <br/>
                                <input type="text" name="answer" class="form-control" required="required"/>
                            </div>
                            <!-- <div class="form-group col-12 col-xs-12">
                                <label class="label">Attachment</label> <br/>
                                <input type="file" name="attachment" class="form-control" accept="image/*" />
                            </div> -->

                            <div class="text-right">
                                <button type="submit" class="btn bg-theme-colored btn-md float-right" name="submit-question">Submit</button>
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
<script>
    $(function(){
            $("#repeater2").createRepeater({
            showFirstItemToDefault: true,
        });
        $('.repeater-add-btn, .remove-btn').click(function(e){
            e.preventDefault();
        });
        var no_of_options_filled = 0;

        setTimeout(rowCounter,1000);
        function rowCounter(){
            $('.details-row-counter').each(function(){
            no_of_options_filled++;
        });
        $('#no_of_options_filled').val(no_of_options_filled);
        }
        $('.repeater-add-btn').click(function(){
            $('#no_of_options_filled').val(Number($('#no_of_options_filled').val()) + 1);
        });
        $('.remove-btn').click(function(){
            $('#no_of_options_filled').val(Number($('#no_of_options_filled').val()) - 1);
        });
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
<?php }?>