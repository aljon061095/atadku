<?php
require_once "includes/config.php";

$store_sql = "SELECT * FROM user_list WHERE (user_type = 'owner') && is_deleted = 0 ORDER BY full_name ASC";
$result = mysqli_query($link, $store_sql);
$stores = $result->fetch_all(MYSQLI_ASSOC);

if (isset($_POST["ExportType"])) {
    if (isset($_POST['from_date']) && isset($_POST['to_date'])) {
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];

        $query = "SELECT * FROM store where date_created between '".$from_date."' 
            and '".$to_date."' ORDER BY id asc";
        $result = mysqli_query($link, $query);
        $stores = $result->fetch_all(MYSQLI_ASSOC);
    } 
    
    $filename = "Store" . ".xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    ExportFile($stores);
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

    $query = "INSERT INTO user_list(full_name, profile, owner_name, email_address, tin, address, username, password, status)
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
                            <h4><i class="mdi mdi-home"></i> Stores</h4>
                            <div class="col-md-12 float-right mb-4">
                                <div class="btn-group pull-right">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#addStoreModal" class="btn fs-22 py-1 btn-success">Add Store</a>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#exportModal" class="btn fs-22 py-1 ml-2 btn-primary">
                                        <i class="mdi mdi-download"></i>
                                        Export
                                    </a>
                                </div>
                            </div>
                        </div>
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

                <div class="row blocked-message hidden">
                    <div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        The store has been blocked or suspended.
                    </div>
                </div>
                <div class="row forgot-password-message hidden">
                    <div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        The store successfully updated password.
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
                                            <?php foreach ($stores as $store) {
                                                $logo = $store['profile'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $store['full_name']; ?></td>
                                                    <td><img class="img-fluid" src=<?php echo "../uploads/$logo" ?> alt=""></td>
                                                    <td><?php echo $store['owner_name']; ?></td>
                                                    <td><?php echo $store['tin']; ?></td>
                                                    <td><?php echo $store['address']; ?></td>
                                                    <td>
                                                        <?php if ($store['is_blocked'] == 1) { ?>
                                                            <span class="badge light badge-danger">
                                                                <i class="fa fa-circle text-danger mr-1"></i>
                                                                blocked
                                                            </span>
                                                        <?php } else { ?>
                                                            <span class="badge light badge-success">
                                                                <i class="fa fa-circle text-success mr-1"></i>
                                                                active
                                                            </span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <button type="button" class="btn btn-primary shadow btn-xs sharp mr-1 p-0"><i class="mdi mdi-pencil" data-toggle="modal" data-target="#update_store_modal<?php echo $store['id'] ?>"></i></button>
                                                            <?php if ($store['is_blocked'] == 1) { ?>
                                                                <button type="button" class="btn btn-success shadow btn-xs sharp p-0 mr-1 block" data-id="<?php echo $store['id']; ?>" title="Activated" data-action-name="activated" data-table-name="user_list"><i class="mdi mdi-check"></i></button>
                                                            <?php } else { ?>
                                                                <button type="button" class="btn btn-warning shadow btn-xs sharp p-0 mr-1 block" data-id="<?php echo $store['id']; ?>" title="Block" data-action-name="block" data-table-name="user_list"><i class="mdi mdi-block-helper"></i></button>
                                                            <?php } ?>
                                                            <button type="button" class="btn btn-warning shadow btn-xs sharp forgot-password mr-1" title="Forgot Password" data-email-address="<?php echo $store['email_address']; ?>" data-id="<?php echo $store['id']; ?>" data-table-name="user_list"><i class="mdi mdi-account-settings-variant"></i></button>
                                                            <button type="button" class="btn btn-danger shadow btn-xs sharp p-0 delete" data-id="<?php echo $store['id']; ?>" title="Delete" data-table-name="user_list"><i class="mdi mdi-eraser"></i></button>
                                                        </div>
                                                    </td>
                                                    <?php include 'update-store.php'; ?>
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
                                <label for="restaurant">Store Name</label>
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
                                <input type="text" class="form-control" name="email_address" id="email_address" placeholder="Owner Name" required>
                                <label for="owner_name">Email Address</label>
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

            // Forgot Password 
            $('.forgot-password').click(function() {
                var el = this;

                var Id = $(this).data('id');
                var emailAddress = $(this).data('email-address');

                var confirmalert = confirm("Are you sure you want to forgot the password?");
                if (confirmalert == true) {
                    // AJAX Request
                    $.ajax({
                        url: 'forgot_password.php',
                        type: 'POST',
                        data: {
                            id: Id,
                            emailAddress: emailAddress
                        },
                        success: function(response) {
                            if (response == 1) {
                                $('.forgot-password-message').removeClass('hidden');
                            }

                        }
                    });
                }

            });

        });

        $(document).ready(function() {
            // Block 
            $('.block').click(function() {
                var el = this;

                var deleteId = $(this).data('id');
                var actionName = $(this).data('action-name');
                var tableName = $(this).data('table-name');

                var confirmalert = confirm("Are you sure you want to block this store?");
                if (confirmalert == true) {
                    // AJAX Request
                    $.ajax({
                        url: 'block.php',
                        type: 'POST',
                        data: {
                            id: deleteId,
                            tableName: tableName,
                            actionName: actionName
                        },
                        success: function(response) {
                            if (response == 1) {
                                // Remove row from HTML Table
                                $('.blocked-message').removeClass('hidden');
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