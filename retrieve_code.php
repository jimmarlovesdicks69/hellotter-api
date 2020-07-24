<?php
require 'DBConfig.php'; 

mysqli_set_charset($conn,"utf8");
$json = file_get_contents('php://input');
$obj = json_decode($json, true);

// $fullname = $obj['fullname'];
// $email = $obj['email'];
// $password = md5($obj['password']);
// $contact_number = $obj['contact_number'];
$code = "8192"; 
$email = "sean@dearwolves.net";
 
if(_checkNull($code) || _checkNull($email) ){ 
    $sql = "SELECT * FROM verifications AS V INNER JOIN users AS U ON U.id = V.user_id WHERE U.email = '" . $email . "' and V.code = '" . $code . "' ";
    $result = $conn->query($sql);
    echo $conn->error;
    if ($result->num_rows > 0) {
        $item = array("error" => false, "message" => "correct code");
        $json = json_encode($item);
    } else { 
        $item = array("error" => true, "message" => "wrong code");
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

/// [function] 
function _checkNull($value){ 
    return $value == null ? false : $value == "" ? false : true;
}

?>
