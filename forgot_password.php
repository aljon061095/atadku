<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if (isset($_POST['forgot_password'])) {
    $email_address = trim($_POST["email_address"]);
    $temp_password = substr(md5(uniqid(rand(1, 6))), 0, 8);;

    // $user_id = $_POST['id'];
    $sql = "select * from user_list where (email_address='$email_address');";
    $res = mysqli_query($link, $sql);
    $totalrows = mysqli_num_rows($res);

    if ($totalrows > 0) {
        $password = password_hash($temp_password, PASSWORD_DEFAULT);
        // Update the password
        $query = "UPDATE user_list SET password = '$password' WHERE email_address=" . $email_address;
        $query_result = mysqli_query($link, $query);

        //send email
        if ($query_result) {

            //Load composer's autoloader
            require_once __DIR__ . '\PHPMailer\Exception.php';
            require __DIR__ . '\PHPMailer\PHPMailer.php';
            require __DIR__ . '\PHPMailer\SMTP.php';

            $mail = new PHPMailer(true);

            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'systemspluscollegefoundation1@gmail.com';
            $mail->Password = 'ieiiabmkltvdntsg'; //   ieiiabmkltvdntsgieiiabmkltvdntsgieiiabmkltvdntsg  bermzwhiteknight8       

            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            //Send Email
            $mail->setFrom('systemspluscollegefoundation1@gmail.com', 'ATADKU');


            $query1 = "SELECT * FROM user_list ORDER BY id DESC LIMIT 1";
            $result = mysqli_query($link, $query1);

            if ($result->num_rows > 0) {
                foreach ($result as $row) {

                    $email_address = $email_address;

                    //Recipients
                    $mail->addAddress($email_address);
                    $mail->addReplyTo('systemspluscollegefoundation1@gmail.com');

                    //Content
                    $mail->isHTML(true);
                    $mail->Subject = "Forgot Password";

                    $mail->Body = "<h3><b> Good Day! "  . $row['full_name'] . " " .
                        "</b></h3><br> Someone requested a new password for your account.<br/> Below is the new password generated." . "<br><h4><b>" . $temp_password .
                        "</b><h4>";

                    if ($mail->send()); {

                        $_SESSION['result'] = 'Message has been sent';
                        $_SESSION['status'] = 'ok';
                    }
                    $_SESSION['result'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
                    $_SESSION['status'] = 'error';

                    $_SESSION['success_status'] = "You have successfully forgot the password.";
                    header("location: login.php");
                }
            }
        }
    } else {
        $_SESSION['login_err'] = "The email address has not been registered. Please try again!";
    }
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
                                <h4 class="text-center mb-4">Forgot Password</h4>
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
                                                    <input type="text" class="form-control" name="email_address" id="floatingInput" placeholder="name@example.com">
                                                    <label for="floatingInput">Email Address</label>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" name="forgot_password" class="btn btn-primary btn-block">Login</button>
                                            </div>
                                        </form>
                                        <div class="new-account mt-3 text-center">
                                            <p>Already have an account? <a class="text-primary" href="login.php">Login</a></p>
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