<?php 
    require_once "includes/config.php";

    $store_sql = "SELECT * FROM store";
    $result = mysqli_query($link, $store_sql);
    $stores = $result->fetch_all(MYSQLI_ASSOC);

    //adding restaurant
    if (isset($_POST['save_store'])) {
        $name = $_POST['name'];
        $logo = strtotime(date('y-m-d H:i')) . '_' . $_POST['name'];
        $owner_name = $_POST['owner_name'];
        $tin = $_POST['tin'];
        $address = $_POST['address'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $status = 1;

        if (array_key_exists('logo', $_FILES)) {
            if ($_FILES['logo']['tmp_name'] != '') {
                $filename = strtotime(date('y-m-d H:i')) . '_' . basename($_FILES['logo']['name']);
                $move = move_uploaded_file($_FILES['logo']['tmp_name'], '../uploads' . $filename);

                if ($move) {
                    $logo = $filename;
                }
            }
        }
        
        $query = "INSERT INTO store(name, logo, owner_name, tin, address, username, password, status)
            VALUES ('$name', '$logo', '$owner_name', '$tin', '$address', '$username', '$password', '$status')";
        $query_run = mysqli_query($link, $query);
        
        if ($query_run) { 
            $item_id = $link->insert_id;
            $query = "INSERT INTO images(item_id, file_name) VALUES ('$item_id', '$logo')";
            $query_run = mysqli_query($link, $query);
            $_SESSION['success_status'] = "You have successfully added a new restaurant";
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
                            <h4><i class="mdi mdi-home"></i> Store</h4>
                        </div>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#addStoreModal" class="btn fs-22 py-1 btn-success">Add Store</a>
                    </div>
                </div>
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
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Store</th>
                                                <th>Logo</th>
                                                <th>Owner Name</th>
                                                <th>TIN</th>
                                                <th>Address</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($stores as $store) { 
                                                 $logo = $store['logo'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $store['name']; ?></td>
                                                    <td><img class="img-fluid" src=<?php echo "../uploads/$logo"?> alt=""></td>
                                                    <td><?php echo $store['owner_name']; ?></td>
                                                    <td><?php echo $store['tin']; ?></td>
                                                    <td><?php echo $store['address']; ?></td>
                                                    <td>
                                                        <span class="badge light badge-success">
                                                            <i class="fa fa-circle text-success mr-1"></i>
                                                            active
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1 p-0"><i class="mdi mdi-pencil"></i></a>
                                                            <a href="#" class="btn btn-danger shadow btn-xs sharp p-0"><i class="mdi mdi-eraser"></i></a>
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

    <!-- Add Restaurant -->
    <div class="modal fade" id="addStoreModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Store</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="name" id="restaurant" placeholder="Restaurant Name" required>
                            <label for="restaurant">Restaurant Name</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-floating mb-2">
                            <input type="file" class="form-control" name="logo" id="logo" placeholder="Logo" required>
                            <label for="logo">Logo</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="owner_name" id="owner_name" placeholder="Owner Name" required>
                            <label for="owner_name">Owner Name</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-floating mb-2">
                            <input type="number" class="form-control" name="tin" id="tin" placeholder="TIN" required>
                            <label for="tin">TIN</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="address" id="address" placeholder="Address" required>
                            <label for="address">Address</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                            <label for="username">Username</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-floating mb-2">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            <label for="password">Password</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="save_restaurant" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'?>

</body>

</html>