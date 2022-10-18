<?php 
    require_once "includes/config.php";

    $admin_user_sql = "SELECT * FROM admin_user";
    $result = mysqli_query($link, $admin_user_sql);
    $admin_users = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<link href="../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
<?php include 'includes/header.php'?>
    <!-- Datatable -->
<body>

    <?php include 'includes/preloader.php'?>

    <div id="main-wrapper">

        <?php include 'includes/topbar.php'?>
        <?php include 'includes/sidebar.php'?>

        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4><i class="mdi mdi-truck-delivery"></i> Admin Users</h4>
                        </div>
                    </div>
                </div>
                <!-- row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Profile</th>
                                                <th>Full Name</th>
                                                <th>Address</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($admin_users as $admin) {?>
                                                <tr>
                                                    <td>
                                                        <img class="img-fluid" src="../images/avatar/3.jpg" alt="" width="50">
                                                    </td>
                                                    <td><?php echo $admin['full_name']; ?></td>
                                                    <td><?php echo $admin['address']; ?></td>
                                                    <td><?php echo $admin['email_address']; ?></td>
                                                    <td>
                                                        <span class="badge light badge-success">
                                                            <i class="fa fa-circle text-success mr-1"></i>
                                                            active
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php  } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'?>

</body>

</html>