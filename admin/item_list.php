<?php
require_once "includes/config.php";

$item_list_sql = "SELECT * FROM item_list";
$result = mysqli_query($link, $item_list_sql);
$item_list = $result->fetch_all(MYSQLI_ASSOC);

//adding food
if (isset($_POST['save_item'])) {
    $store = $_POST['store'];
    $item_name = $_POST['item_name'];
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

    $query = "INSERT INTO item_list(store, item_name price, images, description, status)
            VALUES ('$store', '$item_name', '$price', '$images', '$number', '$description', '$status')";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $item_id = $link->insert_id;
        $query = "INSERT INTO images(item_id, file_name) VALUES ('$item_id', '$images')";
        $query_run = mysqli_query($link, $query);
        $_SESSION['success_status'] = "You have successfully added a new item in the list of product.";
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
                            <h4><i class="mdi mdi-gift"></i> List of Items</h4>
                        </div>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#addStoreModal" class="btn fs-22 py-1 btn-success">Add Item</a>
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
                                                <th>Item Name</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($item_list as $item) {
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
                                                        <?php if ($item['status'] != 1) { ?>
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
                                                            <button class="btn btn-primary shadow btn-xs sharp mr-1 p-0" data-toggle="modal" type="button" data-target="#update_item_modal<?php echo $item['id'] ?>">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </button>
                                                            <button class="btn btn-danger shadow btn-xs sharp p-0" data-toggle="modal" type="button" data-target="#update_item_modal<?php echo $item['id'] ?>">
                                                                <i class="mdi mdi-eraser"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <?php include 'update_item.php'; ?>
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

    <!-- Food List -->
    <div class="modal fade" id="addStoreModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Item</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="store" id="store" placeholder="Store Name">
                                <label for="store">Store</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Item Name">
                                <label for="item_name">Item Name</label>
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
                        <button type="submit" name="save_item" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php' ?>

</body>

</html>