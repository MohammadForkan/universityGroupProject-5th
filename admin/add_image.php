<?php
session_start();

if ($_SESSION['admin_id'] == NULL) {
    header('Location:index.php');
}

require_once '../class/blog.php';
$blog = new Blog();

if (isset($_GET['logout'])) {
    require_once '../class/login.php';
    $login = new Login;
    $login->admin_logout();
}

$massage = '';
if (isset($_POST['btn'])) {
    $massage = $blog->save_image_info($_POST);
}
$query_result = $blog->selectAllImageInfo();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>
        <link href="../asset/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Blog Management System</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="dashbord.php">Add Blog</a></li>
                        <li><a href="blog_read.php">Manage Blog</a></li>
                        <li><a href="add_image.php">Add Image</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php">Back <?php echo $_SESSION['admin_name']; ?></a></li>
                        <li><a href="?logout=logout">Logout</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 style="text-align: center"><?php echo $massage; ?></h3>
                    <hr/>
                    <div class="well">
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Select Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="blog_image" multiple accept="image/*"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="btn" class="btn btn-success btn-block btn-lg">Save Image Information</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <?php while ($image_info = mysqli_fetch_assoc($query_result)) { ?>
                    <div class="col-md-3">
                        <div class="well">
                            <img src="<?php echo $image_info['image']; ?>" alt=""  class="img-responsive" />
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>





        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>