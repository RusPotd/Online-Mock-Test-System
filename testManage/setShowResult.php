<?php
$exam = $_GET['exam'];
$value = $_GET['v'];

$serverName = "localhost";
$userName = "root";
$passWord = "";
$dbName = "gatedipex";

$conn = mysqli_connect($serverName, $userName, $passWord, $dbName);

$sql = "UPDATE `exams` SET `result`=".$value." WHERE name='".$exam."'";
$conn->query($sql);

echo "<script>window.location.href='../welcome_admin.php?page=home'</script>";

?>