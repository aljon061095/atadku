<?php
require_once "includes/config.php";

//Initialize the session
session_start();

$restaurant_id = $_GET['id'];
$food_list_sql = "SELECT * FROM food_list WHERE restaurant_id = $restaurant_id";
$result = mysqli_query($link, $food_list_sql);
$food_list = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<?php include 'includes/header.php' ?>

<body>
    <?php include 'includes/preloader.php' ?>
    <div id="main-wrapper">
        <?php include 'includes/navbar.php' ?>
        <div class="content-body" style="margin-left: -5px;">
            <div class="container-fluid">
                <div class="row">
                    <h2 class="mb-4">
                        <?php
                        $result = mysqli_query($link, "SELECT *
                                FROM restaurant WHERE id = $restaurant_id");
                        $row = mysqli_fetch_array($result);
                        ?>
                        <?php echo $row['name']; ?>
                    </h2>
                    <?php
                    foreach ($food_list as $food) {
                        $image = $food['images'];
                    ?>
                        <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
                            <form method="post" action="cart.php?action=add&id=<?php echo $food["id"]; ?>">
                                <input type="hidden" name="restaurant_id" value="<?php echo $food["restaurant_id"]; ?>">
                                <input type="hidden" name="name" value="<?php echo $food["food_name"]; ?>">
                                <input type="hidden" name="price" value="<?php echo $food["price"]; ?>">
                                <input type="hidden" name="id" value="<?php echo $food["id"]; ?>">
                                <div class="card <?php if ($food['status'] == 0) { ?>unavailable-menu <?php } ?>" style="box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;">
                                    <div class="card-body" style="padding: 1rem;">
                                        <div class="new-arrival-product">
                                            <div class="new-arrivals-img-contnent">
                                                <img class="img-fluid" src=<?php echo "uploads/$image" ?> width="50" alt="">
                                            </div>
                                            <div class="new-arrival-content text-center mt-3">
                                                <div id="module" class="container">
                                                    <h4><?php echo $food['food_name']; ?></h4>
                                                    <p class="collapse" id="collapse-<?php echo $food['id']; ?>" aria-expanded="false">
                                                        <?php echo $food['description']; ?>
                                                    </p>
                                                    <a role="button" class="collapsed" data-toggle="collapse" href="#collapse-<?php echo $food['id']; ?>" aria-expanded="false" aria-controls="collapseExample"></a>
                                                </div>
                                                <h4 class="mt-2"><?php echo number_format($food['price'], 2); ?></4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="form-group d-flex justify-content-center">
                                            <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 60px;" <?php if ($food['status'] == 0) { ?> disabled <?php } ?>>
                                        </div>
                                        <div class="text-center">
                                            <span class="price">
                                                <?php if ($food['status'] == 0) {  ?>
                                                    <a href="javascript:void(0);" class="btn btn-secondary disabled">Unavailable</a>
                                                <?php } else { ?>
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#addtoCart" class="btn btn-success">Add to Cart</a>
                                                <?php }  ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addtoCart" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Notification</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="jumbotron">
                            <h3 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> You must login or register to proceed for adding the item to your cart.</h3>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                      <a href="login.php" class="btn btn-primary">Login</a>
                      <a href="register.php" class="btn btn-success">Register</a>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php' ?>
    <?php include 'includes/scripts.php' ?>
</body>

</html>