<?php

session_start();

$clientUsername = $_SESSION['uname'];
$name =  $_POST['name'];
$email =  $_POST['email'];
$feedback =  $_POST['feedback'];

echo $clientUsername.$name.$email.$feedback;

$serverName = "localhost";
$userName = "root";
$passWord = "";
$dbName = "gatedipex";

$conn = mysqli_connect($serverName, $userName, $passWord, $dbName);

$sql = "INSERT INTO `reports`(`username`, `name`, `email`, `report`) VALUES ('".$clientUsername."','".$name."','".$email."','".$feedback."')";

$conn->query($sql);


echo "<script>window.location.href='../welcome.php?page=students/feedback'</script>";


?>