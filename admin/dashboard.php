<?php
	require_once "includes/config.php";

	$product_sql = "SELECT * FROM product_list WHERE status = 1";
	$product_result = mysqli_query($link, $product_sql);
	$product_list = $product_result->fetch_all(MYSQLI_ASSOC);
	
	$store_sql = "SELECT * FROM user_list WHERE user_type = 'owner'";
	$store_result = mysqli_query($link, $store_sql);
	$store = $store_result->fetch_all(MYSQLI_ASSOC);

	$customer_sql = "SELECT * FROM user_list WHERE user_type = 'customer' && status = 1";
	$item_result = mysqli_query($link, $customer_sql);
	$customer_list = $item_result->fetch_all(MYSQLI_ASSOC);

	$driver_sql = "SELECT * FROM driver WHERE status = 1";
	$driver_result = mysqli_query($link, $driver_sql);
	$driver = $driver_result->fetch_all(MYSQLI_ASSOC);

	$feedback_sql = "SELECT * FROM feedback";
	$feedback_result = mysqli_query($link, $feedback_sql);
	$feedback = $feedback_result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<?php include 'includes/header.php'?>
<body>

	<?php include 'includes/preloader.php'?>

    <div id="main-wrapper">

        <?php include 'includes/topbar.php'?>
        <?php include 'includes/sidebar.php'?>

        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="form-head d-flex mb-3 align-items-start">
					<div class="mr-auto d-none d-lg-block">
						<h2 class="text-black font-w600 mb-0"><i class="mdi mdi-view-dashboard"></i> Dashboard</h2>
					</div>
				</div>
                <div class="row">
					<div class="col-xl-6 col-xxl-6 col-lg-6 col-md-6 col-sm-6">
						<div class="widget-stat card">
							<div class="card-body p-4">
								<div class="media ai-icon">
									<span class="mr-3 bgl-primary text-primary">
									<i class="mdi mdi-gift"></i>
                                </span>
									<div class="media-body">
										<h3 class="mb-0 text-black"><span class="counter ml-0"><?php echo count($product_list); ?></span></h3>
										<p class="mb-0">Number of Products</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-xxl-6 col-lg-6 col-md-6 col-sm-6">
						<div class="widget-stat card">
							<div class="card-body p-4">
								<div class="media ai-icon">
									<span class="mr-3 bgl-primary text-primary">
									<i class="mdi mdi-home"></i>
									</span>
									<div class="media-body">
										<h3 class="mb-0 text-black"><span class="counter ml-0"><?php echo count($store); ?></span></h3>
										<p class="mb-0">Number of Stores</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-xxl-6 col-lg-6 col-md-6 col-sm-6">
						<div class="widget-stat card">
							<div class="card-body p-4">
								<div class="media ai-icon">
									<span class="mr-3 bgl-primary text-primary">
									<i class="mdi mdi-account-multiple"></i>
									</span>
									<div class="media-body">
										<h3 class="mb-0 text-black"><span class="counter ml-0"><?php echo count($customer_list); ?></span></h3>
										<p class="mb-0">Number of Customers</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-xxl-6 col-lg-6 col-md-6 col-sm-6 ">
						<div class="widget-stat card">
							<div class="card-body p-4">
								<div class="media ai-icon">
									<span class="mr-3 bgl-primary text-primary">
									<i class="mdi mdi-bike"></i>
                                    </span>
									<div class="media-body">
										<h3 class="mb-0 text-black"><span class="counter ml-0"><?php echo count($driver); ?></span></h3>
										<p class="mb-0">Number of Delivery Drivers</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-xxl-6 col-lg-6 col-md-6 col-sm-6">
						<div class="widget-stat card">
							<div class="card-body p-4">
								<div class="media ai-icon">
									<span class="mr-3 bgl-primary text-primary">
									<i class="mdi mdi-comment-text-multiple-outline"></i>
                                    </span>
									<div class="media-body">
										<h3 class="mb-0 text-black"><span class="counter ml-0"><?php echo count($feedback); ?></span></h3>
										<p class="mb-0">Number of Feedbacks</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				 </div>
            </div>
        </div>

    </div>

    <?php include 'includes/footer.php'?>
	
</body>
</html>