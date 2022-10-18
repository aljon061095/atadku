<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<?php include 'includes/header.php'?>

<body>
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <div id="main-wrapper">
       <?php include 'includes/navbar.php' ?>
        <div class="content-body" style="margin-left: -5px;">
            <div class="container-fluid">
                <div class="row">
                    <?php
                        for ($i=1; $i < 9; $i++) { ?>
                            <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="new-arrival-product">
                                            <div class="new-arrivals-img-contnent">
                                                <img class="img-fluid" src=<?php echo "../images/restaurant/$i.png" ?> alt="">
                                            </div>
                                            <div class="new-arrival-content text-center mt-3">
                                                <h4>Striped Dress</h4>
                                                <ul class="star-rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                                <span class="price">
                                                    <a href="menu.php" class="btn btn-primary">View Menu</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php' ?>

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="../vendor/global/global.min.js"></script>
	<script src="../vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="../vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="../js/custom.min.js"></script>
	<script src="../js/deznav-init.js"></script>
	<!-- Apex Chart -->
	<script src="../vendor/apexchart/apexchart.js"></script>

    <script src="../vendor/highlightjs/highlight.pack.min.js"></script>
    <!-- Circle progress -->
</body>
</html>