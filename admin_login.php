<?php
    // Initialize the session
    session_start();

    // Include config file
    require_once "config.php";

    //login as driver
    if (isset($_POST['login_admin'])) {

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
            $sql = "SELECT id, username, password FROM admin_user WHERE username = ?";

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
                                $_SESSION["user"] = "admin";
                                $_SESSION["username"] = $username;

                                // Redirect user to welcome page
                                header("location: admin/dashboard.php");
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
?>

<!DOCTYPE html>
<html lang="en" class="h-100">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<?php include 'includes/header.php' ?>

<body class="h-100" style="background-image: url(images/avatar/login_background.png); ">
    <div class="authincation" style="margin-left: 10px;">
        <div class="row">
            <div class="col-md-4 justify-content-left h-100 align-items-left mt-5 ml-4">
                <div class="authincation-content">
                    <div class="no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form" style="padding: 40px;">
                                <h4 class="text-center mb-4">Login as Admin</h4>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                    <div class="form-group">
                                        <div class="form-floating mb-3">
                                            <input type="twxt" name="username" class="form-control" id="floatingInput" placeholder="name@example.com">
                                            <label for="floatingInput">Username</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-floating mb-5">
                                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                                            <label for="floatingPassword">Password</label>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="login_admin" class="btn btn-primary btn-block">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>

</body>

</html>