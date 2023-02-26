<?php
// Initialize the session
session_start();

//Check if the user is already logged in, if yes then redirect him to customer page
if (isset($_SESSION["user"]) && $_SESSION["user"] === "customer") {
    header("location: user/index.php");
    exit;
}

//Check if the user is already logged in, if yes then redirect him to driver page
if (isset($_SESSION["user"]) && $_SESSION["user"] === "driver") {
    header("location: user/dashboard.php");
    exit;
}

//Check if the user is already logged in, if yes then redirect him to owner page
if (isset($_SESSION["user"]) && $_SESSION["user"] === "owner") {
    header("location: user/dashboard.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

//login as customer
if (isset($_POST['login'])) {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, profile, username, password, user_type, is_blocked FROM user_list WHERE username = ?";

        if ($stmt = $link->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();

                // Check if username exists, if yes then verify password
                if ($stmt->num_rows == 1) {
                    // Password is correct, so start a new session
                    // session_start();

                    // Bind result variables
                    $stmt->bind_result($id, $profile, $username, $hashed_password, $user_type, $is_blocked);
                    if ($stmt->fetch()) {
                        if ($is_blocked == 1) {
                            $_SESSION['login_err'] = "Your account is blocked! Please contact your administrator.";
                        } else {
                            if (password_verify($password, $hashed_password)) {
                                // Password is correct, so start a new session
                                session_start();
    
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;
                                $_SESSION["profile"] = $profile;
                                $_SESSION["user"] = $user_type;
    
                                if ($user_type === "customer") {
                                    // Redirect user to welcome page
                                    header("location: user/stores.php");
                                } else if ($user_type === "driver") {
                                    // Redirect user to welcome page
                                    header("location: user/dashboard.php");
                                } else if ($user_type === "owner") {
                                    // Redirect user to welcome page
                                    header("location: user/dashboard.php");
                                }  else {
                                    // Redirect user to welcome page
                                    header("location: user/index.php");
                                }
                            } else {
                                // Password is not valid, display a generic error message
                                $_SESSION['login_err'] = "Invalid username or password.";
                            }
                        }
                    }
                } else {
                    $_SESSION['login_err'] = "Invalid username or password.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $link->close();
}


//login as customer
if (isset($_POST['login_customer'])) {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, profile, username, password FROM customer WHERE username = ?";

        if ($stmt = $link->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();

                // Check if username exists, if yes then verify password
                if ($stmt->num_rows == 1) {
                    // Password is correct, so start a new session
                    // session_start();

                    // Bind result variables
                    $stmt->bind_result($id, $profile, $username, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["profile"] = $profile;
                            $_SESSION["user"] = "customer";

                            // Redirect user to welcome page
                            header("location: user/index.php");
                        } else {
                            // Password is not valid, display a generic error message
                            $_SESSION['login_err'] = "Invalid username or password.";
                        }
                    }
                } else {
                    $_SESSION['login_err'] = "Invalid username or password.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $link->close();
}

//login as driver
if (isset($_POST['login_driver'])) {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM driver WHERE username = ?";

        if ($stmt = $link->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();

                // Check if username exists, if yes then verify password
                if ($stmt->num_rows == 1) {
                    // Password is correct, so start a new session
                    session_start();

                    // Bind result variables
                    $stmt->bind_result($id, $username, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["user"] = "driver";
                            $_SESSION["username"] = $username;

                            // Redirect user to welcome page
                            header("location: user/dashboard.php");
                        } else {
                            // Password is not valid, display a generic error message
                            // $login_err = "Invalid username or password.";
                            $_SESSION['login_err'] = "Invalid username or password.";
                        }
                    }
                } else {
                    $_SESSION['login_err'] = "Invalid username or password.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $link->close();
}

//login as owner
if (isset($_POST['login_owner'])) {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    $type = trim($_POST["type"]);

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, logo, username, password FROM $type WHERE username = ?";

        if ($stmt = $link->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();

                // Check if username exists, if yes then verify password
                if ($stmt->num_rows == 1) {
                    // Password is correct, so start a new session
                    // session_start();

                    // Bind result variables
                    $stmt->bind_result($id, $logo, $username, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["user"] = "owner";
                            $_SESSION["type"] = $type;
                            $_SESSION["username"] = $username;
                            $_SESSION["profile"] = $logo;

                            // Redirect user to welcome page
                            header("location: user/dashboard.php");
                        } else {
                            // Password is not valid, display a generic error message
                            $_SESSION['login_err'] = "Invalid username or password.";
                        }
                    }
                } else {
                    $_SESSION['login_err'] = "Invalid username or password.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $link->close();
}
?>

<!DOCTYPE html>
<html lang="en" class="h-100">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<?php include 'includes/header.php' ?>

<body class="h-100" style="background-image: url(images/avatar/login_background.png); ">
    <div class="authincation" style="margin-left: 10px;">
        <div class="row">
            <div class="col-md-5 justify-content-left h-100 align-items-left mt-4 ml-4" style="margin-top: 5rem !important;">
                <div class="authincation-content">
                    <div class="no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form" style="padding: 20px;">
                                <h4 class="text-center mb-4">Login in your account</h4>
                                <div class="profile-tab">
                                    <div class="custom-tab-1">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <?php
                                                if (isset($_SESSION['login_err'])) {
                                                ?>
                                                    <div class="alert alert-danger alert-dismissable">
                                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                                        <?php echo $_SESSION['login_err']; ?>
                                                    </div>
                                                <?php
                                                    unset($_SESSION['login_err']);
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                            <div class="form-group">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="username" id="floatingInput" placeholder="name@example.com">
                                                    <label for="floatingInput">Username</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-floating mb-3">
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                                    <label for="floatingPassword">Password</label>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                                            </div>
                                        </form>
                                        <div class="new-account mt-3 text-center">
                                            <p><a class="text-primary" href="forgot_password.php">Forgot Password?</a></p>
                                            <p>Don't have an account? <a class="text-primary" href="register.php">Sign up</a></p>
                                            <div class="form-group">
                                                <a href="index.php" class="btn btn-secondary h-50">Back to Homepage</a>
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