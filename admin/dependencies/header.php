<header id="topnav">
    <!-- Topbar Start -->
    <div class="navbar-custom">
        <div class="container-fluid">
            <ul class="list-unstyled topnav-menu float-right mb-0">
                <li class="dropdown notification-list">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle nav-link">
                        <div class="lines">
                            <span>
                            </span>
                            <span>
                            </span>
                            <span>
                            </span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </li>

                
                <li id="cart-basket" style="display: none;">
                    <a href="my-cart.php" class="nav-link">
                        <i class="fa fa-shopping-cart text-white">
                        </i>
                        <sup>
                            <span class="badge badge-info badge-xs cart-counter" style="padding: 4px; font-size: 11px !important;"> 
                            </span>
                        </sup>
                    </a>
                </li>
                <li class="dropdown notification-list">
                    <a aria-expanded="false" aria-haspopup="false" class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button">

                      <i class="fa fa-user"></i>

                            <span class="pro-user-name ml-1">
                                <?php echo $user['username']; ?>
                                <i class="mdi mdi-chevron-down">
                                </i>
                            </span>
                        </img>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">
                                Welcome !
                            </h6>
                        </div>
                        <!-- item-->
                        <a class="dropdown-item notify-item" href="logout.php">
                            <i class="fe-log-out">
                            </i>
                            <span>
                                Logout
                            </span>
                        </a>
                    </div>
                </li>
                <li class="dropdown notification-list">
                    <a class="nav-link right-bar-toggle waves-effect" href="javascript:void(0);">
                        <i class="fe-settings noti-icon">
                        </i>
                    </a>
                </li>
            </ul>
            <!-- LOGO -->
            <div class="logo-box">
                <a class="logo text-center" href="dashboard.php">
                    <span class="logo-lg">
                       <?php if (!file_exists("../setup/images/school-logo.png")) {
                               ?>
                            <span style=";"><img src="../setup/images/default-logo.png" alt="" height="45"></span>
                        <?php } else {?>
                            <span style=";"><img src="../setup/images/school-logo.png" alt="" height="45"></span>
                            <?php } ?>
                    </span>
                    <span class="logo-sm">
                       <?php if (!file_exists("../setup/images/school-logo.png")) {
                               ?>
                            <span style=";"><img src="../setup/images/default-logo.png" alt="" height="45"></span>
                        <?php } else {?>
                            <span style=";"><img src="../setup/images/school-logo.png" alt="" height="45"></span>
                            <?php } ?>
                    </span>
                </a>
            </div>
        </div>
        <!-- end container-fluid-->
    </div>
    <!-- end Topbar -->
    <div class="topbar-menu">
        <div class="container-fluid">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li class="has-submenu">
                        <a href="dashboard.php">
                            <i class="mdi mdi-view-dashboard">
                            </i>
                            Dashboard
                        </a>
                    </li>
                    <li class="has-submenu">
                        <a href="students.php">
                            <i class="mdi mdi-folder">
                            </i>
                            Students
                        </a>
                    </li>
                    <li class="has-submenu">
                        <a href="exams.php">
                            <i class="mdi mdi-cards-outline">
                            </i>
                            Exams
                        </a>
                    </li>
                    <li class="has-submenu">
                        <a href="settings.php">
                            <i class="mdi mdi-view-dashboard">
                            </i>
                            Settings
                        </a>
                    </li>
                    <li class="has-submenu">
                        <a href="documentation.php">
                            <i class="mdi mdi-account">
                            </i>
                            Documentation
                        </a>
                    </li>
                </ul>
                <!-- End navigation menu -->
                <div class="clearfix">
                </div>
            </div>
            <!-- end #navigation -->
        </div>
        <!-- end container -->
    </div>
    <!-- end navbar-custom -->
</header>