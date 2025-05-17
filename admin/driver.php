<?php
require_once "includes/config.php";

$driver_sql = "SELECT * FROM driver";
$result = mysqli_query($link, $driver_sql);
$drivers = $result->fetch_all(MYSQLI_ASSOC);

if (isset($_POST["ExportType"])) {
    if (isset($_POST['from_date']) && isset($_POST['to_date'])) {
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];

        $query = "SELECT * FROM driver where date_created between '" . $from_date . "' 
            and '" . $to_date . "' ORDER BY id asc";
        $result = mysqli_query($link, $query);
        $drivers = $result->fetch_all(MYSQLI_ASSOC);
    }

    $filename = "Customers" . ".xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    ExportFile($drivers);
    exit();
}


function ExportFile($records)
{
    $heading = false;
    if (!empty($records))
        foreach ($records as $row) {
            if (!$heading) {
                // display field/column names as a first row
                echo implode("\t", array_keys($row)) . "\n";
                $heading = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
    exit;
}

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
<?php include 'includes/header.php' ?>
<!-- Datatable -->

<body>

    <?php include 'includes/preloader.php' ?>

    <div id="main-wrapper">

        <?php include 'includes/topbar.php' ?>
        <?php include 'includes/sidebar.php' ?>
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4><i class="mdi mdi-bike"></i> Delivery Driver</h4>
                            <div class="col-md-12 float-right mb-4">
                                <div class="btn-group pull-right">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#addDriverModal" class="btn fs-22 py-1 btn-success">Add Driver</a>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#exportModal" class="btn fs-22 py-1 ml-2 btn-primary">
                                        <i class="mdi mdi-download"></i>
                                        Export
                                    </a>
                                </div>
                            </div>
                        </div>
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
                                                <th>Valid Id</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($drivers as $driver) {
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
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="mdi mdi-pencil"></i></a>
                                                            <button type="button" class="btn btn-danger shadow btn-xs sharp delete" data-id="<?php echo $driver['id']; ?>" data-table-name="driver"><i class="mdi mdi-eraser"></i></button>
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
                                <input type="file" class="form-control" name="profile" id="profile" placeholder="Profile" required>
                                <label for="image">Profile</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name" required>
                                <label for="restaurant">Full Name</label>
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
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required>
                                <label for="email">Email Address</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" name="number" id="number" placeholder="Contact Number" required>
                                <label for="number">Contact Number</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <input type="file" class="form-control" name="valid_id" id="valid_id" placeholder="Valid Identification" required>
                                <label for="valid_id">Valid Identification</label>
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
                        <button type="submit" name="save_driver" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include 'export_modal.php' ?>
    <?php include 'includes/footer.php' ?>
    <script>
        $(document).ready(function() {
            // Delete 
            $('.delete').click(function() {
                var el = this;

                var deleteId = $(this).data('id');
                var tableName = $(this).data('table-name');

                var confirmalert = confirm("Are you sure you want to delete?");
                if (confirmalert == true) {
                    // AJAX Request
                    $.ajax({
                        url: 'remove.php',
                        type: 'POST',
                        data: {
                            id: deleteId,
                            tableName: tableName
                        },
                        success: function(response) {
                            if (response == 1) {
                                // Remove row from HTML Table
                                $(el).closest('tr').css('background', 'tomato');
                                $(el).closest('tr').fadeOut(800, function() {
                                    $(this).remove();
                                });

                                $('.deleted-message').removeClass('hidden');
                            }

                        }
                    });
                }

            });

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            jQuery('button').on("click", function() {
                var target = $(this).attr('id');
                switch (target) {
                    case 'export-to-excel':
                        $('#hidden-type').val(target);
                        //alert($('#hidden-type').val());
                        $('#export-form').submit();
                        $('#hidden-type').val('');
                        break;
                }
            });
        });
    </script>


</body>

</html>