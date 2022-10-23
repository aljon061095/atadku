<!DOCTYPE html>
<html lang="en" class="h-100">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<?php include 'includes/header.php'?>

<body class="h-100" style="background-image: url(images/avatar/login_background.png); ">
    <div class="authincation" style="margin-left: 10px;">
        <div class="row">
            <div class="col-md-4 justify-content-left h-100 align-items-left mt-4 ml-4">
                <div class="authincation-content">
                    <div class="no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form" style="padding: 40px;">
                                <h4 class="text-center mb-4">Login in your account</h4>
                                <form action="#">
                                    <div class="form-group">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                            <label for="floatingInput">Email address</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-floating mb-5">
                                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                                            <label for="floatingPassword">Password</label>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <a href="admin/dashboard.php" class="btn btn-primary btn-block">Login as Admin</a>
                                    </div>
                                </form>
                                <div class="new-account mt-3 text-center">
                                    <div class="form-group">
                                        <a href="#">Forgot Password?</a>
                                    </div>
                                    <p>Don't have an account? <a class="text-primary" href="register.php">Sign up</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>

</body>
</html>