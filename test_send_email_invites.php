<?php
require 'DBconfig.php';
include_once 'send_invites_mail.php';

mysqli_set_charset($conn, "utf8");
$json = file_get_contents('php://input');
$obj = json_decode($json, true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $obj['email'];
    $name = $obj['name'];

            $mailer = new Mailer();
            $mailer->sendMail($email, $name);
}
?>