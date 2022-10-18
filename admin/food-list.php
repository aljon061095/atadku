<?php 
    require_once "includes/config.php";

    $food_list_sql = "SELECT * FROM food_list";
    $result = mysqli_query($link, $food_list_sql);
    $food_list = $result->fetch_all(MYSQLI_ASSOC);

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
                            <h4><i class="mdi mdi-food"></i> List of Foods</h4>
                        </div>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#addFoodModal" class="btn fs-22 py-1 btn-success">Add Food</a>
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
                                                <th>Restaurant</th>
                                                <th>Food Name</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($food_list as $food) { ?>
                                                <tr>
                                                    <td><?php echo $food['restaurant']; ?></td>
                                                    <td><?php echo $food['food_name']; ?></td>
                                                    <td><?php echo $food['price']; ?></td>
                                                    <td><img class="img-fluid" src="../images/tab/1.jpg" alt="" width="50"></td>
                                                    <td><?php echo $food['description']; ?></td>
                                                    <td>
                                                        <span class="badge light badge-danger">
                                                            <i class="fa fa-circle text-danger mr-1"></i>
                                                            not available
                                                        </span></td>
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

    <?php include 'includes/footer.php'?>

</body>

</html>