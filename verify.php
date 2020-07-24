<?php
include 'DBconfig.php';

mysqli_set_charset($conn, "utf8");
$json = file_get_contents('php://input');
$obj = json_decode($json, true);

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $sql = "SELECT user_id FROM verifications WHERE code = '" . $code . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['user_id'];
            $update = "UPDATE users SET verified = 1 WHERE id = '" . $id . "' LIMIT 1";
            $result2 = $conn->query($update);
            $json = 'Succesfully Verified';
        }

    } else {
        $item = array("error" => true, "message" => "Invalid Credentials.");
        $json = json_encode($item);
    }

} else {
    die("Something went wrong");
}

echo $json;
$conn->close();
