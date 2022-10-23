<?php 
    require_once "includes/config.php";

    $driver_sql = "SELECT * FROM driver";
    $result = mysqli_query($link, $driver_sql);
    $drivers = $result->fetch_all(MYSQLI_ASSOC);

    //adding driver
    if (isset($_POST['save_driver'])) {
        $profile = strtotime(date('y-m-d H:i')) . '_' . $_POST['full_name'];
        $full_name = $_POST['full_name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $valid_id = strtotime(date('y-m-d H:i')) . '_' . $_POST['full_name'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $status = 1;

        if (array_key_exists('profile', $_FILES)) {
            if ($_FILES['profile']['tmp_name'] != '') {
                $filename = strtotime(date('y-m-d H:i')) . '_' . basename($_FILES['profile']['name']);
                $move = move_uploaded_file($_FILES['profile']['tmp_name'], '../uploads' . $filename);

                if ($move) {
                    $profile = $filename;
                }
            }
        }

        if (array_key_exists('valid_id', $_FILES)) {
            if ($_FILES['valid_id']['tmp_name'] != '') {
                $filename = strtotime(date('y-m-d H:i')) . '_' . basename($_FILES['valid_id']['name']);
                $move = move_uploaded_file($_FILES['valid_id']['tmp_name'], '../uploads' . $filename);

                if ($move) {
                    $valid_id = $filename;
                }
            }
        }
    
        $query = "INSERT INTO driver(profile, full_name, address, valid_id, number, email_address, username, password, status)
            VALUES ('$profile', '$full_name', '$address', '$valid_id', '$number', '$email', '$username', '$password', '$status')";
        $query_run = mysqli_query($link, $query);
        
        if ($query_run) { 
            $item_id = $link->insert_id;
            $query = "INSERT INTO images(item_id, file_name) VALUES ('$item_id', '$profile')";
            $query_run = mysqli_query($link, $query);
            $_SESSION['success_status'] = "You have successfully added a new driver.";
        }
    }
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
                            <h4><i class="mdi mdi-truck-delivery"></i> Delivery Driver</h4>
                        </div>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#addDriverModal" class="btn fs-22 py-1 btn-success">Add Driver</a>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <?php
                        if (isset($_SESSION['success_status'])) {
                        ?>
                            <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <?php echo $_SESSION['success_status']; ?>
                            </div>
                        <?php
                            unset($_SESSION['success_status']);
                        }
                    ?>
                </div>
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
                                                <th>Contact Number</th>
                                                <th>License</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($drivers as $driver) {
                                                    $image = $driver['profile'];
                                                ?>
                                                <tr>
                                                    <td><img class="img-fluid" src=<?php echo "../uploads/$image" ?> alt="" width="50"></td>
                                                    <td><?php echo $driver['full_name']; ?></td>
                                                    <td><?php echo $driver['address']; ?></td>
                                                    <td><?php echo $driver['email_address']; ?></td>
                                                    <td><?php echo $driver['number']; ?></td>
                                                    <td><?php echo $driver['valid_id']; ?></td>
                                                    <td>
                                                        <span class="badge light badge-success">
                                                            <i class="fa fa-circle text-success mr-1"></i>
                                                            active
                                                        </span></td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="mdi mdi-pencil"></i></a>
                                                            <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="mdi mdi-eraser"></i></a>
                                                        </div>												
                                                    </td>
                                                </tr>
                                            <?php } ?>
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

    <!-- Driver -->
    <div class="modal fade" id="addDriverModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Driver</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-floating mb-2">
                            <input type="file" class="form-control" name="profile" id="profile" placeholder="Profile">
                            <label for="image">Profile</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name">
                            <label for="restaurant">Full Name</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                            <label for="address">Address</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-floating mb-2">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
                            <label for="email">Email Address</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-floating mb-2">
                            <input type="number" class="form-control" name="number" id="number" placeholder="Contact Number">
                            <label for="number">Contact Number</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-floating mb-2">
                            <input type="file" class="form-control" name="valid_id" id="valid_id" placeholder="Valid Identification">
                            <label for="valid_id">Valid Identification</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                            <label for="username">Username</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-floating mb-2">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            <label for="password">Password</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="save_driver" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'?>

</body>

</html>