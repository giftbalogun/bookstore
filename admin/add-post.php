<?php
session_start();
include('includes/config.php');
$conn = db_connect();
error_reporting(0);
if (strlen($_SESSION['manager']) == 0) {
    header('location:index.php');
} else {

    // For adding post  
    if (isset($_POST['submit'])) {
        $isbn = $_POST['isbn'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $descr = $_POST['descr'];
        $price = floatval($_POST['price']);
        $catid = $_POST['category'];
        $pubid = $_POST['publisher'];
        $imgfile = $_FILES["image"]["name"];
        // get the image extension
        $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
        // allowed extensions
        $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
        // Validation for allowed extensions .in_array() function searches an array for a specific value.
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } else {
            //rename the image file
            $imgnewfile = md5($imgfile) . $extension;
            // Code for move image into directory
            move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $imgnewfile);

            $status = 1;
            $query = mysqli_query($conn, "insert into books(id, book_title, book_author, book_price, book_descr, categoryid, publisherid, Is_Active,book_image) values('$isbn', '$title', '$author', '$price', '$descr', '$catid', '$pubid', '$status', '$imgnewfile')");

            if ($query) {
                $msg = "Post successfully added ";
            } else {
                $error = "Something went wrong . Please try again.";
            }
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A CMS Blog">
        <meta name="author" content="Brute_Code">

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Summernote css -->
        <link href="../plugins/summernote/summernote.css" rel="stylesheet" />

        <!-- Select2 -->
        <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

        <!-- Jquery filer css -->
        <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
        <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>

        <!-- include libraries(jQuery, bootstrap) -->
        <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

        <!-- include summernote css/js -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
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
                                    <h4 class="page-title">Add Post </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Post</a>
                                        </li>
                                        <li>
                                            <a href="#">Add Post </a>
                                        </li>
                                        <li class="active">
                                            Add Post
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <!---Success Message--->
                                <?php if ($msg) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                                    </div>
                                <?php } ?>

                                <!---Error Message--->
                                <?php if ($error) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Oh snap!</strong> <?php echo htmlentities($error); ?></div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="p-6">
                                    <div class="">
                                        <form name="addpost" method="post" enctype="multipart/form-data">
                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">ISBN</label>
                                                <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Isbn" required>
                                            </div>

                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Post Title</label>
                                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                                            </div>

                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Author</label>
                                                <input type="text" class="form-control" id="author" name="author" placeholder="Enter author" required>
                                            </div>

                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Price</label>
                                                <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" required>
                                            </div>

                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Category</label>
                                                <select class="form-control" name="category" id="category" required>
                                                    <option value="">Select Category </option>
                                                    <?php
                                                    // Feching active categories
                                                    $ret = mysqli_query($conn, "select categoryid, category_name from category where Is_Active=1");
                                                    while ($result = mysqli_fetch_array($ret)) {
                                                    ?>
                                                        <option value="<?php echo htmlentities($result['categoryid']); ?>">
                                                            <?php echo htmlentities($result['category_name']); ?></option>
                                                    <?php } ?>

                                                </select>
                                            </div>

                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Publisher</label>
                                                <select class="form-control" name="publisher" id="publisher" required>
                                                    <option value="">Select Author </option>
                                                    <?php
                                                    // Feching active categories
                                                    $ret = mysqli_query($conn, "select publisherid, publisher_name from publisher where Is_Active=1");
                                                    while ($result = mysqli_fetch_array($ret)) {
                                                    ?>
                                                        <option value="<?php echo htmlentities($result['publisherid']); ?>">
                                                            <?php echo htmlentities($result['publisher_name']); ?></option>
                                                    <?php } ?>

                                                </select>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card-box">
                                                        <textarea id="summernote" class="summernote" name="descr" id="descr">
                                                    </textarea>
                                                        <script>
                                                            $('#summernote').summernote({
                                                                placeholder: 'Hello bootstrap 4',
                                                                tabsize: 3,
                                                                height: 100
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card-box">
                                                <h4 class="m-b-30 m-t-0 header-title"><b>Feature Image</b></h4>
                                                <input type="file" class="form-control" id="image" name="image" required>
                                            </div>
                                        </div>
                                    </div>


                                    <button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Save and Post</button>
                                    <button type="button" class="btn btn-danger waves-effect waves-light">Discard</button>
                                    </form>
                                </div>
                            </div> <!-- end p-20 -->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->



                </div> <!-- container -->

            </div> <!-- content -->

            <?php include('includes/footer.php'); ?>

        </div>


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


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

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>
        <!-- Select 2 -->
        <script src="../plugins/select2/js/select2.min.js"></script>
        <!-- Jquery filer js -->
        <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>

        <!-- page specific js -->
        <script src="assets/pages/jquery.blog-add.init.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script>
            jQuery(document).ready(function() {

                $('.summernote').summernote({
                    height: 240, // set editor height
                    minHeight: null, // set minimum height of editor
                    maxHeight: null, // set maximum height of editor
                    focus: false // set focus to editable area after initializing summernote
                });
                // Select2
                $(".select2").select2();

                $(".select2-limiting").select2({
                    maximumSelectionLength: 2
                });
            });
        </script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>




    </body>

    </html>
<?php } ?>