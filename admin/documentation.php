<?php 
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
        <title>Dashboard  - Mobilelab.life</title>
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
                                    <li class="breadcrumb-item active">Documentation</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Documentation</h4>
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
                                        <h3>Frequently Asked Questions</h3>
                                        <p class="text-muted"> Nisi praesentium similique totam odio obcaecati, reprehenderit,
                                            dignissimos rem temporibus ea inventore alias! Beatae animi nemo ea
                                            tempora, temporibus laborum facilis ut!</p>

                                        <button type="button" class="btn btn-success waves-effect waves-light mt-1">Email us your question</button>
                                        <button type="button" class="btn btn-primary waves-effect waves-light mt-1">Send us a tweet</button>

                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->

                            <div class="row mt-4 justify-content-center">
                                <div class="col-xl-5">
                                    <div class="p-2">
                                        
                                        <div class="accordion custom-accordion" id="accordionExample">
                                            <div class="card mb-2">
                                                <div class="card-header bg-light">
                                                    <h5 class="card-title m-0">
                                                        <a href="#" class="text-dark" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            What is Lorem Ipsum?
                                                        </a>
                                                    </h5>
                                                </div>

                                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                        <p class="mb-0">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card mb-2">
                                                <div class="card-header bg-light">
                                                    <h5 class="card-title m-0">
                                                        <a href="#" class="text-dark" class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                            Is safe use Lorem Ipsum?
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="collapseTwo" class="collapse" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                        <p class="mb-0">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card mb-2">
                                                <div class="card-header bg-light">
                                                    <h5 class="card-title m-0">
                                                        <a href="#" class="text-dark" class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                            Why use Lorem Ipsum?
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="collapseThree" class="collapse" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                        <p class="mb-0">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- accordian end -->

                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-xl-5">
                                    <div class="p-2">
                                        <div class="accordion custom-accordion" id="accordionExample1">
                                            <div class="card mb-2">
                                                <div class="card-header bg-light">
                                                    <h5 class="card-title m-0">
                                                        <a href="#" class="text-dark" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                                            License & Copyright
                                                        </a>
                                                    </h5>
                                                </div>

                                                <div id="collapseFour" class="collapse show" data-parent="#accordionExample1">
                                                    <div class="card-body">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                        <p class="mb-0">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card mb-2">
                                                <div class="card-header bg-light">
                                                    <h5 class="card-title m-0">
                                                        <a href="#" class="text-dark" class="collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                            How many variations exist?
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="collapseFive" class="collapse" data-parent="#accordionExample1">
                                                    <div class="card-body">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                        <p class="mb-0">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card mb-2">
                                                <div class="card-header bg-light">
                                                    <h5 class="card-title m-0">
                                                        <a href="#" class="text-dark" class="collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                            Why use Lorem Ipsum?
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="collapseSix" class="collapse" data-parent="#accordionExample1">
                                                    <div class="card-body">
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                        <p class="mb-0">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- accordian end -->
                                    </div>
                                </div>
                                <!-- end col -->
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

<!-- App js-->
<script src="<?php echo ROOT; ?>assets/js/app.min.js"></script>

<script src="<?php echo ROOT; ?>assets/js/custom.js"></script>
    </body>
</html>
<?php } ?>