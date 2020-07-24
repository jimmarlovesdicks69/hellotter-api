<?php
require 'DBconfig.php';
include_once 'send_invites_mail.php';

mysqli_set_charset($conn, "utf8");
$json = file_get_contents('php://input');
$obj = json_decode($json, true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $emails = $obj['emails'];
    $name = $obj['name'];

    if (_checkNull($email) || _checkNull($name)) {
        // $count = sizeof($email);

        foreach ($emails as &$email) {
            $mailer = new Mailer();
            $mailer->sendMail($email, $name);
        }
        $item = array("error" => false, "message" => "Emails Sent");
        $json = json_encode($item);

    } else {
        $item = array("error" => false, "message" => "Empty fields");
        $json = json_encode($item);
    }
} else {
    die("Something went wrong");
}

function _checkNull($value)
{
    return $value == null ? false : $value == "" ? false : true;
}

echo $json;
