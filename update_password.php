<?php
include 'DBconfig.php';

mysqli_set_charset($conn, "utf8");
$json = file_get_contents('php://input');
$obj = json_decode($json, true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$password = md5($obj['password']);
	$email = strtolower($obj['email']);

	if(_checkNull($password) || _checkNull($email)){

		$update = "UPDATE users SET password = '". $password ."', reset_password = 0 WHERE email = '" . $email . "' LIMIT 1";
		$result = $conn->query($update);
		$item = array("error" => false, "message" => "successfully updated password");
		$json = json_encode($item);

	}else{

		$item = array("error" => false, "message" => "Empty fields");
    	$json = json_encode($item);
	}

	
}else {
    die("Something went wrong");
}


function _checkNull($value){ 
    return $value == null ? false : $value == "" ? false : true;
}

echo $json;
?>