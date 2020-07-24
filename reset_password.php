<?php
include 'DBconfig.php';

mysqli_set_charset($conn, "utf8");
$json = file_get_contents('php://input');
$obj = json_decode($json, true);

if (isset($_GET['email'])) {
	$email = $_GET['email'];
	$update = "UPDATE users SET reset_password = 2 WHERE email = '" . $email . "' LIMIT 1";
	$result = $conn->query($update);
	$json = 'Open hellotter App and update your password';
}else {
    die("Something went wrong");
}

echo $json;
?>