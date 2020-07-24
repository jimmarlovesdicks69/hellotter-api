<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


class Mailer{

  
    private $mail;

    public function __construct(){ 
	$mail->SMTPDebug = 0;
        $this->mail = new PHPMailer(true); 
        //Server settings
        $this->mail->SMTPDebug = 0;                      // Enable verbose debug output
        $this->mail->isSMTP();                                            // Send using SMTP
        $this->mail->Host       = 'box.dearwolves.net';                    // Set the SMTP server to send through
        $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $this->mail->Username   = 'me@hellotter.com';                     // SMTP username
        $this->mail->Password   = 'password';                               // SMTP password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $this->mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $this->mail->setFrom('me@hellotter.com', 'Hellotter Mailer');
    }


    public function sendMail($email,$name){
        try { 
            $name = ucwords($name);
            $firstCharacter = strtoupper($name[0]);
            $this->mail->addAddress($email);     // Add a recipient
            // $this->mail->addAddress('ellen@example.com');               // Name is optional
            // $this->mail->addReplyTo('info@example.com', 'Information');
            // $this->mail->addCC('cc@example.com');
            // $this->mail->addBCC('bcc@example.com');

            // // Attachments
            // $this->mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = 'Hellotter Invitation';
            $this->mail->Body    = '
                <html>
                <head>
                <style>
                a {
                    text-decoration: none;
                }
                html {
                    align-items: center;
                    font-family: "Open Sans";
                    color: #000;
                }
                body {
                    margin: auto;
                    width: 375px;
                    margin-bottom: 30px;
            
                }
                .body-container {
                    border-bottom: 20px solid #33FFFF;
                    border-top: 20px solid #33FFFF;
                }
                .logo-container {
                    text-align: center;
                    margin: 30px 0 30px 0;
                }
                .logo {
                    width: 148px;
                    height: auto;
                }
                .title-container{
                    text-align: center;
                    margin-bottom: 30px;
                }
                .title{
                    font-size: 24px;
                    font-weight: bold;
                    padding-left: 5px;
                    padding-right: 5px;
                    color: #000;
                }
                .body-content-container{
                    text-align: center;
                    padding-bottom: 30px;
                    margin-bottom: 30px;
                    border-bottom: 2px solid #C5C5C5;
                }
                .body-content{
                    font-size: 14;
                    line-height: 28px;
                    padding-left: 5px;
                    padding-right: 5px;
                    color: #000;
                }
                .from-container {
                    text-align: center;
                    margin-bottom: 30px;
                }
                .from {
                    font-size: 21px;
                    line-height: 42px;
                    font-weight: 600;
                    color: #000;
                }
                .from-icon {
                    padding: 10px;
                    background-color: #33FFFF;
                    border-radius: 100px;
                    color: #fff;
                    margin-right: 5px;
                    font-weight: normal;
                }
                .report-container {
                    text-align: center;
                    margin-bottom: 30px;
                }
                .report {
                    font-size: 12px;
                    line-height: 17px;
                    padding-left: 5px;
                    padding-right: 5px;
                    color: #000;
                }
                .report-link {
                    color: #00B5C2;
                }
                .button-container {
                    text-align: center;
                    margin-bottom: 15px;
                    cursor: pointer;
                }
                .button {
                    width: 60%;
                    margin: auto;
                    font-size: 18px;
                    line-height: 24px;
                    font-weight: 600;
                    color: #fff;
                    padding: 10px;
                    border-radius: 5px;
                    background-color: #FF3333;
                }
                .unsubscribe-container {
                    text-align: center;
                    margin-bottom: 30px;
                    padding-bottom: 30px;
                    border-bottom: 2px solid #C5C5C5;
                }
                .unsubscribe {
                    font-size: 12px;
                    line-height: 17px;
                    color: #000;
                }
                .footer-logo-container {
                    text-align: center;
                    margin: 15px 0 15px 0;
                }
                .footer-logo {
                    width: 50px;
                    height: auto;
                }
                .footer-menu-container {
                    text-align: center;
                    margin-bottom: 15px;
                }
                .footer-menu {
                    font-size: 12px;
                    line-height: 17px;
                    color: #000;
                }
                .socmed-container {
                    text-align: center;
                    margin: 30px 0 30px 0;
                }
                .footer-container {
                    text-align: center;
                    margin-bottom: 15px;
                }
                .footer {
                    font-size: 11px;
                    line-height: 18px;
                    font-family: "Roboto";
                    font-weight: 600;
                    color: #747576;
                    padding-left: 10px;
                    padding-right: 10px;
                }
            
                    </style>
                </head>
                <body>
                    <div class="body-container">
                        <div class="logo-container">
                            <img src="http://3.23.32.212/api/assets/Hellotter-logo-white.png" class="logo">
                        </div>
                        <div class="title-container">
                            <h1 class="title">
                                '.$name.' would like to invite you to join hellotter.
                            </h1>
                        </div>
                        <div class="body-content-container">
                            <p class="body-content">
                                hellotter is a fun way to video chat with up to X people. Add filters to yourself while chatting, send virtual gifts to family and friends (baby pig anyone?), and talk freely. We take privacy seriously - we`re not watching you and we`re not listening to you. Video chat built to prioritize beauty filters, security and fun. 
                            </p>
                        </div>
                        <div class="from-container">
                            <p class="from">
                                <a class="from-icon">'.$firstCharacter.'</a> '.$name.'
                            </p>
                        </div>
                        <div class="report-container">
                            <p class="report">
                                If you do not have any connection with Mark Joe,
                                <br>
                                please <a class="report-link">report</a>  or disregard this email.
                            </p>
                        </div>
                        <div class="button-container">
                            <p class="button">
                                Join hellotter
                            </p>
                        </div>
                        <div class="unsubscribe-container">
                            <p class="unsubscribe">
                                Unsubscribe &nbsp;|&nbsp; Help
                            </p>
                        </div>
                        <div class="footer-logo-container">
                            <img src="http://3.23.32.212/api/assets/Hellotter-logo-white.png" class="footer-logo">
                        </div>
                        
                        <div class="footer-menu-container">
                            <p class="footer-menu">
                                <a href="hellotter.com">
                                    About 
                                 </a>
                                    &nbsp;|&nbsp; 

                                <a href="https://mail.google.com/mail/u/0/?view=cm&fs=1&to=hello@helloter.com">    
                                    Contact Us
                                 </a>    
                            </p>
                        </div>
                        
                       
                        <div class="socmed-container">
                            <a href="https://www.facebook.com/myhellotter/">
                                <img src="http://3.23.32.212/api/assets/facebook.png" class="socmed"> 
                            </a>
                            &nbsp; &nbsp; &nbsp; 
                            <a href="instagram.com/myhellotter">
                                <img src="http://3.23.32.212/api/assets/instagram-sketched.png" class="socmed">
                            </a>
                        </div>
                        
                    </div>
                    
                </body>
            </html>
            ';
            $this->mail->AltBody = "$name would like to invite you to join hellotter";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


            // <footer class="footer-container">
            //             <p class="footer">
            //                 Your received this email to let you know about important changes to your HoldYourChair Account and Services.
            //                 <br>
            //                 ©2020 HoldThatChair, Chicago, USA
            //             </p>
            //         </footer>


            $this->mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }

} 

?>