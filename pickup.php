<?php
require_once "includes/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<?php include 'includes/header.php' ?>

<body>
    <?php include 'includes/preloader.php' ?>
    <div id="main-wrapper">
        <?php include 'includes/navbar.php' ?>
        <div class="content-body" style="margin-left: -5px;">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6">
                        <div class="welcome-text">
                            <h4><i class="mdi mdi-navigation"></i> Pickup Details</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card p-2">
                            <div class="card-body">
                                <div class="profile-blog mb-5">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <h4 class="mb-4">Sender's Information</h4>
                                            <div class="form-group">
                                                <div class="form-floating mb-2">
                                                    <input type="text" class="form-control" name="sender_name" value="" id="sender_name" placeholder="Sender's Name" required>
                                                    <label for="sender_name">Sender's Name</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-floating mb-2">
                                                    <input type="number" class="form-control" name="sender_number" value="" id="sender_number" placeholder="Contact Number" required>
                                                    <label for="sender_number">Contact Number</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-floating mb-2">
                                                    <input type="text" class="form-control" name="sender_address" value="" id="sender_address" placeholder="Address" required>
                                                    <label for="sender_address">Address</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-floating">
                                                    <select class="form-select" style="padding: 0.9rem !important; width: 100% !important;" id="item_details" name="item_details" required>
                                                        <option selected value="">Type of Item</option>
                                                        <option value="document">Document</option>
                                                        <option value="food">Food</option>
                                                        <option value="clothing">Clothing</option>
                                                        <option value="electronics">Electronics</option>
                                                        <option value="fragile">Fragile</option>
                                                        <option value="medical">Medical</option>
                                                        <option value="others">Others</option>
                                                    </select>
                                                    <label for="item_details">Item Details</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-floating mb-2">
                                                    <textarea name="posts" id="textarea" cols="10" rows="2" class="form-control bg-transparent" placeholder="Please write anything you want to post here..." required></textarea>
                                                    <label for="sender_address">Add notes to driver (optional)</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <h4 class="mb-4">Deliver to</h4>
                                            <div class="form-group">
                                                <div class="form-floating mb-2">
                                                    <input type="text" class="form-control" name="recipient_name" value="" id="recipient_name" placeholder="Recipient's Name" required>
                                                    <label for="recipient_name">Recipient's Name</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-floating mb-2">
                                                    <input type="number" class="form-control" name="sender_number" value="" id="sender_number" placeholder="Contact Number" required>
                                                    <label for="sender_number">Contact Number</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-floating mb-2">
                                                    <input type="text" class="form-control" name="sender_address" value="" id="sender_address" placeholder="Address" required>
                                                    <label for="sender_address">Complete Address</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-floating mb-2">
                                                    <textarea name="posts" id="textarea" cols="40" rows="5" class="form-control bg-transparent" placeholder="Please write anything you want to post here..."></textarea>
                                                    <label for="sender_address">Add simple greeting for recipients (optional)</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row text-center">
                                            <p>You must login or register to use pickup services.</p>
                                            <div class="col-md-12">
                                                <a href="login.php" class="btn btn-primary">Login</a>
                                                <a href="register.php" class="btn btn-success">Register</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-blog mb-5">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <i class="mdi mdi-check-circle" style="font-size:3rem;"></i>
                                        </div>

                                        <div class="col-sm-10">
                                            <div class="profile">
                                                <h4 class="cust-name">SAFETY</h4>
                                                <p class="cust-profession">Free yourself from worry. All parcels accepted by AtadKuExpress are insured and our drivers undergo intensive training to make sure your parcels are delivered safely*.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <i class="mdi mdi-history" style="font-size:3rem;"></i>
                                        </div>

                                        <div class="col-sm-10">
                                            <div class="profile">
                                                <h4 class="cust-name">CONVENIENCE</h4>
                                                <p class="cust-profession">Free yourself from the hassles of discomfort because you left something at home.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <i class="mdi mdi-bike" style="font-size:3rem;"></i>
                                        </div>

                                        <div class="col-sm-10">
                                            <div class="profile">
                                                <h4 class="cust-name">SPEED</h4>
                                                <p class="cust-profession">Free yourself from waiting a day to get your parcel picked up, AtadKuExpress is on-demand which means your parcel will get picked up immediately and delivered straight to your recipient.</p>
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
      <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>
</body>

</html>