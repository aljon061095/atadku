<?php
require_once "includes/config.php";

$store_sql = "SELECT * FROM user_list WHERE (user_type = 'restaurant' || user_type = 'store') && is_deleted = 1";
$result = mysqli_query($link, $store_sql);
$stores = $result->fetch_all(MYSQLI_ASSOC);

$product_list_sql = "SELECT * FROM product_list WHERE is_deleted = 1";
$result = mysqli_query($link, $product_list_sql);
$product_list = $result->fetch_all(MYSQLI_ASSOC);

$pickup_sql = "SELECT * FROM pickup WHERE is_deleted = 1";
$result = mysqli_query($link, $pickup_sql);
$pickup_list = $result->fetch_all(MYSQLI_ASSOC);

$order_sql = "SELECT * FROM orders WHERE is_deleted = 1";
$result = mysqli_query($link, $order_sql);
$order_list = $result->fetch_all(MYSQLI_ASSOC);

$customer_sql = "SELECT * FROM customer WHERE is_deleted = 1";
$result = mysqli_query($link, $customer_sql);
$customers = $result->fetch_all(MYSQLI_ASSOC);

$driver_sql = "SELECT * FROM driver WHERE is_deleted = 1";
$result = mysqli_query($link, $driver_sql);
$drivers = $result->fetch_all(MYSQLI_ASSOC);

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
                            <h4><i class="mdi mdi-archive"></i> Archives</h4>
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
                <!-- row -->
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a href="#store_tab" data-toggle="tab" class="nav-link active show">Stores</a>
                    </li>
                    <li class="nav-item"><a href="#product_list_tab" data-toggle="tab" class="nav-link">Product List</a>
                    </li>
                    <li class="nav-item"><a href="#pickup_list_tab" data-toggle="tab" class="nav-link">Pickup List</a>
                    </li>
                    <li class="nav-item"><a href="#order_list_tab" data-toggle="tab" class="nav-link">Order List</a>
                    </li>
                    <li class="nav-item"><a href="#customer_list_tab" data-toggle="tab" class="nav-link">Customer List</a>
                    </li>
                    <li class="nav-item"><a href="#driver_tab" data-toggle="tab" class="nav-link">Delivery Driver</a>
                    </li>
                </ul>
                <div class="tab-content mt-4">
                    <div id="store_tab" class="tab-pane fade active show">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="store_table" class="display" style="min-width: 845px">
                                                <thead>
                                                    <tr>
                                                        <th>Store</th>
                                                        <th>Logo</th>
                                                        <th>Owner Name</th>
                                                        <th>TIN</th>
                                                        <th>Address</th>
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
                                                                <div class="d-flex">
                                                                    <button type="button" class="btn btn-success restore" data-id="<?php echo $store['id']; ?>" title="Restore" data-table-name="store">Restore</button>
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
                    <div id="product_list_tab" class="tab-pane fade">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="item_list_table" class="display" style="min-width: 845px">
                                                <thead>
                                                    <tr>
                                                        <th>Store</th>
                                                        <th>Item Name</th>
                                                        <th>Price</th>
                                                        <th>Image</th>
                                                        <th>Description</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($product_list as $item) {
                                                        $image = $item['images'];
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?php
                                                                $store_id = $item['store_id'];
                                                                $result = mysqli_query($link, "SELECT *
                                                                FROM store WHERE id = $store_id");
                                                                $row = mysqli_fetch_array($result);
                                                                ?>
                                                                <?php echo $row['name']; ?>
                                                            </td>
                                                            <td><?php echo $item['item_name']; ?></td>
                                                            <td><?php echo number_format((float)$item['price'], 2, '.', ''); ?></td>
                                                            <td><img class="img-fluid" src=<?php echo "../uploads/$image" ?> alt=""></td>
                                                            <td><?php echo $item['description']; ?></td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <button type="button" class="btn btn-success restore" data-id="<?php echo $item['id']; ?>" title="Restore" data-table-name="item_list">Restore</button>
                                                                </div>
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
                    <div id="pickup_list_tab" class="tab-pane fade">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="pickup_list_table" class="display" style="min-width: 845px">
                                                <thead>
                                                    <tr>
                                                        <th>Pickup Code</th>
                                                        <th>Sender's Name</th>
                                                        <th>Sender's Number</th>
                                                        <th>Sender's Address</th>
                                                        <th>Item Details</th>
                                                        <th>Notes</th>
                                                        <th>Recipient's Name</th>
                                                        <th>Recipient's Number</th>
                                                        <th>Recipient's Address</th>
                                                        <th>Message</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($pickup_list as $pickup) { ?>
                                                        <tr>
                                                            <td>
                                                                <a href="pickup_info.php?pickup_id=<?php echo $pickup['id']; ?>">
                                                                    <?php echo $pickup['pickup_code']; ?>
                                                                </a>
                                                            </td>
                                                            <td><?php echo $pickup['sender_name']; ?></td>
                                                            <td><?php echo $pickup['sender_number']; ?></td>
                                                            <td><?php echo $pickup['sender_address']; ?></td>
                                                            <td><?php echo $pickup['item_details']; ?></td>
                                                            <td><?php echo $pickup['notes']; ?></td>
                                                            <td><?php echo $pickup['recipient_name']; ?></td>
                                                            <td><?php echo $pickup['recipient_number']; ?></td>
                                                            <td><?php echo $pickup['recipient_address']; ?></td>
                                                            <td><?php echo $pickup['message']; ?></td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <button type="button" class="btn btn-success restore" data-id="<?php echo $pickup['id']; ?>" title="Restore" data-table-name="pickup_list">Restore</button>
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
                    <div id="order_list_tab" class="tab-pane fade">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="order_list_table" class="display" style="min-width: 845px">
                                                <thead>
                                                    <tr>
                                                        <th>Order Code</th>
                                                        <th>Customer</th>
                                                        <th>Item or Food</th>
                                                        <th>Delivery Charge</th>
                                                        <th>Order Details</th>
                                                        <th>Total Amount</th>
                                                        <th>Driver</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($order_list as $order) { ?>
                                                        <tr>
                                                            <td>
                                                                <a href="order_info.php?order_id=<?php echo $order['id']; ?>">
                                                                    <?php echo $order['order_id']; ?>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $customer_id = $order['customer_id'];;
                                                                $result = mysqli_query($link, "SELECT *
                                                                FROM customer WHERE id = $customer_id");
                                                                $row = mysqli_fetch_array($result);
                                                                ?>
                                                                <?php echo $row['full_name']; ?>
                                                            </td>
                                                            <td><?php echo $order['name']; ?></td>
                                                            <td>49.00</td>
                                                            <td><?php echo date('m-d-Y H:i A', strtotime($order['order_date'])); ?></td>
                                                            <td><?php echo number_format($order['total'] > 0 ? $order['total'] : 0  + 49, 2); ?></td>
                                                            <td>
                                                                <?php
                                                                $driver_id = $order['driver_id'];
                                                                $result = mysqli_query($link, "SELECT *
                                                                    FROM driver WHERE id = $driver_id");
                                                                $driver = mysqli_fetch_array($result);
                                                                ?>
                                                                <?php echo $driver != null ? $driver['full_name']  : "No assigned driver yet."; ?>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <button type="button" class="btn btn-success restore" data-id="<?php echo $order['id']; ?>" title="Restore" data-table-name="food_list">Restore</button>
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
                    <div id="customer_list_tab" class="tab-pane fade">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="customer_list_table" class="display" style="min-width: 845px">
                                                <thead>
                                                    <tr>
                                                        <th>Profile</th>
                                                        <th>Full Name</th>
                                                        <th>Address</th>
                                                        <th>Email Address</th>
                                                        <th>Username</th>
                                                        <th>Valid Id</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($customers as $customer) {
                                                        $image = $customer['profile'];
                                                    ?>
                                                        <tr>
                                                            <td><img class="img-fluid" src=<?php echo "../uploads/$image" ?> alt="" width="50"></td>
                                                            <td><?php echo $customer['full_name']; ?></td>
                                                            <td><?php echo $customer['address']; ?></td>
                                                            <td><?php echo $customer['email_address']; ?></td>
                                                            <td><?php echo $customer['username']; ?></td>
                                                            <td><?php echo $customer['valid_id']; ?></td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <button type="button" class="btn btn-success restore" data-id="<?php echo $customer['id']; ?>" title="Restore" data-table-name="customer">Restore</button>
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
                    <div id="driver_tab" class="tab-pane fade">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="driver_table" class="display" style="min-width: 845px">
                                                <thead>
                                                    <tr>
                                                        <th>Profile</th>
                                                        <th>Full Name</th>
                                                        <th>Address</th>
                                                        <th>Email</th>
                                                        <th>Contact Number</th>
                                                        <th>Valid Id</th>
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
                                                                <div class="d-flex">
                                                                    <button type="button" class="btn btn-success restore" data-id="<?php echo $driver['id']; ?>" title="Restore" data-table-name="driver">Restore</button>
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
            (function($) {
                "use strict"
                $('#restaurant_table, #store_table, #item_list_table, #pickup_list_table, #order_list_table, #food_list_table, #customer_list_table, #driver_table').DataTable();
            })(jQuery);
        </script>

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

            $(document).ready(function() {
                // Delete 
                $('.block').click(function() {
                    var el = this;

                    var deleteId = $(this).data('id');
                    var tableName = $(this).data('table-name');

                    var confirmalert = confirm("Are you sure you want to block this store?");
                    if (confirmalert == true) {
                        // AJAX Request
                        $.ajax({
                            url: 'block.php',
                            type: 'POST',
                            data: {
                                id: deleteId,
                                tableName: tableName
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