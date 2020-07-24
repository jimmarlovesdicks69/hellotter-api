<?php
require 'DBconfig.php';
include_once 'mail.php';

mysqli_set_charset($conn,"utf8");
$json = file_get_contents('php://input');
$obj = json_decode($json, true);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field

    // //for post sample
    //$fullname = $_POST['fullname'];
    //$email = $_POST['email'];
    //$password = md5($_POST['password']);
    //$contact_number = $_POST['contact_number'];
    $verified = 0;
    $reset_pass = 0;
    $fullname = $obj['fullname'];
    $email = $obj['email'];
    $password = md5($obj['password']);
    $contact_number = $obj['contact_number'];
   
    
    
    if(_checkNull($fullname) || _checkNull($email) || _checkNull($password) || _checkNull($contact_number)){
        $sql = "SELECT * FROM users WHERE email = '" . $email . "' ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $item = array("error" => true, "message" => "email already exists");
            $json = json_encode($item);
        } else {
            $sql = "INSERT INTO users (fullname, email, password, contact_number,verified,reset_password)
            VALUES ('" . $fullname . "', '" . $email . "', '" . $password. "', '" . $contact_number. "','" . $verified . "','" . $reset_pass . "')";

            if ($conn->query($sql) === true) {
                $item = _addCode($conn->insert_id, $conn);
            } else {
                $err = "Error: " . $sql . " " . $conn->error;
                $item = array("error" => true, "message" => $err);
            }
            $json = json_encode($item);

        }

        echo $json;
        $conn->close();
    }
    else{ 
        $json = array(
            "error" => true,
            "message" => "Empty Fields"
        );
        echo json_encode($json);
    }
}




/// [function] 
function _addCode($userId, $conn){
    $code = rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9);
    $date = date("Y-m-d H:i:s");
    $sql = "INSERT INTO verifications (user_id, code, date)
        VALUES ('" . $userId . "', '" . $code . "', '" . $date. "')";

    if ($conn->query($sql) === true) {
        $item = array("error" => false, "message" => "successfully added user"); 
        global $email;
        global $fullname;
        _sendMail($email , $code, $fullname);
    } else {
        $err = "Error: " . $sql . " " . $conn->error;
        $item = array("error" => true, "message" => $err);
    }
    return json_encode($item);
}
function _sendMail($email, $code, $fullname){
    $mailer = new Mailer();
    $mailer->sendMail($email, $code, $fullname); 
}

/// [function] 
function _checkNull($value){ 
    return $value == null ? false : $value == "" ? false : true;
}

?>
