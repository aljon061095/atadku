<?php

require_once "includes/config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

session_start();

$temp_password = substr(md5(uniqid(rand(1,6))), 0, 8);;

$user_id = $_POST['id'];
$email_address = $_POST['emailAddress'];
$sql = "select * from user_list where (id='$user_id');";
$res = mysqli_query($link, $sql);

$checkRecord = mysqli_query($link, "SELECT * FROM user_list WHERE id=" . $user_id);
$totalrows = mysqli_num_rows($checkRecord);

if ($totalrows > 0) {
    $password = password_hash($temp_password, PASSWORD_DEFAULT);
    // Update the password
    $query = "UPDATE user_list SET password = '$password' WHERE id=" . $user_id;
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
        $mail->Username = 'atadku.deliverysystem@gmail.com';
        $mail->Password = 'gbxmqmuhhdupndri'; //   ieiiabmkltvdntsgieiiabmkltvdntsgieiiabmkltvdntsg  bermzwhiteknight8       

        $mail->SMTPSecure = 'ssl';
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Port = 465;

        //Send Email
        $mail->setFrom('atadku.deliverysystem@gmail.com', 'ATADKU');

        $query1 = "SELECT * FROM user_list ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($link, $query1);

        if ($result->num_rows > 0) {
            foreach ($result as $row) {

                $email_address = $email_address;

                //Recipients
                $mail->addAddress($email_address);
                $mail->addReplyTo('atadku.deliverysystem@gmail.com');

                //Content
                $mail->isHTML(true);
                $mail->Subject = "Forgot Password";

                $mail->Body = "<h3><b> Good Day! "  . $row['full_name'] . " ".
                    "</b></h3><br> Someone requested a new password for your account.<br/> Below is the new password generated.". "<br><h4><b>" . $temp_password .
                    "</b><h4>";

                if ($mail->send()) {
                    $_SESSION['success_status'] = "You have successfully forgot the password.";
                    header("location: stores.php");
                } else {
                    $_SESSION['result'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
                    $_SESSION['status'] = 'error';
                }
            }
        }
    }
} 
?>
