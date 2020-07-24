<?php
include 'DBconfig.php';

mysqli_set_charset($conn, "utf8");
$json = file_get_contents('php://input');
$obj = json_decode($json, true);

$sql = "SELECT email, fullname FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row[] = $result->fetch_assoc()) {
        $item = $row;
        $json = json_encode($item);
    }
} else {
    $item = array("error" => true, "message" => "No Contacts");
    $json = json_encode($item);
}

echo $json;
$conn->close();
