<?php
	require_once "includes/config.php";

	// Initialize the session
    session_start();

	$restaurant_id =  $_SESSION["id"];

	$food_sql = "SELECT * FROM food_list WHERE status = 1 and restaurant_id = $restaurant_id";
	$food_result = mysqli_query($link, $food_sql);
	$food_list = $food_result->fetch_all(MYSQLI_ASSOC);

	$food_orders_sql = "SELECT * FROM food_orders WHERE restaurant_id = $restaurant_id";
	$food_orders_result = mysqli_query($link, $food_orders_sql);
	$food_orders = $food_orders_result->fetch_all(MYSQLI_ASSOC);

	$driver_sql = "SELECT * FROM driver WHERE status = 1";
	$driver_result = mysqli_query($link, $driver_sql);
	$driver = $driver_result->fetch_all(MYSQLI_ASSOC);

	$feedback_sql = "SELECT * FROM driver WHERE status = 1";
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
        
        <div class="content-body" style="margin-left: -5px; padding-top: 5rem !important;">
            <!-- row -->
			<div class="container-fluid">
				<div class="form-head d-flex mb-3 align-items-start">
					<div class="mr-auto d-none d-lg-block">
						<h2 class="text-black font-w600 mb-0"><i class="mdi mdi-view-dashboard"></i> Dashboard</h2>
					</div>
				</div>

                <!--Restaurant Owner-->
				<?php  if (isset($_SESSION["user"]) && $_SESSION["user"] === "owner") { ?>
					<div class="row">
						<div class="col-xl-4 col-xxl-4 col-lg-6 col-md-6 col-sm-6">
							<div class="widget-stat card">
								<div class="card-body p-4">
									<div class="media ai-icon">
										<span class="mr-3 bgl-primary text-primary">
										<i class="mdi mdi-food"></i>
										</span>
										<div class="media-body">
											<h3 class="mb-0 text-black"><span class="counter ml-0"><?php echo count($food_list); ?></span></h3>
											<p class="mb-0">Foods Available</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-4 col-lg-6 col-md-6 col-sm-6">
							<div class="widget-stat card">
								<div class="card-body p-4">
									<div class="media ai-icon">
										<span class="mr-3 bgl-primary text-primary">
										<i class="mdi mdi-chart-timeline"></i>
									</span>
										<div class="media-body">
											<h3 class="mb-0 text-black"><span class="counter ml-0">126</span>k</h3>
											<p class="mb-0">Total Sales</p>
											<small>4% (30 days)</small>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-4 col-lg-6 col-md-6 col-sm-6 ">
							<div class="widget-stat card">
								<div class="card-body p-4">
									<div class="media ai-icon">
										<span class="mr-3 bgl-primary text-primary">
										<i class="mdi mdi-cart-outline"></i>
										</span>
										<div class="media-body">
											<h3 class="mb-0 text-black"><span class="counter ml-0"><?php echo count($food_orders); ?></span></h3>
											<p class="mb-0">Total Orders</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-4 col-lg-6 col-md-6 col-sm-6 offset-md-2">
							<div class="widget-stat card">
								<div class="card-body p-4">
									<div class="media ai-icon">
										<span class="mr-3 bgl-primary text-primary">
										<i class="mdi mdi-coin"></i>
										</span>
										<div class="media-body">
											<h3 class="mb-0 text-black"><span class="counter ml-0">279</span></h3>
											<p class="mb-0">Daily Sales</p>
											<small>4% (30 days)</small>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-xxl-4 col-lg-6 col-md-6 col-sm-6">
							<div class="widget-stat card">
								<div class="card-body p-4">
									<div class="media ai-icon">
										<span class="mr-3 bgl-primary text-primary">
										<i class="mdi mdi-cart-plus"></i></span>
										<div class="media-body">
											<h3 class="mb-0 text-black"><span class="counter ml-0">65</span></h3>
											<p class="mb-0">Daily Orders</p>
											<small>4% (30 days)</small>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				

                <!--Driver-->
				<?php  if (isset($_SESSION["user"]) && $_SESSION["user"] === "driver") { ?>
					<div class="row">
						<div class="col-xl-6 col-xxl-6 col-lg-6 col-md-6 col-sm-6">
							<div class="widget-stat card">
								<div class="card-body p-4">
									<div class="media ai-icon">
										<span class="mr-3 bgl-primary text-primary">
										<i class="mdi mdi-truck-delivery"></i>
										</span>
										<div class="media-body">
											<h3 class="mb-0 text-black"><span class="counter ml-0">56</span></h3>
											<p class="mb-0">Number of Delivery</p>
											<small>4% (30 days)</small>
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
										<i class="mdi mdi-chart-timeline"></i>
									</span>
										<div class="media-body">
											<h3 class="mb-0 text-black"><span class="counter ml-0">126</span>k</h3>
											<p class="mb-0">Total Commissions</p>
											<small>4% (30 days)</small>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'?>
	
</body>
</html>