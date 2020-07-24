<?php
require 'DBconfig.php';
include_once 'reset_pass_mail.php';

mysqli_set_charset($conn, "utf8");
$json = file_get_contents('php://input');
$obj = json_decode($json, true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = strtolower($obj['email']);

            $mailer = new Mailer();
            $mailer->sendMail($email);
}
?>