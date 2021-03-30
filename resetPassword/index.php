<?php
include('../backend/db.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST["email"]) && (!empty($_POST["email"]))){
    $conn = getDb();
    $error = null;

    $email = $_POST["email"];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    if (!$email) {
        $error .="<p>Invalid email address please type a valid email address!</p>";
    } else {
        $sel_query = "SELECT * FROM `users` WHERE email='".$email."'";
        $results = mysqli_query($conn,$sel_query);
        $row = mysqli_num_rows($results);

        if ($row=="") {
            $error .= "<p>No user is registered with this email address!</p>";
        }
    }
    if($error!="") {
        echo "<div class='error'>".$error."</div>
        <br /><a href='javascript:history.go(-1)'>Go Back</a>";
    } else {
        $expFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
        $expDate = date("Y-m-d H:i:s",$expFormat);
        $key = md5(2418*2+$email);
        $addKey = substr(md5(uniqid(rand(),1)),3,10);
        $key = $key . $addKey;

        // Insert Temp Table
        mysqli_query($conn, "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`) VALUES ('".$email."', '".$key."', '".$expDate."');");
        $output='<p>Dear user,</p>';
        $output.='<p>Please click on the following link to reset your password.</p>';
        $output.='<p>-------------------------------------------------------------</p>';
        $output.='<p><a href="localhost/skole/leap-glocal/resetPassword/resetPassword.php?key='.$key.'&email='.$email.'&action=reset" target="_blank">
        localhost/skole/leap-glocal/resetPassword/resetPassword.php?key='.$key.'&email='.$email.'&action=reset</a></p>';
        $output.='<p>-------------------------------------------------------------</p>';
        $output.='<p>Please be sure to copy the entire link into your browser.
                    The link will expire after 1 day for security reason.</p>';
        $output.='<p>If you did not request this forgotten password email, no action 
                    is needed, your password will not be reset. However, you may want to log into 
                    your account and change your security password as someone may have guessed it.</p>';
        $output.='<p>Thanks,</p>';
        $output.='<p>Leap Glocal</p>';
        $body = $output;
        $subject = "Password Recovery - Leap Glocal";

        $email_to = $email;
        $fromserver = "noreply@yourwebsite.com";
        require("vendor/autoload.php");
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->Host = "mail.yourwebsite.com"; // Enter your host here
        $mail->SMTPAuth = true;
        $mail->Username = "noreply@yourwebsite.com"; // Enter your email here
        $mail->Password = "password"; //Enter your password here
        $mail->Port = 25;
        $mail->IsHTML(true);
        $mail->From = "noreply@yourwebsite.com";
        $mail->FromName = "Leap Glocal";
        $mail->Sender = $fromserver; // indicates ReturnPath header
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($email_to);

        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "<div class='error'>
                    <p>An email has been sent to you with instructions on how to reset your password.</p>
                  </div><br /><br /><br />";
        }
    }
} else {
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Title</title>
        <link rel="stylesheet" type="text/css" href="../global/common.css">
        <link rel="stylesheet" type="text/css" href="../loginRegister/css/registerAndLogin.css">
        <link rel="stylesheet" type="text/css" href="../partsOfWebsite/css/footer.css">
    </head>
    <body>
    <!-- HERE COMES <NAV/> FROM PHP FILE -->
    <?php include_once "../partsOfWebsite/nav.php"?>

    <main>
        <div class="spacer"></div>

        <!-- LOGIN -->
        <section class="registerAndLoginForm">
            <form action="" method="post" name="reset">
                <h1 class="marginTop">Glemt passord</h1>

                <div class="inputs">
                    <label for="emailForgot" class="hide">Email</label>
                    <input type="email" id="emailForgot" name="email" placeholder="Epost" required autofocus />
                </div>

                <div class="loginRegisterBtnWrapper">
                    <button type="submit" value="Reset Password">Send</button>
                </div>

            </form>
            <div class="toRegister">
                <h2>Enda ikke medlem?</h2>
                <p>For å starte reisen med oss, venligst registrer deg ved å trykke på knappen under.</p>
                <a href="../loginRegister/register.php" class="regOrLoginBtn">Bli medlem</a>
            </div>
        </section>
    </main>

    <!-- HERE COMES <FOOTER/> FROM PHP FILE -->
    <?php include_once "../partsOfWebsite/footer.php"?>
    </body>
    </html>
<?php } ?>
