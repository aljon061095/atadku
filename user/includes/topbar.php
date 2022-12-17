<?php 
    //Initialize the session
    // session_start();
    //Include config file
    require_once "includes/config.php";

    $user_id = $_SESSION["id"];;
    $notification_sql = "SELECT * FROM notifications WHERE user_id = $user_id";
    $result = mysqli_query($link, $notification_sql);
    $notifications = $result->fetch_all(MYSQLI_ASSOC);
?>

<div class="nav-header">
    <a href="#" class="brand-logo">
        <img src="../images/avatar/logo_main.png" alt="" width="120">
    </a>
</div>

<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left"></div>

                <ul class="navbar-nav header-right">
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle"  href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <?php if (count($notifications) != 0) { ?>
                                <span class="badge badge-danger badge-counter">
                                    <?php echo count($notifications); ?>
                                <span>
                            <?php  }?>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Notifications
                            </h6>
                            <?php foreach($notifications as $notification) { ?>
                                <a class="dropdown-item d-flex align-items-center" href="notifications.php">
                                    <div class="mr-3">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">11/12/13</div>
                                        <span class="font-weight-bold">Test Notification</span>
                                    </div>
                                </a>
                            <?php } ?>
                        
                            <a class="dropdown-item text-center small text-gray-500" href="notifications.php">Show All Notifications</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                            <div class="header-info">
                                <span>Hello, <strong><?php echo $_SESSION["username"]; ?></strong></span>
                            </div>
                            <?php if (isset($_SESSION["profile"])) { ?>
                                <img src="../uploads/<?php echo $_SESSION['profile']; ?>" width="20" alt=""/>
                            <?php } else { ?>    
                                <img src="../images/avatar/avatar.png" width="20" alt=""/>
                            <?php  } ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item ai-icon">
                                <svg id="icon-user1" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <span class="ml-2">Profile </span>
                            </a>
                            <a href="#" class="dropdown-item ai-icon">
                                <svg id="icon-inbox" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                <span class="ml-2">Inbox </span>
                            </a>
                            <a href="../logout.php" class="dropdown-item ai-icon">
                                <svg id="icon-logout" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                <span class="ml-2">Logout </span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>