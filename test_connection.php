<?php

// Create connection
$conn = mysqli_connect('localhost', 'otter', 'xqfT72Vy8nfdW2Wy', "hellotter");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}else{
    $item = array("error" => false, "message" => "Connected Successfully");
    $json = json_encode($item);
}

echo $json;
$conn->close();
?>
