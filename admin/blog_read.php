
<?php
session_start();
$message = '';
require_once '../class/blog.php';
$blog = new Blog();

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $message = $blog->delete_blog_info($id);
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

$query_result = $blog->select_all_blog_info();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>View Customer Info</title>
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
                    <h3 style="text-align: center"><?php echo $message; ?></h3>
                    <hr/>
                    <div class="well">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>Blog ID</th>
                                <th>Blog Title</th>
                                <th>Author Name</th>
                                <th>Blog Description</th>
                                <th>Publication Status</th>
                                <th>Action</th>
                            </tr>
                            <?php while ($blog_info = mysqli_fetch_assoc($query_result)) { ?>
                                <tr>
                                    <td><?php echo $blog_info['blog_id']; ?></td>
                                    <td><?php echo $blog_info['blog_title']; ?></td>
                                    <td><?php echo $blog_info['author_name']; ?></td>
                                    <td><?php echo $blog_info['blog_description']; ?></td>
                                    <td><?php 
                                        if( $blog_info['publication_status'] == 1) {
                                            echo 'Published';
                                        }  else {    echo 'Unpublished'; }
                                    ?></td>
                                    <td>
                                        <a href="blog_update.php?id=<?php echo $blog_info['blog_id']; ?>" class="btn btn-success" title="Edit">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        <a href="?delete=<?php echo $blog_info['blog_id']; ?>" class="btn btn-danger" title="Delete" onclick="return confirm('Are Yoy Sure To Delete This!');">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>

        </div>


        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>