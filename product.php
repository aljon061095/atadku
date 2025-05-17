<?php
require_once "includes/config.php";

//Initialize the session
session_start();

$store_id = $_GET['id'];
$product_list_sql = "SELECT * FROM product_list WHERE store_id = $store_id";
$result = mysqli_query($link, $product_list_sql);
$product_list = $result->fetch_all(MYSQLI_ASSOC);
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
                                FROM user_list WHERE id = $store_id");
                        $row = mysqli_fetch_array($result);
                        ?>
                        <?php echo $row['full_name']; ?>
                    </h2>
                    <?php
                    foreach ($product_list as $product) {
                        $image = $product['images'];
                    ?>
                        <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
                            <form method="post" action="cart.php?action=add&id=<?php echo $product["id"]; ?>">
                                <input type="hidden" name="restaurant_id" value="<?php echo $product["store_id"]; ?>">
                                <input type="hidden" name="name" value="<?php echo $product["product_name"]; ?>">
                                <input type="hidden" name="price" value="<?php echo $product["price"]; ?>">
                                <input type="hidden" name="id" value="<?php echo $product["id"]; ?>">
                                <div class="card <?php if ($product['status'] == 0) { ?>unavailable-menu <?php } ?>" style="box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;">
                                    <div class="card-body" style="padding: 1rem;">
                                        <div class="new-arrival-product">
                                            <div class="new-arrivals-img-contnent">
                                                <img class="img-fluid" src=<?php echo "uploads/$image" ?> width="50" alt="">
                                            </div>
                                            <div class="new-arrival-content text-center mt-3">
                                                <div id="module" class="container">
                                                    <h4><?php echo $product['product_name']; ?></h4>
                                                    <p class="collapse" id="collapse-<?php echo $product['id']; ?>" aria-expanded="false">
                                                        <?php echo $product['description']; ?>
                                                    </p>
                                                    <a role="button" class="collapsed" data-toggle="collapse" href="#collapse-<?php echo $product['id']; ?>" aria-expanded="false" aria-controls="collapseExample"></a>
                                                </div>
                                                <h4 class="mt-2"><?php echo number_format($product['price'], 2); ?></4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="form-group d-flex justify-content-center">
                                            <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 60px;" <?php if ($product['status'] == 0) { ?> disabled <?php } ?>>
                                        </div>
                                        <div class="text-center">
                                            <span class="price">
                                                <?php if ($product['status'] == 0) {  ?>
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