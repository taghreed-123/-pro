<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نسيت كلمة المرور</title>
    <?php require_once("main/parts/style.php"); ?>

</head>

<body>


    <?php require_once("main/connection.php"); ?>
    <?php require_once("main/models/users-model.php");
    $user = new UsersModel();
    ?>

    <div class="container">
        <br />
        <br />
        <br />

        <div class="row">

            <div class="col-md-11 text-right">
            <?php 
                    // $to = $_POST['email'];
                    // $from = 'admin@furniture.com';
                    // $subject = "رابط الحصول على كلمة المرور";
                    // $message = "<a href='recover.php?user=" . $to . "'>اضغط هنا</a>";

                    // $header = "From: ".$from." <".$from.">\n";
                    // $header .= "Reply-To: ".$to."\n";
                    // $header.= "MIME-Version: 1.0\r\n";
                    // $header.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    // mail($to, $subject, $message, implode("\r\n", array($header)));
                    // echo "<p class='alert alert-success'>" . "تم ارسال رسالة التاكيد الى الايميل الخاص بك" . "</p>";
                // 
            // }    
    // }
    ?>
    <?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['email'])) {
                if ($user->checkUserEmail($_POST['email'])) {
                    require 'src/Exception.php';
                    require 'src/PHPMailer.php';
                    require 'src/SMTP.php';

                    $mail = new PHPMailer;
                    $mail->isSMTP();
                    $mail->CharSet = 'UTF-8';
                    $mail->Mailer = "smtp";
                    $mail->SMTPDebug = 0;
                    $mail->SMTPAuth = TRUE;
                    $mail->SMTPSecure = "tls";
                    $mail->Port = 587;
                    $mail->Host = "smtp.gmail.com";
                    $mail->Username = "storef132@gmail.com";
                    $mail->Password = "dmdehcdxehlxygtr";
                    $mail->setFrom("storef132@gmail.com", "Furniture Store");
                    $mail->addAddress($_POST['email'], "Dhiaa Shalabi");
                    $mail->Subject = 'رابط تغيير كلمة المرور';
                    $mail->msgHTML("<a href='http://localhost/FurnitureWebSite/recover.php?user=" . $_POST['email'] . "'>اضغط هنا لتغيير كلمة المرور</a>");
                    $mail->AltBody = "<a href='http://localhost/FurnitureWebSite/recover.php?user=" . $_POST['email'] . "'>اضغط هنا لتغيير كلمة المرور</a>";
                    // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
    
                    if (!$mail->send()) {
                        echo "<p class='alert alert-danger'>" . "حدث خطاء اثناء عملية ارسال رابط تغيير كلمة المرور" . "</p>";
                    } else {
                        echo "<p class='alert alert-success'>" . "تم ارسال رسالة التاكيد الى الايميل الخاص بك" . "</p>";
                    }
                } else {
                    echo "<p class='alert alert-danger'>" . "عفوا الايميل غير صحيح او تم كتابته بطريقه غلط" . "</p>";
                }
            
        }else {
            echo "<p class='alert alert-danger'>" . "يجب عليك ادخال الايميل اولا" . "</p>";
        }
}
?>
                <div class="jumbotron bg-white" dir="rtl">
                    <div style="position:relative; left:10px; top:1px;">
                        <img src="img/right-arrow.png" style="color:#fff;" alt="back" onclick="document.location=document.referrer;" height="20" width="20">
                    </div>
                    <a href="main.php"><img src="img/logo.png" alt="logo" class="rounded mx-auto d-block" height="150" width="150"></a>
                    <a href="login.php" class="text-primary">تسجيل الدخول/</a>
                    <a  class="text-primary">نسيت كلمة المرور</a>
                    <hr class="my-4">
                    <form method="POST">
                        <div class="form-group mb-3">
                            <label for="exampleFormControlInput1" class="form-label">ادخل البريد الإلكتروني لتصلك رسالة:</label>
                            <input type="email" name="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp" placeholder="البريد الإلكتروني " required>
                        </div>

                        <br>
                        <button type="submit" class="btn btn-primary btn-md">موافق</button>
                    </form>
                    <br>

                </div>

            </div>
        </div>
    </div>

    </div>

    <?php require_once("main/parts/footer.php"); ?>
    <?php require_once("main/parts/script.php"); ?>

</body>

</html>