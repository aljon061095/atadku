<?php
require_once "includes/config.php";

session_start();
$restaurant_id = $_SESSION["id"];

$food_list_sql = "SELECT * FROM food_list WHERE restaurant_id = $restaurant_id";
$result = mysqli_query($link, $food_list_sql);
$food_list = $result->fetch_all(MYSQLI_ASSOC);

//adding food
if (isset($_POST['save_food'])) {
    $restaurant = $restaurant_id;
    $food_name = $_POST['food_name'];
    $price = $_POST['price'];
    $images = strtotime(date('y-m-d H:i')) . '_' . $_POST['food_name'];
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

    $query = "INSERT INTO food_list(restaurant_id, food_name, price, images, description, status)
            VALUES ('$restaurant_id', '$food_name', '$price', '$images', '$description', '$status')";
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
if (isset($_POST['update_food'])) {
    $restaurant = $restaurant_id;
    $food_id = $_POST['id'];
    $food_name = $_POST['food_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $query = "UPDATE `food_list` SET `food_name` = '$food_name', `price` = '$price',
     `description` = '$description', `status` = '$status' WHERE restaurant_id = $restaurant_id and id = $food_id";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $_SESSION['success_status'] = "You have successfully updated the food information in the menu.";
        header("location: food_list.php");
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
                            <h4><i class="mdi mdi-food"></i> List of Foods</h4>
                            <!-- <pre>
                                <?php
                                print_r($food_list);
                                ?>
                            </pre> -->
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#addFoodModal" class="btn fs-22 py-1 btn-success">Add Food</a>
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
                                                <th>Food Name</th>
                                                <th>Price</th>
                                                <th class="text-center">Image</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($food_list as $food) {
                                                $image = $food['images'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $food['food_name']; ?></td>
                                                    <td><?php echo number_format((float)$food['price'], 2, '.', ''); ?></td>
                                                    <td><img class="img-fluid" src=<?php echo "../uploads/$image" ?> alt=""></td>
                                                    <td><?php echo $food['description']; ?></td>
                                                    <td>
                                                        <?php if ($food['status'] != 1) { ?>
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
                                                    <button class="btn btn-primary" data-toggle="modal" type="button" data-target="#update_food_modal<?php echo $food['id'] ?>">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                </td>
                                                <?php include 'update_food.php'; ?>
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
                    <h3 class="modal-title">Add Food</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
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
                                <textarea class="form-control" rows="4" placeholder="Description" name="description" id="description"></textarea>
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

    <?php include 'includes/feedbacks.php' ?>
    <?php include 'includes/footer.php' ?>

</body>

</html>