<?php
require_once "includes/config.php";

session_start();
$store_id = $_SESSION["id"];

$product_list_sql = "SELECT * FROM product_list WHERE store_id = $store_id";
$result = mysqli_query($link, $product_list_sql);
$product_list = $result->fetch_all(MYSQLI_ASSOC);

if (isset($_POST["ExportType"])) {
    if (isset($_POST['from_date']) && isset($_POST['to_date'])) {
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];

        $query = "SELECT * FROM product_list where store_id = $store_id && date_added between '" . $from_date . "' 
        and '" . $to_date . "' ORDER BY id asc";
        $result = mysqli_query($link, $query);
        $product_list = $result->fetch_all(MYSQLI_ASSOC);
    }

    $filename = "Product" . ".xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    ExportFile($product_list);
    exit();
}

function ExportFile($records) {
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

//adding food
if (isset($_POST['save_product'])) {
    $store_id = $store_id;
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $images = strtotime(date('y-m-d H:i')) . '_' . $_POST['product_name'];
    $description = $_POST['description'];
    $status = 1;

    if (array_key_exists('image', $_FILES)) {
        if ($_FILES['image']['tmp_name'] != '') {
            $filename = 'food' . '_' . strtotime(date('y-m-d H:i')) . '_' . basename($_FILES['image']['name']);
            $move = move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $filename);

            if ($move) {
                $images = $filename;
            }
        }
    }

    $query = "INSERT INTO product_list(store_id, product_name, price, images, description, status)
            VALUES ('$store_id', '$product_name', '$price', '$images', '$description', '$status')";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $item_id = $link->insert_id;
        $query = "INSERT INTO images(item_id, file_name) VALUES ('$item_id', '$images')";
        $query_run = mysqli_query($link, $query);
        $_SESSION['success_status'] = "You have successfully added a new food in the list of menu.";
        header("location: food_list.php");
    }
}

//update
if (isset($_POST['update_product'])) {
    $restaurant = $restaurant_id;
    $product_id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $query = "UPDATE `product_name` SET `product_name` = '$product_name', `price` = '$price',
     `description` = '$description', `status` = '$status' WHERE store_id = $store_id and id = $product_id";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $_SESSION['success_status'] = "You have successfully updated the product name information in the menu.";
        header("location: product_list.php");
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
                            <h4><i class="mdi mdi-gift"></i> List of Product</h4>
                            <div class="col-md-12 float-right mb-4">
                                <div class="btn-group pull-right">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#addFoodModal" class="btn fs-22 py-1 btn-success">Add Product</a>
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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th class="text-center">Image</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($product_list as $product) {
                                                $image = $product['images'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $product['product_name']; ?></td>
                                                    <td><?php echo number_format((float)$product['price'], 2, '.', ''); ?></td>
                                                    <td><img class="img-fluid" src=<?php echo "../uploads/$image" ?> alt=""></td>
                                                    <td><?php echo $product['description']; ?></td>
                                                    <td>
                                                        <?php if ($product['status'] != 1) { ?>
                                                            <span class="badge light badge-danger">
                                                                <i class="fa fa-circle text-danger mr-1"></i>
                                                                not available
                                                            </span>
                                                        <?php } else { ?>
                                                            <span class="badge light badge-success">
                                                                <i class="fa fa-circle text-success mr-1"></i>
                                                                available
                                                            </span>
                                                    </td>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary" data-toggle="modal" type="button" data-target="#update_product_modal<?php echo $product['id'] ?>">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                </td>
                                                <?php include 'update_product.php'; ?>
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

    <!-- Food List -->
    <div class="modal fade" id="addFoodModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Product</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Food Name">
                                <label for="product_name">Product Name</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" name="price" id="price" placeholder="Price">
                                <label for="price">Price</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <input type="file" class="form-control" name="image" id="image" placeholder="Imgae">
                                <label for="image">Image</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <textarea class="form-control" rows="4" placeholder="Description" name="description" id="description"></textarea>
                                <label for="description">Description</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="save_product" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'export_modal.php' ?>
    <?php include 'includes/feedbacks.php' ?>
    <?php include 'includes/footer.php' ?>

</body>

</html>

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