<?php
session_start();
include('includes/config.php');
$conn = db_connect();
error_reporting(0);
if (strlen($_SESSION['manager']) == 0) {
    header('location:index.php');
} else {
    if ($_GET['action'] == 'del' && $_GET['rid']) {
        $id = $_GET['rid'];
        $query = mysqli_query($conn, "update publisher set Is_Active='0' where publisherid='$id'");
        $msg = "publisher deleted ";
    }
    // Code for restore
    if ($_GET['resid']) {
        $id = $_GET['resid'];
        $query = mysqli_query($conn, "update publisher set Is_Active='1' where publisherid='$id'");
        $msg = "publisher restored successfully";
    }
    // Code for Forever deletionparmdel
    if ($_GET['action'] == 'parmdel' && $_GET['rid']) {
        $id = $_GET['rid'];
        $query = mysqli_query($conn, "delete from  publisher  where publisherid='$id'");
        $delmsg = "publisher deleted forever";
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>
    </head>

    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include('includes/topheader.php'); ?>

            <!-- ========== Left Sidebar Start ========== -->
            <?php include('includes/leftsidebar.php'); ?>
            <!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">ManagePublisher</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Publisher </a>
                                        </li>
                                        <li class="active">
                                            Manage Publisher
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-sm-6">

                                <?php if ($msg) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                                    </div>
                                <?php } ?>

                                <?php if ($delmsg) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Oh snap!</strong> <?php echo htmlentities($delmsg); ?></div>
                                <?php } ?>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="demo-box m-t-20">
                                        <div class="m-b-30">
                                            <a href="add-publisher.php">
                                                <button id="addToTable" class="btn btn-success waves-effect waves-light">Add
                                                    <i class="mdi mdi-plus-circle-outline"></i></button>
                                            </a>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table m-0 table-colored-bordered table-bordered-primary">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>publisher</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = mysqli_query($conn, "Select * from  publisher where Is_Active=1");
                                                    $cnt = 1;
                                                    while ($row = mysqli_fetch_array($query)) {
                                                    ?>
                                                        <tr>
                                                            <th scope="row"><?php echo htmlentities($cnt); ?></th>
                                                            <td><?php echo htmlentities($row['publisher_name']); ?></td>
                                                            <td><a href="edit-publisher.php?pid=<?php echo htmlentities($row['publisherid']); ?>"><i class="fa fa-pencil" style="color: #29b6f6;"></i></a>
                                                                &nbsp;<a href="manage-publisher.php?rid=<?php echo htmlentities($row['publisherid']); ?>&&action=del">
                                                                    <i class="fa fa-trash-o" style="color: #f05050"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        $cnt++;
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--- end row -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="demo-box m-t-20">
                                        <div class="m-b-30">
                                            <h4><i class="fa fa-trash-o"></i> Deleted Publisher</h4>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table m-0 table-colored-bordered table-bordered-danger">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th> publisher</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = mysqli_query($conn, "Select * from publisher where Is_Active=0");
                                                    $cnt = 1;
                                                    while ($row = mysqli_fetch_array($query)) {
                                                    ?>
                                                        <tr>
                                                            <th scope="row"><?php echo htmlentities($cnt); ?></th>
                                                            <td><?php echo htmlentities($row['publisher_name']); ?></td>
                                                            <td><a href="manage-publisher.php?resid=<?php echo htmlentities($row['publisherid']); ?>"><i class="ion-arrow-return-right" title="Restore this publisher"></i></a>
                                                                &nbsp;<a href="manage-publisher.php?rid=<?php echo htmlentities($row['publisherid']); ?>&&action=parmdel" title="Delete forever"> <i class="fa fa-trash-o" style="color: #f05050"></i> </td>
                                                        </tr>
                                                    <?php
                                                        $cnt++;
                                                    } ?>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- container -->

                    </div> <!-- content -->
                    <?php include('includes/footer.php'); ?>
                </div>
            </div>
            <!-- END wrapper -->

            <script>
                var resizefunc = [];
            </script>

            <!-- jQuery  -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>
            <script src="assets/js/detect.js"></script>
            <script src="assets/js/fastclick.js"></script>
            <script src="assets/js/jquery.blockUI.js"></script>
            <script src="assets/js/waves.js"></script>
            <script src="assets/js/jquery.slimscroll.js"></script>
            <script src="assets/js/jquery.scrollTo.min.js"></script>
            <script src="../plugins/switchery/switchery.min.js"></script>

            <!-- App js -->
            <script src="assets/js/jquery.core.js"></script>
            <script src="assets/js/jquery.app.js"></script>

    </body>

    </html>
<?php } ?>