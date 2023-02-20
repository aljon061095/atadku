<?php
require_once "includes/config.php";

$product_list_sql = "SELECT * FROM product_list";
$result = mysqli_query($link, $product_list_sql);
$product_list = $result->fetch_all(MYSQLI_ASSOC);

if (isset($_POST["ExportType"])) {
    if (isset($_POST['from_date']) && isset($_POST['to_date'])) {
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];

        $query = "SELECT * FROM product_list where date_added between '" . $from_date . "' 
            and '" . $to_date . "' ORDER BY id asc";
        $result = mysqli_query($link, $query);
        $product_list = $result->fetch_all(MYSQLI_ASSOC);
    }

    $filename = "Product_List" . ".xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    ExportFile($product_list);
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

//adding food
if (isset($_POST['save_food'])) {
    $restaurant = $_POST['restaurant'];
    $food_name = $_POST['food_name'];
    $price = $_POST['price'];
    $images = strtotime(date('y-m-d H:i')) . '_' . $_POST['name'];
    $description = $_POST['description'];
    $status = 1;

    if (array_key_exists('image', $_FILES)) {
        if ($_FILES['image']['tmp_name'] != '') {
            $filename = strtotime(date('y-m-d H:i')) . '_' . basename($_FILES['image']['name']);
            $move = move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/food_list' . $filename);

            if ($move) {
                $images = $filename;
            }
        }
    }

    $query = "INSERT INTO food_list(restaurant, food_name price, images, description, status)
            VALUES ('$restaurant', '$food_name', '$price', '$images', '$number', '$description', '$status')";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $item_id = $link->insert_id;
        $query = "INSERT INTO images(item_id, file_name) VALUES ('$item_id', '$images')";
        $query_run = mysqli_query($link, $query);
        $_SESSION['success_status'] = "You have successfully added a new food in the list of menu.";
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
                            <h4><i class="mdi mdi-gift"></i> List of Products</h4>
                            <div class="col-md-12 float-right mb-4">
                                <div class="btn-group pull-right">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#addFoodModal" class="btn fs-22 py-1 btn-success">Add Food</a>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Store</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($product_list as $product) {
                                                $image = $product['images'];
                                            ?>
                                                <?php
                                                    $store_id = $product['store_id'];
                                                    $result = mysqli_query($link, "SELECT *
                                                            FROM user_list WHERE id = $store_id");
                                                    $row = mysqli_fetch_array($result);
                                                    ?>
                                                <?php if ($row != "") { ?>
                                                    <tr> 
                                                        <td>
                                                            <?php echo $row['full_name']; ?>
                                                        </td>
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
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <button class="btn btn-primary shadow btn-xs sharp mr-1 p-0" data-toggle="modal" type="button" data-target="#update_food_modal<?php echo $product['id'] ?>">
                                                                    <i class="mdi mdi-pencil"></i>
                                                                </button>
                                                                <button class="btn btn-danger shadow btn-xs sharp mr-1 p-0 delete" data-id="<?php echo $product['id']; ?>" data-table-name="product_list">
                                                                    <i class="mdi mdi-eraser"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                        <?php include 'update_food.php'; ?>
                                                    </tr>
                                                <?php  
                                                }
                                            } ?>
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
                    <h3 class="modal-title">Add Food</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="restaurant" id="restaurant" placeholder="Restaurant Name">
                                <label for="restaurant">Restaurant</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="food_name" id="food_name" placeholder="Food Name">
                                <label for="food_name">Food Name</label>
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
                                <textarea class="form-control" placeholder="Description" name="description" id="description"></textarea>
                                <label for="description">Description</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="save_food" class="btn btn-primary">Save changes</button>
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