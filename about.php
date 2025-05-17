<?php
//Include config file
require_once "includes/config.php";

$post_sql = "SELECT * FROM posts";
$result = mysqli_query($link, $post_sql);
$posts = $result->fetch_all(MYSQLI_ASSOC);

$feedback_sql = "SELECT * FROM feedback";
$feedback_result = mysqli_query($link, $feedback_sql);
$feedbacks = $feedback_result->fetch_all(MYSQLI_ASSOC);

$driver_sql = "SELECT * FROM user_list WHERE user_type = 'driver'";
$driver_result = mysqli_query($link, $driver_sql);
$drivers = $driver_result->fetch_all(MYSQLI_ASSOC);

$customer_sql = "SELECT * FROM user_list WHERE user_type = 'customer'";
$customer_result = mysqli_query($link, $customer_sql);
$customers = $customer_result->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['submit_post'])) {
    $posts = $_POST['posts'];
    $like = 0;

    $query = "INSERT INTO posts(posts, number_like)
            VALUES ('$posts', '$like')";
    $query_run = mysqli_query($link, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<?php include 'includes/header.php' ?>

<style>
    p {
        font-size: 0.875rem;
        margin-bottom: .5rem;
        line-height: 1.5rem
    }

    h4 {
        line-height: .2 !important;
    }

    .profile {
        margin-top: 16px;
        margin-left: 11px;
    }

    .profile-pic {
        width: 58px;
    }

    .cust-name {
        font-size: 18px;
    }

    .cust-profession {
        font-size: 10px;
    }

    .items {
        margin: 0px auto;
        margin-top: 10px
    }

    .slick-slide {
        margin: 10px
    }
</style>

<body>
    <?php include 'includes/preloader.php'; ?>
    <div id="main-wrapper">
        <?php include 'includes/navbar.php' ?>
        <div class="content-body" style="margin-left: -5px;">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4><i class="mdi mdi-office-building"></i> About Us</h4>
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="profile card card-body px-3 pt-3 pb-0">
                            <div class="profile-head">
                                <div class="photo-content">
                                    <div class="cover-photo"></div>
                                </div>
                                <div class="profile-info">
                                    <div class="profile-photo">
                                        <img src="../images/profile/profile.png" class="img-fluid rounded-circle" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card p-2">
                            <div class="card-body">
                                <div class="pro-statistics mb-5">
                                    <div class="text-center">
                                        <div class="row">
                                            <div class="col">
                                                <h3 class="m-b-0"><?php echo count($customers); ?></h3><span>Customers</span>
                                            </div>
                                            <div class="col">
                                                <h3 class="m-b-0"><?php echo count($drivers); ?></h3><span>Drivers</span>
                                            </div>
                                            <div class="col">
                                                <h3 class="m-b-0"><?php echo count($feedbacks); ?></h3><span>Feedbacks</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-blog mb-5">
                                    <h4 class="mb-4">About the System</h4>
                                    <p class="mt-4">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-tab">
                                    <div class="custom-tab-1">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item"><a href="#feedbacks" data-toggle="tab" class="nav-link active show">Feedbacks</a>
                                            </li>
                                            <li class="nav-item"><a href="#my-posts" data-toggle="tab" class="nav-link">Post</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="feedbacks" class="tab-pane fade active show">
                                                <div class="items">
                                                    <?php foreach($feedbacks as $feedback) { ?>
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h4 class="card-title"><img src="https://img.icons8.com/ultraviolet/40/000000/quote-left.png"></h4>
                                                                <div class="template-demo">
                                                                    <h3><?php echo $feedback['feedback'];  ?></h3>
                                                                    <p><?php echo $feedback['comment'];  ?></p>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <?php
                                                                        $user_id = $feedback['user_id'];
                                                                        $user_type = $feedback['user_type'] = "owner" ? "restaurant" : $feedback['user_type'];
                                                                        $result = mysqli_query($link, "SELECT *
                                                                                FROM $user_type WHERE id = $user_id");
                                                                        $user = mysqli_fetch_array($result);
                                                                        $avatar = $feedback['user_type'] = "owner" ? $user["logo"] : $user["profile"];
                                                                        $name = $feedback['user_type'] = "owner" ? $user["name"] : $user["full_name"];
                                                                        $user_type = $feedback['user_type'] = "owner" ? "Store Owner" : $_SESSION["user"];
                                                                    ?>
                                                                    <div class="col-sm-1">
                                                                        <img class="profile-pic" src="uploads/<?php echo $avatar; ?>">
                                                                    </div>

                                                                    <div class="col-sm-11">
                                                                        <div class="profile">
                                                                            <h4 class="cust-name"><?php echo $name; ?></h4>
                                                                            <p class="cust-profession"><?php echo $user_type; ?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php }  ?>
                                                </div>
                                            </div>
                                            <div id="my-posts" class="tab-pane fade">
                                                <div class="my-post-content">
                                                    <div class="post-input">
                                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                                            <textarea name="posts" id="textarea" cols="30" rows="5" class="form-control bg-transparent" placeholder="Please write anything you want to post here..." required></textarea>
                                                            <button type="submit" name="submit_post" class="btn btn-primary"><i class="mdi mdi-message-reply"></i> Post</button>
                                                        </form>
                                                    </div>
                                                    <?php foreach ($posts as $post) { ?>
                                                        <div class="profile-uoloaded-post pb-5">
                                                            <img src="../images/tab/8.jpg" alt="" class="img-fluid">
                                                            <p>
                                                                <?php echo $post['posts']; ?>
                                                            </p>
                                                            <button class="btn btn-success mr-2"><span class="mr-2"><i class="mdi mdi-hand-pointing-right"></i></span>Like</button>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="text-center mb-2"><a href="javascript:void()" class="btn btn-primary">Load More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php' ?>

    <script>
        $(document).ready(function() {

            $('.items').slick({
                dots: true,
                infinite: true,
                speed: 800,
                autoplay: true,
                autoplaySpeed: 2000,
                slidesToShow: 4,
                slidesToScroll: 4,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }

                ]
            });
        });
    </script>

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>
    <!-- Apex Chart -->
    <script src="vendor/apexchart/apexchart.js"></script>

    <script src="vendor/highlightjs/highlight.pack.min.js"></script>
    <!-- Circle progress -->
</body>

</html>