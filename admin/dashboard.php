<?php
	require_once "includes/config.php";

	$restaurant_sql = "SELECT * FROM restaurant WHERE status = 1";
	$restaurant_result = mysqli_query($link, $restaurant_sql);
	$resturant = $restaurant_result->fetch_all(MYSQLI_ASSOC);

	$food_sql = "SELECT * FROM food_list WHERE status = 1";
	$food_result = mysqli_query($link, $food_sql);
	$food_list = $food_result->fetch_all(MYSQLI_ASSOC);
	
	$store_sql = "SELECT * FROM store WHERE status = 1";
	$store_result = mysqli_query($link, $store_sql);
	$store = $store_result->fetch_all(MYSQLI_ASSOC);

	$item_sql = "SELECT * FROM item_list WHERE status = 1";
	$item_result = mysqli_query($link, $item_sql);
	$item_list = $item_result->fetch_all(MYSQLI_ASSOC);

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

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php include 'includes/topbar.php'?>
        <?php include 'includes/sidebar.php'?>

		<!--**********************************
            Content body start
        ***********************************-->
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
									<i class="mdi mdi-office-building"></i>
									</span>
									<div class="media-body">
										<h3 class="mb-0 text-black"><span class="counter ml-0"><?php echo count($resturant); ?></span></h3>
										<p class="mb-0">Number of Restaurants</p>
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
									<i class="mdi mdi-food"></i>
                                </span>
									<div class="media-body">
										<h3 class="mb-0 text-black"><span class="counter ml-0"><?php echo count($food_list); ?></span></h3>
										<p class="mb-0">Number of Foods</p>
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
									<i class="mdi mdi-gift"></i>
                                </span>
									<div class="media-body">
										<h3 class="mb-0 text-black"><span class="counter ml-0"><?php echo count($item_list); ?></span></h3>
										<p class="mb-0">Number of Items</p>
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
									<i class="mdi mdi-truck-delivery"></i>
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
					<div class="col-xl-6 col-xxl-6 col-lg-12 col-md-12">
						<div class="card">
							<div class="card-header border-0 pb-0 d-sm-flex d-block">
								<div>
									<h4 class="card-title mb-1">Orders Summary</h4>
									<small class="mb-0">Lorem ipsum dolor sit amet, consectetur</small>
								</div>
								<div class="card-action card-tabs mt-3 mt-sm-0">
									<ul class="nav nav-tabs" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#user" role="tab">
												Monthly
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#bounce" role="tab">
												Weekly
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#session-duration" role="tab">
												Today
											</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="card-body orders-summary">
								<div class="d-flex order-manage p-3 align-items-center mb-4">
									<a href="javascript:void(0);" class="btn fs-22 py-1 btn-success px-4 mr-3">25</a>
									<h4 class="mb-0">New Orders <i class="fa fa-circle text-success ml-1 fs-15"></i></h4>
									<a href="javascript:void(0);" class="ml-auto text-primary font-w500">Manage orders <i class="ti-angle-right ml-1"></i></a>
								</div>
								<div class="row">
									<div class="col-sm-4 mb-4">
										<div class="border px-3 py-3 rounded-xl">
											<h2 class="fs-32 font-w600 counter">25</h2>
											<p class="fs-16 mb-0">On Delivery</p>
										</div>
									</div>
									<div class="col-sm-4 mb-4">
										<div class="border px-3 py-3 rounded-xl">
											<h2 class="fs-32 font-w600 counter">60</h2>
											<p class="fs-16 mb-0">Delivered</p>
										</div>
									</div>
									<div class="col-sm-4 mb-4">
										<div class="border px-3 py-3 rounded-xl">
											<h2 class="fs-32 font-w600 counter">7</h2>
											<p class="fs-16 mb-0">Canceled</p>
										</div>
									</div>
								</div>
								<div class="widget-timeline-icon">
									<div class="row align-items-center mx-0">
										<div class="col-xl-3 col-lg-4 col-xxl-4 col-sm-4 px-0 my-2 text-center text-sm-left">
											 <span class="donut" data-peity='{ "fill": ["rgb(62, 73, 84)", "rgba(255, 109, 76, 1)","rgba(43, 193, 85, 1)"]}'>2,5,3</span>
										</div>	
										<div class="col-xl-9 col-lg-8 col-xxl-8 col-sm-8 px-0">
											<div class="d-flex align-items-center mb-3">
												<p class="mb-0 fs-14 mr-2 col-4 px-0">Immunities (24%)</p>
												<div class="progress mb-0" style="height:8px; width:100%;">
													<div class="progress-bar bg-warning progress-animated" style="width:85%; height:8px;" role="progressbar">
														<span class="sr-only">60% Complete</span>
													</div>
												</div>	
												<span class="pull-right ml-auto col-1 px-0 text-right">25</span>
											</div>
											<div class="d-flex align-items-center  mb-3">
												<p class="mb-0 fs-14 mr-2 col-4 px-0">Heart Beat (41%)</p>
												<div class="progress mb-0" style="height:8px; width:100%;">
													<div class="progress-bar bg-success progress-animated" style="width:70%; height:8px;" role="progressbar">
														<span class="sr-only">60% Complete</span>
													</div>
												</div>
												<span class="pull-right ml-auto col-1 px-0 text-right">60</span>
											</div>
											<div class="d-flex align-items-center">
												<p class="mb-0 fs-14 mr-2 col-4 px-0">Weigth (15%)</p>
												<div class="progress mb-0" style="height:8px; width:100%;">
													<div class="progress-bar bg-dark progress-animated" style="width:30%; height:8px;" role="progressbar">
														<span class="sr-only">60% Complete</span>
													</div>
												</div>
												<span class="pull-right ml-auto col-1 px-0 text-right">07</span>
											</div>
										</div>	
									</div>	
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-xxl-6 col-lg-12 col-md-12">
						<div class="card">
							<div class="card-header border-0 pb-0 d-sm-flex d-block">
								<div>
									<h4 class="card-title mb-1">Revenue</h4>
									<small class="mb-0">Lorem ipsum dolor sit amet, consectetur</small>
								</div>
								<div class="dropdown mt-3 mt-sm-0">
									<button type="button" class="btn btn-primary dropdown-toggle light fs-14" data-toggle="dropdown" aria-expanded="false">
										Weekly
									</button>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="#">Daily</a>
										<a class="dropdown-item" href="#">Weekly</a>
										<a class="dropdown-item" href="#">Monthly</a>
									</div>
								</div>
							</div>
							<div class="card-body revenue-chart px-3">
									<div class="d-flex align-items-end pr-3 pull-right revenue-chart-bar">
										<div class="d-flex align-items-end mr-4">
											<img src="images/svg/ic_stat2.svg" height="22" width="22" class="mr-2 mb-1" alt=""/>
											<div>
												<small class="text-dark fs-14">Income</small>
												<h3 class="font-w600 mb-0">$<span class="counter">41,512</span>k</h3>
											</div>
										</div>
										<div class="d-flex align-items-end">
											<img src="images/svg/ic_stat1.svg" height="22" width="22" class="mr-2 mb-1" alt=""/>
											<div>
												<small class="text-dark fs-14">Expense</small>
												<h3 class="font-w600 mb-0">$<span class="counter">41,512</span>k</h3>
											</div>
										</div>
									</div>
								<div id="chartBar"></div>
							</div>
						</div>
					</div>
					<div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
						<div id="user-activity" class="card">
							<div class="card-header border-0 pb-0 d-sm-flex d-block">
								<div>
									<h4 class="card-title mb-1">Customer Map</h4>
									<small class="mb-0">Lorem Ipsum is simply dummy text of the printing</small>
								</div>
								<div class="card-action card-tabs mt-3 mt-sm-0">
									<ul class="nav nav-tabs" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#user" role="tab">
												Monthly
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#bounce" role="tab">
												Weekly
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#session-duration" role="tab">
												Today
											</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="card-body">
								<div class="tab-content" id="myTabContent">
									<div class="tab-pane fade show active" id="user" role="tabpanel">
										<canvas id="activity" class="chartjs"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>
				 </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <?php include 'includes/footer.php'?>
	
</body>
</html>