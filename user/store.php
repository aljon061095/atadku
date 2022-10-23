<?php 
    require_once "includes/config.php";

    $store_sql = "SELECT * FROM store";
    $result = mysqli_query($link, $store_sql);
    $stores = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<?php include 'includes/header.php'?>

<body>
    <?php include 'includes/preloader.php' ?>

    <div id="main-wrapper">
        
       <?php include 'includes/navbar.php' ?>
       <?php include 'includes/sidebar.php'?>
        <div class="content-body" style="padding-top: 7rem;">
            <div class="container-fluid">
                <div class="row">
                    <?php
                        foreach ($stores as $store) {
                                $logo = $store['logo'];
                            ?>
                        
                            <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
                                <div class="card" style="box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;">
                                    <div class="card-body">
                                        <div class="new-arrival-product">
                                            <div class="new-arrivals-img-contnent">
                                                <img class="img-fluid" src=<?php echo "../uploads/$logo" ?> alt="">
                                            </div>
                                            <div class="new-arrival-content text-center mt-1">
                                                <h4><?php echo $store['name']; ?></h4>
                                                <p><?php echo $store['address']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-center">
                                            <span class="price">
                                                <a href="item_display.php?id=<?php echo $store['id']; ?>" class="btn btn-primary">View Products</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/feedbacks.php' ?>
    <?php include 'includes/footer.php' ?>
</body>
</html>