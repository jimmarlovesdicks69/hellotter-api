<?php
include 'DBconfig.php';

mysqli_set_charset($conn, "utf8");
$json = file_get_contents('php://input');
$obj = json_decode($json, true);

$email = strtolower($obj['email']);
$password = md5($obj['password']);

$sql = "SELECT * FROM users WHERE email = '" . $email . "' AND password = '" . $password . "' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['verified'] == 0) {
            $item = array("error" => true, "message" => "Email not yet verified");
            $json = json_encode($item);
        } else {
            $item = $row;
            $json = json_encode($item);
        }

    }
} else {
    $item = array("error" => true, "message" => "Invalid Credentials.");
    $json = json_encode($item);
}

echo $json;
$conn->close();
