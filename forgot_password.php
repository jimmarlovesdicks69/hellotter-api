<?php
require 'DBconfig.php';
include_once 'reset_pass_mail.php';

mysqli_set_charset($conn, "utf8");
$json = file_get_contents('php://input');
$obj = json_decode($json, true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = strtolower($obj['email']);

    if (_checkNull($email)) {
        $sql = "SELECT * FROM users WHERE email = '" . $email . "' ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rp = $row['reset_password'];
                if ($rp == 0) {
                    $update = "UPDATE users SET reset_password = 1 WHERE email = '" . $email . "' LIMIT 1";
                    $result2 = $conn->query($update);
                    $mailer = new Mailer();
                    $mailer->sendMail($email, $code);

                    $item = array("error" => false, "message" => "email sent");
                    $json = json_encode($item);
                } elseif ($rp == 2) {
                    $item = array("error" => false, "message" => "email already verified");
                    $json = json_encode($item);
                } else {
		    $mailer = new Mailer();
                    $mailer->sendMail($email, $code);
		    $item = array("error" => false, "message" => "email sent");
                    $json = json_encode($item);
                    //$item = array("error" => false, "message" => "email already sent");
                    //$json = json_encode($item);
                }
            }
        } else {
            $item = array("error" => true, "message" => "email not found");
            $json = json_encode($item);
        }

        echo $json;
        $conn->close();
    } else {
        $json = array(
            "error" => true,
            "message" => "Empty Fields",
        );
        echo json_encode($json);
    }
}

function _checkNull($value)
{
    return $value == null ? false : $value == "" ? false : true;
}

?>