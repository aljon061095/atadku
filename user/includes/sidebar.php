<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" >
            <?php  if (isset($_SESSION["user"]) && $_SESSION["user"] === "customer") { ?>
                <li>
                    <a href="index.php" class="ai-icon <?php if ($_SERVER['PHP_SELF'] == '/atadku/user/index.php') { ?>active-nav <?php } ?>" aria-expanded="false">
                    <i class="mdi mdi-view-dashboard"></i>
                    <span class="nav-text">Restaurant</span>
                    </a>
                </li>
                <li>
                    <a href="store.php" class="ai-icon <?php if ($_SERVER['PHP_SELF'] == '/atadku/user/store.php') { ?>active-nav <?php } ?>" aria-expanded="false">
                        <i class="mdi mdi-home"></i>
                        <span class="nav-text">Store</span>
                    </a>
                </li>
                <li>
                    <a href="pickup_list.php" class="ai-icon <?php if ($_SERVER['PHP_SELF'] == '/atadku/user/pickup_list.php' || $_SERVER['PHP_SELF'] == '/atadku/user/pickup.php') { ?>active-nav <?php } ?>" aria-expanded="false">
                        <i class="mdi mdi-navigation"></i>
                        <span class="nav-text">Pickup</span>
                    </a>
                </li>
                <li>
                    <a href="order_customer.php" class="ai-icon <?php if ($_SERVER['PHP_SELF'] == '/atadku/user/order_customer.php' || $_SERVER['PHP_SELF'] == '/atadku/user/order_customer_info.php') { ?>active-nav <?php } ?>" aria-expanded="false">
                        <i class="mdi mdi-clock"></i>
                        <span class="nav-text">Order History</span>
                    </a>
                </li>
            <?php } ?>

            <!-- Driver -->
            <?php  if (isset($_SESSION["user"]) && $_SESSION["user"] === "driver") { ?>
                <li>
                    <a href="dashboard.php" class="ai-icon <?php if ($_SERVER['PHP_SELF'] == '/atadku/user/dashboard.php') { ?>active-nav <?php } ?>" aria-expanded="false">
                    <i class="mdi mdi-view-dashboard"></i>
                    <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="order_pickup_list.php" class="ai-icon <?php if ($_SERVER['PHP_SELF'] == '/atadku/user/order_pickup_list.php') { ?>active-nav <?php } ?>" aria-expanded="false">
                        <i class="mdi mdi-bike"></i>
                        <span class="nav-text">Order List</span>
                    </a>
                </li>
                <li>
                    <a href="order_driver.php" class="ai-icon <?php if ($_SERVER['PHP_SELF'] == '/atadku/user/order_driver.php') { ?>active-nav <?php } ?>" aria-expanded="false">
                        <i class="mdi mdi-cart-plus"></i>
                        <span class="nav-text">Delivery List</span>
                    </a>
                </li>
                <li>
                    <a href="driver_pickup_list.php" class="ai-icon <?php if ($_SERVER['PHP_SELF'] == '/atadku/user/driver_pickup_list.php') { ?>active-nav <?php } ?>" aria-expanded="false">
                        <i class="mdi mdi-navigation"></i>
                        <span class="nav-text">Pickup List</span>
                    </a>
                </li>
                <li>
                    <a href="reports.php" class="ai-icon <?php if ($_SERVER['PHP_SELF'] == '/atadku/user/reports.php') { ?>active-nav <?php } ?>" aria-expanded="false">
                        <i class="mdi mdi-chart-bar-stacked"></i>
                        <span class="nav-text">Commission</span>
                    </a>
                </li>
            <?php } ?>
       

            <!-- Restaurant Owner-->
            <?php if (isset($_SESSION["user"]) && $_SESSION["user"] === "owner") { ?>
                <?php if (isset($_SESSION["type"]) && $_SESSION["type"] === "restaurant") { ?>
                    <li>
                        <a href="dashboard.php" class="ai-icon <?php if ($_SERVER['PHP_SELF'] == '/atadku/user/dashboard.php') { ?>active-nav <?php } ?>" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="food_list.php" class="ai-icon <?php if ($_SERVER['PHP_SELF'] == '/atadku/user/food_list.php') { ?>active-nav <?php } ?>" aria-expanded="false">
                            <i class="mdi mdi-food"></i>
                            <span class="nav-text">Food List</span>
                        </a>
                    </li>
                    <li>
                        <a href="order_restaurant.php" class="ai-icon <?php if ($_SERVER['PHP_SELF'] == '/atadku/user/order_restaurant.php' || $_SERVER['PHP_SELF'] == '/atadku/user/order_info.php') { ?>active-nav <?php } ?>" aria-expanded="false">
                            <i class="mdi mdi-cart-plus"></i>
                            <span class="nav-text">Order List</span>
                        </a>
                    </li>
                    <li>
                        <a href="reports.php" class="ai-icon <?php if ($_SERVER['PHP_SELF'] == '/atadku/user/reports.php') { ?>active-nav <?php } ?>" aria-expanded="false">
                            <i class="mdi mdi-chart-bar-stacked"></i>
                            <span class="nav-text">Sales Report</span>
                        </a>
                    </li>

                    <li>
                        <a href="settings.php" class="ai-icon <?php if ($_SERVER['PHP_SELF'] == '/atadku/user/settings.php') { ?>active-nav <?php } ?>" aria-expanded="false">
                            <i class="mdi mdi-cogs"></i>
                            <span class="nav-text">Settings</span>
                        </a>
                    </li>
                <?php  } ?>
                <?php if (isset($_SESSION["type"]) && $_SESSION["type"] === "store") { ?>
                    <li>
                        <a href="dashboard.php" class="ai-icon <?php if ($_SERVER['PHP_SELF'] == '/atadku/user/dashboard.php') { ?>active-nav <?php } ?>" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="item_list.php" class="ai-icon <?php if ($_SERVER['PHP_SELF'] == '/atadku/user/item_list.php') { ?>active-nav <?php } ?>" aria-expanded="false">
                            <i class="mdi mdi-gift"></i>
                            <span class="nav-text">Item List</span>
                        </a>
                    </li>
                    <li>
                        <a href="order_store.php" class="ai-icon <?php if ($_SERVER['PHP_SELF'] == '/atadku/user/order_store.php') { ?>active-nav <?php } ?>" aria-expanded="false">
                            <i class="mdi mdi-cart-plus"></i>
                            <span class="nav-text">Order List</span>
                        </a>
                    </li>
                    <li>
                        <a href="reports.php" class="ai-icon <?php if ($_SERVER['PHP_SELF'] == '/atadku/user/reports.php') { ?>active-nav <?php } ?>" aria-expanded="false">
                            <i class="mdi mdi-chart-bar-stacked"></i>
                            <span class="nav-text">Sales Report</span>
                        </a>
                    </li>
                    <li>
                        <a href="settings.php" class="ai-icon <?php if ($_SERVER['PHP_SELF'] == '/atadku/user/settings.php') { ?>active-nav <?php } ?>" aria-expanded="false">
                            <i class="mdi mdi-cogs"></i>
                            <span class="nav-text">Settings</span>
                        </a>
                    </li>
                <?php  } ?>
            <?php } ?>
        </ul>
    </div>
</div>