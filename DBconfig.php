<?php
 
//Define your host here.
$HostName = 'localhost';
 
//Define your database name here.
$DatabaseName = 'hellotter';
 
//Define your database username here.
$HostUser = 'hellotter.app';
 
//Define your database password here.
$HostPass = 'NsqjYwVfmnbUMRQN'; 

//$conn = mysqli_connect($HostName, $HotUser, $HostPass, $DatabaseName);

$conn = mysqli_connect('localhost', 'hellotter.app', 'NsqjYwVfmnbUMRQN', "hellotter");

if (mysqli_connect_errno()) {
   printf("Connect failed: %s\n", mysqli_connect_error());
   exit();
}
?>
