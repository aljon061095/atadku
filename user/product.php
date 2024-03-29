<?php
//Include config file
require_once "includes/config.php";

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
        <?php include 'includes/sidebar.php' ?>

        <div class="content-body" style="padding-top: 7rem;">
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
                                                <img class="img-fluid" src=<?php echo "../uploads/$image" ?> width="50" alt="">
                                            </div>
                                            <div class="new-arrival-content text-center mt-3">
                                                <div id="module" class="container">
                                                    <h4 style="font-size: 12px;"><?php echo $product['product_name']; ?></h4>
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
                                            <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 60px;">
                                        </div>
                                        <div class="text-center">
                                            <span class="price">
                                                <?php if ($product['status'] == 0) {  ?>
                                                    <a href="javascript:void(0);" class="btn btn-secondary disabled">Unavailable</a>
                                                <?php } else { ?>
                                                    <button type="submit" name="add" class="btn btn-success">Add to Cart</button>
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

    <?php include 'includes/feedbacks.php' ?>
    <?php include 'includes/footer.php' ?>
    <?php include 'includes/scripts.php' ?>
</body>

</html>