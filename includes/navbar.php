<div class="nav-header">
            <a href="welcome.php" class="brand-logo">
                <img src="images/avatar/logo_main.png" alt="" width="100">
            </a>
        </div>
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                        </div>

                        <ul class="navbar-nav header-right">
							<li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link primary <?php if ($_SERVER['PHP_SELF'] == '/atadku/welcome.php') { ?>active-nav <?php } ?>" href="welcome.php"><i class="mdi mdi-food"></i> Restaurant</a>
							</li>
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link primary <?php if ($_SERVER['PHP_SELF'] == '/atadku/store.php') { ?>active-nav <?php } ?>" href="store.php"><i class="mdi mdi-home"></i> Store</a>
							</li>
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link primary <?php if ($_SERVER['PHP_SELF'] == '/atadku/pickup.php') { ?>active-nav <?php } ?>" href="pickup.php"><i class="mdi mdi-navigation"></i> Pickup</a>
							</li>
							<li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link primary <?php if ($_SERVER['PHP_SELF'] == '/atadku/about.php') { ?>active-nav <?php } ?>" href="about.php"><i class="mdi mdi-office-building"></i> About</a>
							</li>
							<li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link primary <?php if ($_SERVER['PHP_SELF'] == '/atadku/contact.php') { ?>active-nav <?php } ?>" href="contact.php"><i class="mdi mdi-phone"></i> Contact</a>
							</li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
									<div class="header-info">
										<span>Login / <strong>Register</strong></span>
									</div>
                                    <img src="images/avatar/avatar.png" width="20" alt=""/>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    
                                    <a href="login.php" class="dropdown-item ai-icon">
                                        <svg id="icon-logout"class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ml-2">Login </span>
                                    </a>
                                    <a href="register.php" class="dropdown-item ai-icon">
                                        <svg id="icon-logout"class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ml-2">Register </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>