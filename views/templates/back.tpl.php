<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Admin EatFood</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Plugins css -->
    <link href="../../public/admin/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="../../public/admin/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="../../public/admin/plugins/timepicker/tempusdominus-bootstrap-4.css" rel="stylesheet" />
    <link href="../../public/admin/plugins/timepicker/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <link href="../../public/admin/plugins/clockpicker/jquery-clockpicker.min.css" rel="stylesheet" />
    <link href="../../public/admin/plugins/colorpicker/asColorPicker.min.css" rel="stylesheet" type="text/css" />
    <link href="../../public/admin/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />

    <link href="../../public/admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="../../public/admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="../../public/admin/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

    <link href="../../public/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../public/admin/css/icons.css" rel="stylesheet" type="text/css">
    <link href="../../public/admin/css/style.css" rel="stylesheet" type="text/css">

</head>


<body class="fixed-left">

<!-- Loader -->
<div id="preloader"><div id="status"><div class="spinner"></div></div></div>

<!-- Begin page -->
<div id="wrapper">

    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
            <i class="ion-close"></i>
        </button>

        <!-- LOGO -->
        <div class="topbar-left">
            <div class="text-center">
                <a href="/" class="logo"><i class="mdi mdi-assistant"></i> EatFood</a>
                <!-- <a href="index.html" class="logo"><img src="assets/images/logo.png" height="24" alt="logo"></a> -->
            </div>
        </div>

        <div class="sidebar-inner slimscrollleft">

            <div id="sidebar-menu">
                <ul>
                    <li class="menu-title">Main</li>

                    <li>
                        <a href="/dashboard" class="waves-effect">
                            <i class="mdi mdi-airplay"></i>
                            <span> Dashboard <span class="badge badge-pill badge-primary float-right">7</span></span>
                        </a>
                    </li>

                    <li>
                        <a href="/produits" class="waves-effect"><i class="mdi mdi-clipboard-outline"></i><span> Produits </span></a>
                    </li>

                    <li>
                        <a href="/commandes" class="waves-effect"><i class="mdi mdi-calendar-clock"></i><span> Commandes </span></a>
                    </li>

                    <li>
                        <a href="#" class="waves-effect"><i class="mdi mdi-layers"></i><span> Fermetures </span></a>
                    </li>

                    <li>
                        <a href="/design" class="waves-effect"><i class="mdi mdi-google-pages"></i><span> Design </span></a>
                    </li>

                    <li>
                        <a href="#" class="waves-effect"><i class="mdi mdi-book-minus"></i><span> Facturations </span></a>
                    </li>

                    <li>
                        <a href="/adminContact" class="waves-effect"><i class="mdi mdi-account-box"></i><span> Contacts </span></a>
                    </li>

                    <li>
                        <a href="/faqs" class="waves-effect"><i class="mdi mdi-calendar-text"></i><span> FAQs </span></a>
                    </li>

                    <li>
                        <a href="/deconnexion" class="waves-effect"><i class="mdi mdi-exit-to-app"></i><span> Déconnexion </span></a>
                    </li>

                </ul>
            </div>
            <div class="clearfix"></div>
        </div> <!-- end sidebarinner -->
    </div>
    <!-- Left Sidebar End -->

    <!-- Start right Content here -->

    <div class="content-page">
        <!-- Start content -->
        <div class="content">

            <!-- Top Bar Start -->
            <div class="topbar">

                <nav class="navbar-custom">

                    <ul class="list-inline float-right mb-0">
                        <!-- language-->
                        <li class="list-inline-item dropdown notification-list hide-phone">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect text-white" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                English <img src="../../public/admin/images/flags/us_flag.jpg" class="ml-2" height="16" alt=""/>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right language-switch">
                                <a class="dropdown-item" href="#"><img src="../../public/admin/images/flags/italy_flag.jpg" alt="" height="16"/><span> Italian </span></a>
                                <a class="dropdown-item" href="#"><img src="../../public/admin/images/flags/french_flag.jpg" alt="" height="16"/><span> French </span></a>
                                <a class="dropdown-item" href="#"><img src="../../public/admin/images/flags/spain_flag.jpg" alt="" height="16"/><span> Spanish </span></a>
                                <a class="dropdown-item" href="#"><img src="../../public/admin/images/flags/russia_flag.jpg" alt="" height="16"/><span> Russian </span></a>
                            </div>
                        </li>
                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <i class="ti-email noti-icon"></i>
                                <span class="badge badge-danger noti-icon-badge">5</span>
                            </a>
                        </li>

                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <i class="ti-bell noti-icon"></i>
                                <span class="badge badge-success noti-icon-badge">23</span>
                            </a>
                        </li>

                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <img src="../../public/admin/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
                            </a>
                        </li>

                    </ul>

                    <div class="clearfix"></div>

                </nav>

            </div>
            <!-- Top Bar End -->

            <div class="page-content-wrapper ">

                <div class="container-fluid">

                    <?php include $this->v;?>

                </div><!-- container -->

            </div> <!-- Page content Wrapper -->

        </div> <!-- content -->

        <footer class="footer">
            © 2019 Annex by WANG Zhenchao.
        </footer>

    </div>
    <!-- End Right content here -->

</div>
<!-- END wrapper -->

<!-- App js -->

<!-- jQuery  -->
<script src="../../public/admin/js/jquery.min.js"></script>
<script src="../../public/admin/js/popper.min.js"></script>
<script src="../../public/admin/js/bootstrap.min.js"></script>
<script src="../../public/admin/js/modernizr.min.js"></script>
<script src="../../public/admin/js/detect.js"></script>
<script src="../../public/admin/js/fastclick.js"></script>
<script src="../../public/admin/js/jquery.slimscroll.js"></script>
<script src="../../public/admin/js/jquery.blockUI.js"></script>
<script src="../../public/admin/js/waves.js"></script>
<script src="../../public/admin/js/jquery.nicescroll.js"></script>
<script src="../../public/admin/js/jquery.scrollTo.min.js"></script>

<!-- Required datatable js -->
<script src="../../public/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../public/admin/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="../../public/admin/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="../../public/admin/plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="../../public/admin/plugins/datatables/jszip.min.js"></script>
<script src="../../public/admin/plugins/datatables/pdfmake.min.js"></script>
<script src="../../public/admin/plugins/datatables/vfs_fonts.js"></script>
<script src="../../public/admin/plugins/datatables/buttons.html5.min.js"></script>
<script src="../../public/admin/plugins/datatables/buttons.print.min.js"></script>
<script src="../../public/admin/plugins/datatables/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="../../public/admin/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="../../public/admin/plugins/datatables/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="../../public/admin/pages/datatables.init.js"></script>

<!-- Plugins js -->
<script src="../../public/admin/plugins/timepicker/moment.js"></script>
<script src="../../public/admin/plugins/timepicker/tempusdominus-bootstrap-4.js"></script>
<script src="../../public/admin/plugins/timepicker/bootstrap-material-datetimepicker.js"></script>
<script src="../../public/admin/plugins/clockpicker/jquery-clockpicker.min.js"></script>
<script src="../../public/admin/plugins/colorpicker/jquery-asColor.js" type="text/javascript"></script>
<script src="../../public/admin/plugins/colorpicker/jquery-asGradient.js" type="text/javascript"></script>
<script src="../../public/admin/plugins/colorpicker/jquery-asColorPicker.min.js" type="text/javascript"></script>
<script src="../../public/admin/plugins/select2/select2.min.js" type="text/javascript"></script>

<script src="../../public/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="../../public/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="../../public/admin/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="../../public/admin/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>

<!-- Plugins Init js -->
<script src="../../public/admin/pages/form-advanced.js"></script>

<!-- App js -->
<script src="../../public/admin/js/app.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable2').DataTable();
    } );
</script>

</body>
</html>
